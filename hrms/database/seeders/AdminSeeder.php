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
        #$user = User::create([
        #    'username' => 'Admin',
        #    'email' => 'admin1@gmail.com',
        #    'email_verified_at' => now(),
        #    'password' => '123456',
        #]);

        $user = User::create([
            'username' => 'HR1',
            'email' => 'hr1@gmail.com',
            'email_verified_at' => now(),
            'password' => '123456',
        ]);


        $user->assignRole(['HR Manager']);
    }
}
