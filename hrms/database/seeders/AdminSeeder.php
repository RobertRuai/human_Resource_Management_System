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
        $user1 = User::create([
            'username' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'email_verified_at' => now(),
            'password' => '123456',
            'role_id' => '1',
        ]);

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
        $user3->assignRole(['Employee']);
    }
}
