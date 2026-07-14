<div align="center">

![ERPKit v5](https://raw.githubusercontent.com/jeffersongoncalves/erpkitv5/main/art/jeffersongoncalves-erpkitv5.png)

</div>

# ERPKit v5

A full ERP, ready to run — a Laravel 13 + Filament v5 starter application with a multi-panel,
multi-guard architecture and the entire `jeffersongoncalves/filament-erp` ecosystem wired into its
admin panel.

ERPKit v5 follows the FilaKit multi-panel pattern: three Filament panels backed by two authentication
guards. The umbrella `jeffersongoncalves/filament-erp` plugin registers all 13 ERP modules on the
**admin** panel, and a demo seeder lays down a coherent starting dataset so you can log in and explore
a working ERP in minutes.

## Architecture

### Panels

| Panel | Path | Guard | Provider | Purpose |
|-------|------|-------|----------|---------|
| **Admin** | `/admin` | `admin` | `admins` | Management back office — the full 13-module ERP plus Admin/User management |
| **App**   | `/app`  | `web`   | `users`  | End-user self-service — dashboard and profile |
| **Guest** | `/`     | _(public)_ | — | Public landing pages |

### Guards

Two session guards are configured in `config/auth.php`:

- `admin` → `admins` provider → `App\Models\Admin` (table `admins`)
- `web` → `users` provider → `App\Models\User` (table `users`)

Each guard has its own password-reset broker.

## Features

- **Three panels, two guards** — Admin (`/admin`), App (`/app`) and Guest (`/`) following the FilaKit pattern
- **Full ERP on the admin panel** — `ErpPanelPlugin` registers all 13 ERP modules (80+ resources) under the `admin` guard
- **13 ERP modules** — accounting, stock, selling, buying, manufacturing, assets, subcontracting, CRM, projects, support, quality, maintenance, on top of the core master-data foundation
- **130+ `erp_*` tables** — the full ERP schema, published from the module packages and migrated into your database
- **First-party Filament plugins** — Logo, Edit Profile, PWA, Log Viewer, Developer Logins, Impersonate, Additional Information, Sensible Defaults
- **Demo seeder** — seeds an Admin and a User login plus a company, USD currency, an 8-account chart of accounts, a warehouse, items, a price list, a customer and a supplier (idempotent)

## Requirements

- PHP 8.3+
- Laravel 13
- SQLite (default) or MySQL

## Installation

```bash
git clone https://github.com/jeffersongoncalves/erpkitv5.git
cd erpkitv5
composer install
pnpm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
```

The ERP module migrations are **publish-only** — publish each module's migrations into
`database/migrations`, then migrate. A convenience composer script publishes all 13 at once:

```bash
composer publish-erp
# ...or publish them individually:
# php artisan vendor:publish --tag="erp-core-migrations"
# php artisan vendor:publish --tag="erp-accounting-migrations"
# php artisan vendor:publish --tag="erp-stock-migrations"
# php artisan vendor:publish --tag="erp-selling-migrations"
# php artisan vendor:publish --tag="erp-buying-migrations"
# php artisan vendor:publish --tag="erp-manufacturing-migrations"
# php artisan vendor:publish --tag="erp-assets-migrations"
# php artisan vendor:publish --tag="erp-subcontracting-migrations"
# php artisan vendor:publish --tag="erp-crm-migrations"
# php artisan vendor:publish --tag="erp-projects-migrations"
# php artisan vendor:publish --tag="erp-support-migrations"
# php artisan vendor:publish --tag="erp-quality-migrations"
# php artisan vendor:publish --tag="erp-maintenance-migrations"

php artisan migrate
php artisan db:seed
pnpm run build
php artisan serve
```

## Demo logins

| Panel | URL | Email | Password |
|-------|-----|-------|----------|
| Admin | [http://localhost:8000/admin](http://localhost:8000/admin) | `admin@erpkit.test` | `password` |
| App   | [http://localhost:8000/app](http://localhost:8000/app)     | `user@erpkit.test`  | `password` |

The Guest panel is served at [http://localhost:8000/](http://localhost:8000/).

## What's included on the admin panel

The umbrella plugin registers these 13 modules:

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

Each module can be toggled via `config/filament-erp.php` or the plugin's `exceptModules()` / `modules()`
methods — see the [`jeffersongoncalves/filament-erp`](https://github.com/jeffersongoncalves/filament-erp)
documentation.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
