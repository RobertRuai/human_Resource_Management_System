<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove existing users if present
        User::where('username', 'Admin1')->orWhere('email', 'admin1@gmail.com')->delete();
        User::where('username', 'HR1')->orWhere('email', 'hr1@gmail.com')->delete();
        User::where('username', 'Supervisor1')->orWhere('email', 'supervisor1@gmail.com')->delete();
        User::where('username', 'User1')->orWhere('email', 'user1@gmail.com')->delete();

        $user1 = User::create([
            'username' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'role_id' => '1',
        ]);

        // Ensure admin role assignment using Spatie
        $adminRole = \App\Models\Role::where('name', 'Admin')->first();
        if ($adminRole && !$user1->hasRole('Admin')) {
            $user1->assignRole($adminRole->name);
        }

        $user2 = User::create([
            'username' => 'HR1',
            'email' => 'hr1@gmail.com',
            'email_verified_at' => now(),
            'password' => '123456',
            'role_id' => '2',
        ]);

        $user3 = User::create([
            'username' => 'Supervisor1',
            'email' => 'supervisor1@gmail.com',
            'email_verified_at' => now(),
            'password' => '123456',
            'role_id' => '3',
        ]);

        $user4 = User::create([
            'username' => 'User1',
            'email' => 'user1@gmail.com',
            'email_verified_at' => now(),
            'password' => '123456',
            'role_id' => '4',
        ]);

        $user1->assignRole(['Admin']);
        $user2->assignRole(['HR Manager']);
        $user3->assignRole(['Supervisor']);
        $user4->assignRole(['Employee']);
    }
}
