# API examples

Base URL: `http://127.0.0.1:8000/api`

## Create sample record

```http
POST /invoices
Accept: application/json
Content-Type: application/json

{
  "number": "INV-2026-014",
  "customer_name": "Northstar Studio",
  "amount": "1250.00",
  "currency": "USD",
  "status": "sent",
  "due_date": "2026-12-15"
}
```

## Validation

Submit an empty object and the API responds with HTTP 422 and field-level validation errors.
