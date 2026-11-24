<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_returns_ok(): void
    {
        $this->getJson('/api/health')->assertOk()->assertJson(['status' => 'ok']);
    }

    public function test_can_create_and_list_invoices(): void
    {
        $this->postJson('/api/invoices', ['number' => 'INV-2026-014', 'customer_name' => 'Northstar Studio', 'amount' => '1250.00', 'currency' => 'USD', 'status' => 'sent', 'due_date' => '2026-12-15'])
            ->assertCreated()->assertJsonPath('data.number', 'INV-2026-014');

        $this->getJson('/api/invoices')->assertOk()->assertJsonPath('total', 1);
    }

    public function test_invalid_payload_is_rejected(): void
    {
        $this->postJson('/api/invoices', [])->assertUnprocessable();
    }
}
