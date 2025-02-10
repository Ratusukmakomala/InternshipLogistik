<?php

namespace App\Services;

use App\Models\Employee;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\Master\Employee\StoreEmployeeRequest;
use App\Http\Requests\Admin\Master\Employee\UpdateEmployeeRequest;

class EmployeeService
{
    public function __construct(public Employee $employee, public UserService $userService)
    {

    }

    public function findAll($limit = 10)
    {
        return $this->employee::with('user', 'user.role')
        ->whereHas('user', function ($query) {
            $query->whereIn('role_id', [1]);
        })
        ->latest()->paginate($limit);
    }

    public function findById($employee)
    {
        return Employee::with('user', 'user.role')->find($employee);
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {
            $userRequest = new StoreUserRequest();
            $userRequest->merge($request->all());

            $user = $this->userService->store($userRequest);
            $this->employee->create([
                'user_id'   => $user->id,
                'code'      => $request->code,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateEmployeeRequest $request, $employee)
    {
        try {
            $userRequest = new UpdateUserRequest();
            $userRequest->merge($request->all());

            $user = $this->userService->findById($employee->user_id);
            $this->userService->update($userRequest, $user);

            $employee->update([
                'code' => $request->code,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($employee)
    {
        if ($employee->user != null) {
            $employee->user->delete();
        }
        $employee->delete();
    }
}
