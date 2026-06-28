<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use JeffersonGoncalves\Erp\Accounting\Enums\AccountType;
use JeffersonGoncalves\Erp\Accounting\Enums\RootType;
use JeffersonGoncalves\Erp\Accounting\Models\Account;
use JeffersonGoncalves\Erp\Buying\Models\Supplier;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\Erp\Core\Models\Currency;
use JeffersonGoncalves\Erp\Selling\Models\Customer;
use JeffersonGoncalves\Erp\Stock\Models\Item;
use JeffersonGoncalves\Erp\Stock\Models\ItemPrice;
use JeffersonGoncalves\Erp\Stock\Models\PriceList;
use JeffersonGoncalves\Erp\Stock\Models\Warehouse;

/**
 * Builds a minimal but coherent ERP demo dataset:
 * a company + USD currency, a small chart of accounts,
 * a warehouse, items, a price list, a customer and a supplier.
 * (Authentication accounts are seeded by DatabaseSeeder.)
 *
 * Idempotent: safe to run repeatedly (keyed on natural unique columns).
 */
class ErpDemoSeeder extends Seeder
{
    public function run(): void
    {
        // --- Currency + Company --------------------------------------------
        Currency::query()->firstOrCreate(
            ['code' => 'USD'],
            ['name' => 'US Dollar', 'symbol' => '$', 'enabled' => true],
        );

        $company = Company::query()->firstOrCreate(
            ['abbr' => 'EKD'],
            ['name' => 'ERPKit Demo Inc.', 'default_currency' => 'USD', 'country' => 'United States'],
        );

        // --- Chart of Accounts ---------------------------------------------
        $accounts = [
            'debtors' => ['Debtors', RootType::Asset, AccountType::Receivable],
            'creditors' => ['Creditors', RootType::Liability, AccountType::Payable],
            'sales' => ['Sales', RootType::Income, AccountType::Income],
            'bank' => ['Bank Account', RootType::Asset, AccountType::Bank],
            'cash' => ['Cash', RootType::Asset, AccountType::Cash],
            'stock_in_hand' => ['Stock In Hand', RootType::Asset, AccountType::Stock],
            'cogs' => ['Cost of Goods Sold', RootType::Expense, AccountType::CostOfGoodsSold],
            'srbnb' => ['Stock Received But Not Billed', RootType::Liability, AccountType::StockReceivedButNotBilled],
        ];

        /** @var array<string, Account> $coa */
        $coa = [];
        foreach ($accounts as $key => [$name, $rootType, $accountType]) {
            $coa[$key] = Account::query()->firstOrCreate(
                ['name' => $name, 'company_id' => $company->id],
                [
                    'root_type' => $rootType,
                    'account_type' => $accountType,
                    'account_currency' => 'USD',
                    'is_group' => false,
                ],
            );
        }

        // --- Warehouse (inventory account = Stock In Hand) -----------------
        Warehouse::query()->firstOrCreate(
            ['name' => 'Main Store'],
            [
                'company_id' => $company->id,
                'account_id' => $coa['stock_in_hand']->id,
                'is_group' => false,
            ],
        );

        // --- Items ----------------------------------------------------------
        $items = [
            ['WIDGET-001', 'Standard Widget', 25.00],
            ['GADGET-001', 'Premium Gadget', 80.00],
        ];

        /** @var array<int, Item> $createdItems */
        $createdItems = [];
        foreach ($items as [$code, $itemName, $rate]) {
            $createdItems[] = Item::query()->firstOrCreate(
                ['item_code' => $code],
                [
                    'item_name' => $itemName,
                    'item_group' => 'Products',
                    'is_stock_item' => true,
                    'standard_rate' => $rate,
                ],
            );
        }

        // --- Price List + Item Prices --------------------------------------
        $priceList = PriceList::query()->firstOrCreate(
            ['name' => 'Standard Selling'],
            ['currency' => 'USD', 'enabled' => true, 'is_selling' => true],
        );

        foreach ($createdItems as $item) {
            ItemPrice::query()->firstOrCreate(
                ['item_id' => $item->id, 'price_list_id' => $priceList->id],
                ['rate' => $item->standard_rate, 'currency' => 'USD'],
            );
        }

        // --- Customer + Supplier -------------------------------------------
        Customer::query()->firstOrCreate(
            ['customer_name' => 'Acme Corporation'],
            [
                'customer_type' => 'Company',
                'default_currency' => 'USD',
                'default_price_list_id' => $priceList->id,
                'territory' => 'United States',
            ],
        );

        Supplier::query()->firstOrCreate(
            ['supplier_name' => 'Globex Supplies'],
            [
                'supplier_type' => 'Company',
                'default_currency' => 'USD',
                'country' => 'United States',
            ],
        );
    }
}
