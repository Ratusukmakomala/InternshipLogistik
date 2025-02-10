<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\Employee;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\Employee\StoreEmployeeRequest;
use App\Http\Requests\Admin\Master\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function __construct(public EmployeeService $employeeService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = $this->employeeService->findAll(10);
        confirmDelete("Delete Employee", "Are you sure you want to delete this Employee?");
        return view('admin.master.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $this->employeeService->store($request);
        return redirect()->route('admin.master.employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('admin.master.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->employeeService->update($request, $employee);
        return redirect()->route('admin.master.employees.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this->employeeService->destroy($employee);
        return redirect()->route('admin.master.employees.index')->with('success', 'Employee deleted successfully');
    }
}
