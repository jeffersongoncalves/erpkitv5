<div align="center">

![ERPKit v5](https://raw.githubusercontent.com/jeffersongoncalves/erpkitv5/main/art/jeffersongoncalves-erpkitv5.png)

</div>

# ERPKit v5

A full ERP, ready to run — a Laravel 13 + Filament v5 starter application wired to the `jeffersongoncalves/filament-erp` ecosystem.

ERPKit v5 is a ready-to-run starter app that bundles the entire Laravel ERP ecosystem behind a single admin panel. The umbrella `jeffersongoncalves/filament-erp` plugin registers all 13 ERP modules, and a demo seeder lays down a coherent starting dataset so you can log in and explore a working ERP in minutes.

## Features

- **One admin panel** — Filament v5 panel at `/admin` with the `ErpPanelPlugin` registering all 13 ERP modules
- **13 ERP modules** — accounting, stock, selling, buying, manufacturing, assets, subcontracting, CRM, projects, support, quality, maintenance, on top of the core master-data foundation
- **130+ `erp_*` tables** — the full ERPNext-native schema, published from the module packages and migrated into your database
- **Demo data seeder** — `ErpDemoSeeder` builds an admin user, a company + USD currency, a small chart of accounts, a warehouse, items, a price list, a customer and a supplier (idempotent, safe to re-run)
- **Admin authentication** — login out of the box with a demo account

## Requirements

- PHP 8.3+
- Laravel 13
- SQLite (default) or MySQL

## Installation

```bash
git clone https://github.com/jeffersongoncalves/erpkitv5.git
cd erpkitv5
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
```

The ERP module migrations are **publish-only** — publish each module's migrations into `database/migrations`, then migrate:

```bash
php artisan vendor:publish --tag="erp-core-migrations"
php artisan vendor:publish --tag="erp-accounting-migrations"
php artisan vendor:publish --tag="erp-stock-migrations"
php artisan vendor:publish --tag="erp-selling-migrations"
php artisan vendor:publish --tag="erp-buying-migrations"
php artisan vendor:publish --tag="erp-manufacturing-migrations"
php artisan vendor:publish --tag="erp-assets-migrations"
php artisan vendor:publish --tag="erp-subcontracting-migrations"
php artisan vendor:publish --tag="erp-crm-migrations"
php artisan vendor:publish --tag="erp-projects-migrations"
php artisan vendor:publish --tag="erp-support-migrations"
php artisan vendor:publish --tag="erp-quality-migrations"
php artisan vendor:publish --tag="erp-maintenance-migrations"

php artisan migrate
php artisan db:seed
php artisan serve
```

Visit [http://localhost:8000/admin](http://localhost:8000/admin) and sign in with the demo account:

- **Email:** `admin@erpkit.test`
- **Password:** `password`

## What's included

The umbrella plugin registers these 13 modules on the panel:

| Module | Covers |
|--------|--------|
| **Core** | Companies, currencies, units, fiscal years, departments, addresses & contacts |
| **Accounting** | Chart of accounts, general ledger, journal & payment entries, sales & purchase invoices, taxes, budgets |
| **Stock** | Items, warehouses, stock entries & ledger, price lists, batches & serials |
| **Selling** | Customers, quotations, sales orders, delivery notes |
| **Buying** | Suppliers, RFQs, purchase orders, purchase receipts |
| **Manufacturing** | BOMs, work orders, job cards, production planning |
| **Assets** | Fixed assets, depreciation, maintenance & disposal |
| **Subcontracting** | Subcontracting orders and receipts |
| **CRM** | Leads, opportunities, campaigns |
| **Projects** | Projects, tasks, timesheets |
| **Support** | Issues and service-level agreements |
| **Quality** | Inspections, quality goals, procedures |
| **Maintenance** | Maintenance schedules and visits |

Each module can be toggled via `config/filament-erp.php` or the plugin's `exceptModules()` / `modules()` methods — see the [`jeffersongoncalves/filament-erp`](https://github.com/jeffersongoncalves/filament-erp) documentation.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
