<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Invoice::query()->latest()->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'number' => 'required|string|max:40|unique:invoices,number',
            'customer_name' => 'required|string|max:180',
            'amount' => 'required|numeric|min:0',
            'currency' => 'sometimes|string|size:3',
            'status' => 'sometimes|in:draft,sent,paid,overdue',
            'due_date' => 'nullable|date'
        ]);

        $record = Invoice::create($data);
        return response()->json(['data' => $record], 201);
    }

    public function show(Invoice $invoice): JsonResponse
    {
        return response()->json(['data' => $invoice]);
    }

    public function update(Request $request, Invoice $invoice): JsonResponse
    {
        $data = $request->validate(['number' => ['sometimes', 'string', 'max:40', \Illuminate\Validation\Rule::unique('invoices', 'number')->ignore($invoice->id)], 'customer_name' => 'sometimes|string|max:180', 'amount' => 'sometimes|numeric|min:0', 'currency' => 'sometimes|string|size:3', 'status' => 'sometimes|in:draft,sent,paid,overdue', 'due_date' => 'nullable|date']);
        $invoice->update($data);
        return response()->json(['data' => $invoice->refresh()]);
    }

    public function destroy(Invoice $invoice): JsonResponse
    {
        $invoice->delete();
        return response()->json([], 204);
    }
}
