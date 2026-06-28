<?php

use App\Models\Admin;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Accounting\Models\GlEntry;
use JeffersonGoncalves\Erp\Accounting\Models\SalesInvoice;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\Erp\Selling\Models\Customer;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
    $this->admin = Admin::where('email', 'admin@erpkit.test')->firstOrFail();
    $this->user = User::where('email', 'user@erpkit.test')->firstOrFail();
});

it('seeds both guards and a coherent ERP demo dataset', function () {
    expect(Admin::count())->toBe(1)
        ->and(User::count())->toBe(1)
        ->and(Company::count())->toBe(1)
        ->and(Account::count())->toBe(8)
        ->and(Customer::count())->toBe(1);
});

it('lets an Admin reach the admin panel dashboard', function () {
    $this->actingAs($this->admin, 'admin')
        ->get('/admin')
        ->assertSuccessful();
});

it('lets a User reach the app panel dashboard', function () {
    $this->actingAs($this->user, 'web')
        ->get('/app')
        ->assertSuccessful();
});

it('renders the core ERP Filament list pages for an authenticated admin', function (string $route) {
    $this->actingAs($this->admin, 'admin')
        ->get(route($route))
        ->assertOk();
})->with([
    'companies' => 'filament.admin.resources.companies.index',
    'accounts' => 'filament.admin.resources.accounts.index',
    'items' => 'filament.admin.resources.items.index',
    'customers' => 'filament.admin.resources.customers.index',
    'sales-invoices' => 'filament.admin.resources.sales-invoices.index',
]);

it('posts a balanced double-entry GL when a sales invoice is submitted', function () {
    $company = Company::firstOrFail();
    $debtors = Account::where('account_type', AccountType::Receivable)->firstOrFail();
    $sales = Account::where('account_type', AccountType::Income)->firstOrFail();

    // Build a draft sales invoice with a single income line.
    $invoice = SalesInvoice::create([
        'customer_name' => 'Acme Corporation',
        'posting_date' => now()->toDateString(),
        'company_id' => $company->id,
        'currency' => 'USD',
        'debit_to_id' => $debtors->id,
    ]);

    $invoice->items()->create([
        'item_code' => 'WIDGET-001',
        'item_name' => 'Standard Widget',
        'qty' => 2,
        'rate' => 25,
        'income_account_id' => $sales->id,
    ]);

    // Re-save the draft so calculateTotals() rolls the line into grand_total.
    $invoice->save();
    $invoice->refresh();

    expect($invoice->grand_total)->toBe(50.0);

    // Submit: transitions to Submitted and posts the ledger.
    $invoice->submit();

    expect($invoice->fresh()->docstatus)->toBe(DocStatus::Submitted);

    $entries = GlEntry::where('voucherable_type', $invoice->getMorphClass())
        ->where('voucherable_id', $invoice->id)
        ->where('is_cancelled', false)
        ->get();

    expect($entries)->toHaveCount(2)
        ->and(round($entries->sum('debit'), 2))->toBe(50.0)
        ->and(round($entries->sum('credit'), 2))->toBe(50.0)
        ->and(round($entries->sum('debit'), 2))->toBe(round($entries->sum('credit'), 2));

    // The debit lands on Debtors (AR), the credit on Sales (income).
    expect((float) $entries->firstWhere('account_id', $debtors->id)->debit)->toBe(50.0)
        ->and((float) $entries->firstWhere('account_id', $sales->id)->credit)->toBe(50.0);
});
