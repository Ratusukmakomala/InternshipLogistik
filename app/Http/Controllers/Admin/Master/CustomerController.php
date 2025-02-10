<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Customer;
use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Master\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function __construct(public CustomerService $customerService)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerService->findAll(10);
        confirmDelete("Delete Customer", "Are you sure you want to delete this Customer?");
        return view('admin.master.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->store($request);
        return redirect()->route('admin.master.customers.index')->with('success', 'Customer created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $customer->load('user');
        return view('admin.master.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->customerService->update($request, $customer);
        return redirect()->route('admin.master.customers.index')->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $this->customerService->destroy($customer);
        return redirect()->route('admin.master.customers.index')->with('success', 'Customer deleted successfully');
    }
}
