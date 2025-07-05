<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
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
        $query = Customer::query();

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

        return new CustomerCollection($query->paginate());
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        // return response()->json($customer->load('invoices'), 200);
        return new CustomerResource($customer);
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
