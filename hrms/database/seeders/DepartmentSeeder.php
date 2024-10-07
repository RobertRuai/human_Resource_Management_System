<?php

namespace Database\Seeders;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(['name' => 'ICT']);
        Department::create(['name' => 'Finance']);
        Department::create(['name' => 'Administration']);
        Department::create(['name' => 'Procurement']);
        Department::create(['name' => 'Research']);
    }
}
