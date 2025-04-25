<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        $this->call([
            DepartmentSeeder::class,
        ]);

        $hr = Department::where('name', 'Human Resources')->first()->id;
        $it = Department::where('name', 'IT')->first()->id;


         // Admin
         User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'department_id' => $hr,
        ]);

        // Employees
        User::create([
            'name' => 'Alice Employee',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department_id' => $it,
        ]);

        User::create([
            'name' => 'Bob Employee',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department_id' => $hr,
        ]);

        $this->call([
            LeaveRequestSeeder::class,
        ]);

    }
}