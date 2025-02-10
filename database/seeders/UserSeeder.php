<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'      => 'admin',
                'email'     => 'admin@mail.com',
                'password'  => 'admin',
                'role_id'   => Role::findByName('admin')->id,
            ],
            [
                'name'      => 'mitra',
                'email'     => 'mitra@mail.com',
                'password'  => 'mitra',
                'role_id'   => Role::findByName('mitra')->id
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
