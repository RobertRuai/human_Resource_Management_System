<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'HR Manager']);
        Role::create(['name' => 'Supervisor']);
        Role::create(['name' => 'Employee']);
        
    }
}
