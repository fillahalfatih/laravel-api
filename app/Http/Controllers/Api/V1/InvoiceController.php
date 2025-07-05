<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreInvoiceRequest;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\V1\InvoiceCollection;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Invoice::query()->with('customer');

        // Filter by id
        if (request()->has('id')) {
            $query->where('id', request('id'));
        }

        // Filter by customer_id
        if (request()->has('customer_id')) {
            $query->where('customer_id', request('customer_id'));
        }

        // Filter by status
        if (request()->has('status')) {
            $query->where('status', request('status'));
        }

        // Filter by amount with operators
        if (request()->has('amount')) {
            $query->where('amount', request('amount'));
        }
        if (request()->has('amount_gt')) {
            $query->where('amount', '>', request('amount_gt'));
        }
        if (request()->has('amount_gte')) {
            $query->where('amount', '>=', request('amount_gte'));
        }
        if (request()->has('amount_lt')) {
            $query->where('amount', '<', request('amount_lt'));
        }
        if (request()->has('amount_lte')) {
            $query->where('amount', '<=', request('amount_lte'));
        }

        $invoices = $query->paginate();

        if ($invoices->isEmpty()) {
            return response()->json([
                'message' => 'Data not found',
                'data' => []
            ], 404);
        }

        return new InvoiceCollection($invoices->appends(request()->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $invoice = Invoice::create($request->all());

        return response()->json([
            'message' => 'Invoice created successfully',
            'data' => new InvoiceResource($invoice),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice->load('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
