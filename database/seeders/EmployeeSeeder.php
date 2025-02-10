<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::findByRoleName('admin')->get();

        foreach ($users as $user) {
            Employee::create([
                'user_id'   => $user->id,
                'code'      => generateRandomCode(10)
            ]);
        }
    }
}
