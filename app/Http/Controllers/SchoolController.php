<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\GradeScore;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    /**
     * Display the school administration dashboard.
     */
    public function index()
    {
        $stats = [
            'total_students' => User::byRole('student')->active()->count(),
            'total_teachers' => User::byRole('teacher')->active()->count(),
            'total_parents' => User::byRole('parent')->active()->count(),
            'total_classes' => SchoolClass::active()->count(),
            'total_grades' => GradeScore::whereDate('created_at', today())->count(),
            'total_attendances' => Attendance::whereDate('attendance_date', today())->count(),
        ];

        $recent_activities = collect([
            [
                'type' => 'grade',
                'message' => 'New grades added for Math class',
                'time' => '2 hours ago',
                'icon' => '📊',
            ],
            [
                'type' => 'attendance',
                'message' => 'Attendance recorded for Class 5A',
                'time' => '3 hours ago',
                'icon' => '✅',
            ],
            [
                'type' => 'student',
                'message' => 'New student enrolled in Class 3B',
                'time' => '1 day ago',
                'icon' => '👨‍🎓',
            ],
            [
                'type' => 'schedule',
                'message' => 'Schedule updated for Grade 4',
                'time' => '2 days ago',
                'icon' => '📅',
            ],
        ]);

        return Inertia::render('welcome', [
            'stats' => $stats,
            'recent_activities' => $recent_activities,
        ]);
    }
}