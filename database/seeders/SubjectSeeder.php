<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Elementary Mathematics', 'credits' => 5],
            ['name' => 'English Language', 'code' => 'ENG', 'description' => 'English Language and Literature', 'credits' => 5],
            ['name' => 'Science', 'code' => 'SCI', 'description' => 'Elementary Science', 'credits' => 4],
            ['name' => 'Social Studies', 'code' => 'SOC', 'description' => 'Social Studies and History', 'credits' => 3],
            ['name' => 'Physical Education', 'code' => 'PE', 'description' => 'Physical Education and Sports', 'credits' => 2],
            ['name' => 'Art', 'code' => 'ART', 'description' => 'Visual Arts and Crafts', 'credits' => 2],
            ['name' => 'Music', 'code' => 'MUS', 'description' => 'Music and Singing', 'credits' => 2],
            ['name' => 'Computer Studies', 'code' => 'COMP', 'description' => 'Basic Computer Skills', 'credits' => 2],
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate(['code' => $subject['code']], $subject);
        }
    }
}