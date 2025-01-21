<?php

namespace Database\Seeders;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing divisions
        $corporateServices = Division::where('name', 'Corporate Services')->first();
        $domestic = Division::where('name', 'Domestic tax Revenue')->first();
        $customs = Division::where('name', 'Customs')->first();
        $internalAudit = Division::where('name', 'Internal Audit')->first();
        $internalAffairs = Division::where('name', 'Internal Integrity Affairs')->first();
        $ict = Division::where('name', 'ICT')->first();
        
        $departments = [
            [
                'name' => 'HR Administration',
                'description' => 'Human Resources Administrative Tasks',
                'division_id' => $corporateServices->id
            ],
            [
                'name' => 'IT Infrastructure',
                'description' => 'Technology Infrastructure Management',
                'division_id' => $ict->id
            ],
            [
                'name' => 'Operations Management',
                'description' => 'Core Business Operations',
                'division_id' => $internalAffairs->id
            ],
            [
                'name' => 'TaxPayer Services',
                'description' => 'tax related Tasks',
                'division_id' => $domestic->id
            ],
            [
                'name' => 'Customs Infrastructure',
                'description' => 'Customs Technology Infrastructure ',
                'division_id' => $customs->id
            ],
            [
                'name' => 'Audit Management',
                'description' => 'Core Business Audits',
                'division_id' => $internalAudit->id
            ]
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
