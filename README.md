# InvoiceLite API

A lightweight invoice service with line items, totals, and payment status.

> Portfolio demo by Hossam Elkady. Built with PHP 8.2+, Laravel 11, and SQLite for local development.

![Static InvoiceLite API UI preview](docs/preview.svg)

**Preview note:** the image is a static concept illustration for this API demo, not a screenshot of a running app. This repository focuses on the API; it does not claim a deployed service.

## What it demonstrates

- RESTful CRUD endpoints with JSON responses and pagination.
- Request validation and consistent error handling through Laravel.
- Resource-specific persistence, field validation, and test examples.
- Eloquent model, migration, and a focused feature-test suite.
- Lightweight local setup using SQLite.

## Data model

- `number`: string unique
- `customer_name`: string
- `amount`: decimal:10,2
- `currency`: string default USD
- `status`: string default draft
- `due_date`: date nullable

## Requirements and setup

- PHP 8.2+
- Composer 2

```bash
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

The app runs at `http://127.0.0.1:8000`. The API is intentionally unauthenticated for a short portfolio sandbox. Do not use it for real personal or customer data.

## API

| Method | Endpoint | Purpose |
|---|---|---|
| GET | `/api/health` | Health check |
| GET | `/api/invoices` | Paginated list (15 per page) |
| POST | `/api/invoices` | Create a record |
| GET | `/api/invoices/{id}` | Read one record |
| PUT/PATCH | `/api/invoices/{id}` | Update a record |
| DELETE | `/api/invoices/{id}` | Delete a record |

Example create request:

```bash
curl -X POST http://127.0.0.1:8000/api/invoices \
  -H 'Accept: application/json' -H 'Content-Type: application/json' \
  -d '{"number": "INV-2026-014", "customer_name": "Northstar Studio", "amount": "1250.00", "currency": "USD", "status": "sent", "due_date": "2026-12-15"}'
```

## Tests

```bash
php artisan test
```

The feature tests cover the health check, create/list flow, and invalid input. PHP/Composer are not bundled; install dependencies locally before running tests.

## Design notes

- Form validation uses Laravel's JSON validation response (HTTP 422).
- IDs use implicit route model binding; missing records return 404.
- Paginated responses use Laravel's standard pagination envelope.
- The demo keeps domain scope small so the endpoints are easy to inspect.

## License

MIT. See [LICENSE](LICENSE).
