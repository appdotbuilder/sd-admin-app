<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'Full system access - can manage all users, classes, and academic data',
            ],
            [
                'name' => 'teacher',
                'display_name' => 'Teacher',
                'description' => 'Can manage assigned classes, input grades, and track student attendance',
            ],
            [
                'name' => 'parent',
                'display_name' => 'Parent',
                'description' => 'Can view child\'s academic progress, grades, and attendance records',
            ],
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'Can access personal schedule, view grades, and track own progress',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}