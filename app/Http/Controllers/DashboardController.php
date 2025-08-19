<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\GradeScore;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->role->name ?? 'student';

        switch ($userRole) {
            case 'administrator':
                return $this->adminDashboard();
            case 'teacher':
                return $this->teacherDashboard();
            case 'parent':
                return $this->parentDashboard();
            case 'student':
                return $this->studentDashboard();
            default:
                return $this->defaultDashboard();
        }
    }

    /**
     * Administrator dashboard.
     */
    protected function adminDashboard()
    {
        $stats = [
            'total_students' => User::byRole('student')->active()->count(),
            'total_teachers' => User::byRole('teacher')->active()->count(),
            'total_parents' => User::byRole('parent')->active()->count(),
            'total_classes' => SchoolClass::active()->count(),
            'recent_grades' => GradeScore::with(['student', 'subject'])
                ->latest()
                ->limit(5)
                ->get(),
            'recent_attendances' => Attendance::with(['student', 'schoolClass'])
                ->whereDate('attendance_date', today())
                ->latest()
                ->limit(5)
                ->get(),
        ];

        return Inertia::render('dashboard', [
            'userRole' => 'administrator',
            'stats' => $stats,
        ]);
    }

    /**
     * Teacher dashboard.
     */
    protected function teacherDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'my_classes' => $user->teacherClasses()->where('status', 'active')->count(),
            'total_students' => $user->teacherClasses()
                ->where('status', 'active')
                ->withCount('studentEnrollments')
                ->get()
                ->sum('student_enrollments_count'),
            'recent_grades' => GradeScore::with(['student', 'subject'])
                ->where('teacher_id', $user->id)
                ->latest()
                ->limit(5)
                ->get(),
            'todays_classes' => $user->schedules()
                ->with(['schoolClass', 'subject'])
                ->where('day_of_week', strtolower(now()->format('l')))
                ->orderBy('start_time')
                ->get(),
        ];

        return Inertia::render('dashboard', [
            'userRole' => 'teacher',
            'stats' => $stats,
        ]);
    }

    /**
     * Parent dashboard.
     */
    protected function parentDashboard()
    {
        $user = Auth::user();
        $children = $user->children()->get();

        $stats = [
            'children_count' => $children->count(),
            'recent_grades' => GradeScore::with(['student', 'subject'])
                ->whereIn('student_id', $children->pluck('id'))
                ->latest()
                ->limit(10)
                ->get(),
            'recent_attendances' => Attendance::with(['student', 'schoolClass'])
                ->whereIn('student_id', $children->pluck('id'))
                ->latest()
                ->limit(10)
                ->get(),
            'children' => $children,
        ];

        return Inertia::render('dashboard', [
            'userRole' => 'parent',
            'stats' => $stats,
        ]);
    }

    /**
     * Student dashboard.
     */
    protected function studentDashboard()
    {
        $user = Auth::user();

        $stats = [
            'my_grades' => GradeScore::with(['subject'])
                ->where('student_id', $user->id)
                ->latest()
                ->limit(10)
                ->get(),
            'my_attendances' => Attendance::with(['schoolClass', 'subject'])
                ->where('student_id', $user->id)
                ->latest()
                ->limit(10)
                ->get(),
            'todays_schedule' => $user->studentClasses()
                ->where('status', 'active')
                ->with(['schoolClass.schedules' => function ($query) {
                    $query->where('day_of_week', strtolower(now()->format('l')))
                        ->with(['subject', 'teacher'])
                        ->orderBy('start_time');
                }])
                ->first()
                ->schoolClass
                ->schedules ?? collect(),
        ];

        return Inertia::render('dashboard', [
            'userRole' => 'student',
            'stats' => $stats,
        ]);
    }

    /**
     * Default dashboard for users without specific roles.
     */
    protected function defaultDashboard()
    {
        return Inertia::render('dashboard', [
            'userRole' => 'default',
            'stats' => [],
        ]);
    }
}