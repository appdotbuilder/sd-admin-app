<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'administrator')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        $parentRole = Role::where('name', 'parent')->first();
        $studentRole = Role::where('name', 'student')->first();

        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name' => 'School Administrator',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'phone' => '+1-555-0001',
                'address' => '123 School Admin St',
                'status' => 'active',
                'employee_id' => 'ADM001',
            ]
        );

        // Create Sample Teachers
        $teachers = [
            [
                'name' => 'Ms. Sarah Johnson',
                'email' => 'sarah.johnson@school.com',
                'phone' => '+1-555-0101',
                'employee_id' => 'TCH001',
                'address' => '456 Teacher Lane',
            ],
            [
                'name' => 'Mr. David Smith',
                'email' => 'david.smith@school.com',
                'phone' => '+1-555-0102',
                'employee_id' => 'TCH002',
                'address' => '789 Education Ave',
            ],
            [
                'name' => 'Mrs. Emily Brown',
                'email' => 'emily.brown@school.com',
                'phone' => '+1-555-0103',
                'employee_id' => 'TCH003',
                'address' => '321 Learning Blvd',
            ],
        ];

        foreach ($teachers as $teacher) {
            User::firstOrCreate(
                ['email' => $teacher['email']],
                array_merge($teacher, [
                    'password' => Hash::make('password'),
                    'role_id' => $teacherRole->id,
                    'status' => 'active',
                ])
            );
        }

        // Create Sample Parents
        $parents = [
            [
                'name' => 'John Anderson',
                'email' => 'john.anderson@parent.com',
                'phone' => '+1-555-0201',
                'address' => '111 Parent St',
            ],
            [
                'name' => 'Mary Wilson',
                'email' => 'mary.wilson@parent.com',
                'phone' => '+1-555-0202',
                'address' => '222 Family Ave',
            ],
            [
                'name' => 'Robert Davis',
                'email' => 'robert.davis@parent.com',
                'phone' => '+1-555-0203',
                'address' => '333 Guardian Lane',
            ],
        ];

        foreach ($parents as $parent) {
            User::firstOrCreate(
                ['email' => $parent['email']],
                array_merge($parent, [
                    'password' => Hash::make('password'),
                    'role_id' => $parentRole->id,
                    'status' => 'active',
                ])
            );
        }

        // Create Sample Students
        $students = [
            [
                'name' => 'Emma Anderson',
                'email' => 'emma.anderson@student.com',
                'student_id' => 'STU001',
                'birth_date' => '2016-05-15',
                'gender' => 'female',
                'address' => '111 Parent St',
            ],
            [
                'name' => 'Michael Wilson',
                'email' => 'michael.wilson@student.com',
                'student_id' => 'STU002',
                'birth_date' => '2015-08-22',
                'gender' => 'male',
                'address' => '222 Family Ave',
            ],
            [
                'name' => 'Sophia Davis',
                'email' => 'sophia.davis@student.com',
                'student_id' => 'STU003',
                'birth_date' => '2017-03-10',
                'gender' => 'female',
                'address' => '333 Guardian Lane',
            ],
            [
                'name' => 'Oliver Thompson',
                'email' => 'oliver.thompson@student.com',
                'student_id' => 'STU004',
                'birth_date' => '2016-11-05',
                'gender' => 'male',
                'address' => '444 Student Way',
            ],
            [
                'name' => 'Ava Martinez',
                'email' => 'ava.martinez@student.com',
                'student_id' => 'STU005',
                'birth_date' => '2015-07-18',
                'gender' => 'female',
                'address' => '555 Child Blvd',
            ],
        ];

        foreach ($students as $student) {
            User::firstOrCreate(
                ['email' => $student['email']],
                array_merge($student, [
                    'password' => Hash::make('password'),
                    'role_id' => $studentRole->id,
                    'status' => 'active',
                ])
            );
        }
    }
}