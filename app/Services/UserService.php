<?php

namespace App\Services;

use App\Models\User;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;

class UserService
{
    public function __construct(public User $user)
    {

    }

    public function findAll($limit = 10)
    {
        return $this->user::with('role')->latest()->paginate($limit);
    }

    public function findById($user)
    {
        return User::with('role')->find($user);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            return $this->user->create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password,
                'role_id'   => $request->role_id
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(UpdateUserRequest $request, $user)
    {
        try {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'role_id'   => $request->role_id
            ]);

            if ($request->password) {
                $user->update([
                    'password'  => $request->password
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy($user)
    {
        $user->delete();
    }
}
