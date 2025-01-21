<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['name' => 'Corporate Services', 'description' => 'Financial,Administrative and support functions'],
            ['name' => 'Domestic tax Revenue', 'description' => 'Domestic tax revenue collection'],
            ['name' => 'Customs', 'description' => 'Customs tax collection'],
            ['name' => 'Internal Audit', 'description' => 'Financial records and accounts audit'],
            ['name' => 'Internal Integrity Affairs', 'description' => 'Uphold interest,confidence of public,employees'],
            ['name' => 'ICT', 'description' => 'ICT digitalization and technological innovations'],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}