<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $grades = [
            ['name' => 'Grade 1', 'level' => 1, 'description' => 'First grade elementary'],
            ['name' => 'Grade 2', 'level' => 2, 'description' => 'Second grade elementary'],
            ['name' => 'Grade 3', 'level' => 3, 'description' => 'Third grade elementary'],
            ['name' => 'Grade 4', 'level' => 4, 'description' => 'Fourth grade elementary'],
            ['name' => 'Grade 5', 'level' => 5, 'description' => 'Fifth grade elementary'],
            ['name' => 'Grade 6', 'level' => 6, 'description' => 'Sixth grade elementary'],
        ];

        foreach ($grades as $grade) {
            Grade::firstOrCreate(['level' => $grade['level']], $grade);
        }
    }
}