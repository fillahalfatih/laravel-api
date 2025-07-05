<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Customer::query()->with('invoices');

        // Filter by id
        if (request()->has('id')) {
            $query->where('id', request('id'));
        }

        // Filter by name
        if (request()->has('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        // Filter by type
        if (request()->has('type')) {
            $query->where('type', request('type'));
        }

        // Filter by email
        if (request()->has('email')) {
            $query->where('email', 'like', '%' . request('email') . '%');
        }

        // Filter by address
        if (request()->has('address')) {
            $query->where('address', 'like', '%' . request('address') . '%');
        }

        $customers = $query->paginate();

        if ($customers->isEmpty()) {
            return response()->json([
                'message' => 'Data not found',
                'data' => []
            ], 404);
        }

        return new CustomerCollection($customers->appends(request()->query()));
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
    public function store(StoreCustomerRequest $request)
    {
        // return new CustomerResource(Customer::create($request->all()));
        
        $customer = Customer::create($request->all());

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => new CustomerResource($customer),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        // return response()->json($customer->load('invoices'), 200);
        return new CustomerResource($customer->load('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
