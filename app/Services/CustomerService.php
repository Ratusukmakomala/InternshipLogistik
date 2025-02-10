<?php

namespace App\Services;

use App\Models\Customer;
use App\Services\UserService;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\Master\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Master\Customer\UpdateCustomerRequest;

class CustomerService
{
    public function __construct(public Customer $customer, public UserService $userService)
    {

    }

    public function lists()
    {
        return $this->customer->get()->pluck('name', 'id')->toArray();
    }

    public function listIds()
    {
        return $this->customer->get()->pluck('id')->toArray();
    }

    public function findAll($limit = 10)
    {
        return $this->customer::latest()->paginate($limit);
    }

    public function findById($customer)
    {
        return customer::with('user', 'user.role')->find($customer);
    }

    public function findByUserId($user)
    {
        return $this->customer::with('user', 'user.role')->where('user_id', $user)->first();
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $userRequest = new StoreUserRequest();
            $userRequest->merge($request->all());

            $user = $this->userService->store($userRequest);

            $this->customer->create([
                'code'      => $request->code,
                'name'      => $request->name,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'zip_code'  => $request->zip_code,
                'type'      => $request->type,
                'user_id'   => $user->id
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateCustomerRequest $request, $customer)
    {
        try {
            $userRequest = new UpdateUserRequest();
            $userRequest->merge($request->all());

            $user = $this->userService->findById($customer->user_id);
            $this->userService->update($userRequest, $user);

            $customer->update([
                'code'      => $request->code,
                'name'      => $request->name,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'zip_code'  => $request->zip_code,
                'type'      => $request->type,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($customer)
    {
        if ($customer->user != null) {
            $customer->user->delete();
        }
        $customer->delete();
    }
}
