<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function __construct(public Role $role)
    {

    }

    public function findAll($limit = 10)
    {
        return $this->role::latest()->paginate($limit);
    }

    public function lists()
    {
        return $this->role->get()->pluck('name', 'id')->toArray();
    }
}
