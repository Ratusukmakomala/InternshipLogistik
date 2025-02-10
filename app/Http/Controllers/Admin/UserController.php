<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Services\RoleService;

class UserController extends Controller
{
    public function __construct(public UserService $userService, public RoleService $roleService)
    {

    }

    public function index()
    {
        $users = $this->userService->findAll(10);
        confirmDelete("Delete User", "Are you sure you want to delete this User?");
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleService->lists();
        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->store($request);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = $this->roleService->lists();
        return view('admin.user.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($request, $user);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
