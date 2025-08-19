import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

interface Props {
    userRole: string;
    stats: {
        total_students?: number;
        total_teachers?: number;
        total_parents?: number;
        total_classes?: number;
        my_classes?: number;
        children_count?: number;
        recent_grades?: Array<{
            student?: { name: string };
            subject?: { name: string };
            score: number;
            max_score: number;
            assessment_type?: string;
        }>;
        recent_attendances?: Array<{
            student?: { name: string };
            school_class?: { name: string };
            status: string;
            attendance_date?: string;
        }>;
        todays_classes?: Array<{
            subject?: { name: string };
            school_class?: { name: string };
            teacher?: { name: string };
            start_time: string;
            end_time: string;
            room?: string;
        }>;
        todays_schedule?: Array<{
            subject?: { name: string };
            teacher?: { name: string };
            start_time: string;
            end_time: string;
            room?: string;
        }>;
        my_grades?: Array<{
            subject?: { name: string };
            assessment_type: string;
            score: number;
            max_score: number;
        }>;
        my_attendances?: Array<{
            school_class?: { name: string };
            attendance_date: string;
            status: string;
        }>;
        children?: Array<{
            name: string;
            student_id: string;
        }>;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ userRole, stats }: Props) {
    const renderAdminDashboard = () => (
        <div className="space-y-6">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <div className="flex items-center">
                        <div className="text-3xl mr-4">👨‍🎓</div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Students</p>
                            <p className="text-2xl font-bold">{stats.total_students}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <div className="flex items-center">
                        <div className="text-3xl mr-4">👩‍🏫</div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Teachers</p>
                            <p className="text-2xl font-bold">{stats.total_teachers}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <div className="flex items-center">
                        <div className="text-3xl mr-4">👨‍👩‍👧‍👦</div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Parents</p>
                            <p className="text-2xl font-bold">{stats.total_parents}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <div className="flex items-center">
                        <div className="text-3xl mr-4">🏛️</div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Classes</p>
                            <p className="text-2xl font-bold">{stats.total_classes}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">📊 Recent Grades</h3>
                    <div className="space-y-3">
                        {stats.recent_grades?.length && stats.recent_grades.length > 0 ? stats.recent_grades.map((grade, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <span>{grade.student?.name} - {grade.subject?.name}</span>
                                <span className="font-semibold">{grade.score}/{grade.max_score}</span>
                            </div>
                        )) : (
                            <p className="text-gray-500">No recent grades</p>
                        )}
                    </div>
                </div>
                
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">✅ Today's Attendance</h3>
                    <div className="space-y-3">
                        {stats.recent_attendances?.length && stats.recent_attendances.length > 0 ? stats.recent_attendances.map((attendance, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <span>{attendance.student?.name} - {attendance.school_class?.name}</span>
                                <span className={`px-2 py-1 rounded text-sm ${
                                    attendance.status === 'present' ? 'bg-green-100 text-green-800' :
                                    attendance.status === 'absent' ? 'bg-red-100 text-red-800' :
                                    'bg-yellow-100 text-yellow-800'
                                }`}>
                                    {attendance.status}
                                </span>
                            </div>
                        )) : (
                            <p className="text-gray-500">No attendance records today</p>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );

    const renderTeacherDashboard = () => (
        <div className="space-y-6">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <div className="flex items-center">
                        <div className="text-3xl mr-4">🏛️</div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">My Classes</p>
                            <p className="text-2xl font-bold">{stats.my_classes}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <div className="flex items-center">
                        <div className="text-3xl mr-4">👨‍🎓</div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Total Students</p>
                            <p className="text-2xl font-bold">{stats.total_students}</p>
                        </div>
                    </div>
                </div>
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <div className="flex items-center">
                        <div className="text-3xl mr-4">📅</div>
                        <div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">Today's Classes</p>
                            <p className="text-2xl font-bold">{stats.todays_classes?.length || 0}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">📅 Today's Schedule</h3>
                    <div className="space-y-3">
                        {stats.todays_classes?.length && stats.todays_classes.length > 0 ? stats.todays_classes.map((schedule, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <div>
                                    <p className="font-medium">{schedule.subject?.name}</p>
                                    <p className="text-sm text-gray-500">{schedule.school_class?.name}</p>
                                </div>
                                <div className="text-right">
                                    <p className="font-medium">{schedule.start_time} - {schedule.end_time}</p>
                                    <p className="text-sm text-gray-500">{schedule.room}</p>
                                </div>
                            </div>
                        )) : (
                            <p className="text-gray-500">No classes today</p>
                        )}
                    </div>
                </div>
                
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">📊 Recent Grades I Added</h3>
                    <div className="space-y-3">
                        {stats.recent_grades?.length && stats.recent_grades.length > 0 ? stats.recent_grades.map((grade, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <div>
                                    <p className="font-medium">{grade.student?.name}</p>
                                    <p className="text-sm text-gray-500">{grade.subject?.name}</p>
                                </div>
                                <span className="font-semibold">{grade.score}/{grade.max_score}</span>
                            </div>
                        )) : (
                            <p className="text-gray-500">No recent grades</p>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );

    const renderParentDashboard = () => (
        <div className="space-y-6">
            <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                <h3 className="text-lg font-semibold mb-4">👨‍👩‍👧‍👦 My Children</h3>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    {stats.children?.length && stats.children.length > 0 ? stats.children.map((child, index: number) => (
                        <div key={index} className="p-4 bg-gray-50 dark:bg-gray-700 rounded">
                            <p className="font-medium">{child.name}</p>
                            <p className="text-sm text-gray-500">Student ID: {child.student_id}</p>
                        </div>
                    )) : (
                        <p className="text-gray-500">No children registered</p>
                    )}
                </div>
            </div>
            
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">📊 Children's Recent Grades</h3>
                    <div className="space-y-3">
                        {stats.recent_grades?.length && stats.recent_grades.length > 0 ? stats.recent_grades.map((grade, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <div>
                                    <p className="font-medium">{grade.student?.name}</p>
                                    <p className="text-sm text-gray-500">{grade.subject?.name}</p>
                                </div>
                                <span className="font-semibold">{grade.score}/{grade.max_score}</span>
                            </div>
                        )) : (
                            <p className="text-gray-500">No recent grades</p>
                        )}
                    </div>
                </div>
                
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">✅ Recent Attendance</h3>
                    <div className="space-y-3">
                        {stats.recent_attendances?.length && stats.recent_attendances.length > 0 ? stats.recent_attendances.map((attendance, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <div>
                                    <p className="font-medium">{attendance.student?.name}</p>
                                    <p className="text-sm text-gray-500">{attendance.attendance_date}</p>
                                </div>
                                <span className={`px-2 py-1 rounded text-sm ${
                                    attendance.status === 'present' ? 'bg-green-100 text-green-800' :
                                    attendance.status === 'absent' ? 'bg-red-100 text-red-800' :
                                    'bg-yellow-100 text-yellow-800'
                                }`}>
                                    {attendance.status}
                                </span>
                            </div>
                        )) : (
                            <p className="text-gray-500">No recent attendance records</p>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );

    const renderStudentDashboard = () => (
        <div className="space-y-6">
            <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                <h3 className="text-lg font-semibold mb-4">📅 Today's Schedule</h3>
                <div className="space-y-3">
                    {stats.todays_schedule?.length && stats.todays_schedule.length > 0 ? stats.todays_schedule.map((schedule, index: number) => (
                        <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                            <div>
                                <p className="font-medium">{schedule.subject?.name}</p>
                                <p className="text-sm text-gray-500">Teacher: {schedule.teacher?.name}</p>
                            </div>
                            <div className="text-right">
                                <p className="font-medium">{schedule.start_time} - {schedule.end_time}</p>
                                <p className="text-sm text-gray-500">{schedule.room}</p>
                            </div>
                        </div>
                    )) : (
                        <p className="text-gray-500">No classes today</p>
                    )}
                </div>
            </div>
            
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">📊 My Recent Grades</h3>
                    <div className="space-y-3">
                        {stats.my_grades?.length && stats.my_grades.length > 0 ? stats.my_grades.map((grade, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <div>
                                    <p className="font-medium">{grade.subject?.name}</p>
                                    <p className="text-sm text-gray-500">{grade.assessment_type}</p>
                                </div>
                                <span className="font-semibold">{grade.score}/{grade.max_score}</span>
                            </div>
                        )) : (
                            <p className="text-gray-500">No grades yet</p>
                        )}
                    </div>
                </div>
                
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow">
                    <h3 className="text-lg font-semibold mb-4">✅ My Attendance</h3>
                    <div className="space-y-3">
                        {stats.my_attendances?.length && stats.my_attendances.length > 0 ? stats.my_attendances.map((attendance, index: number) => (
                            <div key={index} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <div>
                                    <p className="font-medium">{attendance.school_class?.name}</p>
                                    <p className="text-sm text-gray-500">{attendance.attendance_date}</p>
                                </div>
                                <span className={`px-2 py-1 rounded text-sm ${
                                    attendance.status === 'present' ? 'bg-green-100 text-green-800' :
                                    attendance.status === 'absent' ? 'bg-red-100 text-red-800' :
                                    'bg-yellow-100 text-yellow-800'
                                }`}>
                                    {attendance.status}
                                </span>
                            </div>
                        )) : (
                            <p className="text-gray-500">No attendance records</p>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );

    const renderDashboardContent = () => {
        switch (userRole) {
            case 'administrator':
                return renderAdminDashboard();
            case 'teacher':
                return renderTeacherDashboard();
            case 'parent':
                return renderParentDashboard();
            case 'student':
                return renderStudentDashboard();
            default:
                return (
                    <div className="bg-white dark:bg-gray-800 rounded-lg p-8 shadow text-center">
                        <div className="text-6xl mb-4">🏫</div>
                        <h2 className="text-2xl font-bold mb-4">Welcome to School Administration</h2>
                        <p className="text-gray-600 dark:text-gray-400">
                            Please contact your administrator to assign you a proper role.
                        </p>
                    </div>
                );
        }
    };

    const getRoleTitle = () => {
        const titles = {
            administrator: '🛡️ Administrator Dashboard',
            teacher: '👩‍🏫 Teacher Dashboard',
            parent: '👨‍👩‍👧‍👦 Parent Dashboard',
            student: '👨‍🎓 Student Dashboard',
        };
        return titles[userRole as keyof typeof titles] || '🏫 Dashboard';
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="p-6">
                <div className="mb-6">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                        {getRoleTitle()}
                    </h1>
                    <p className="text-gray-600 dark:text-gray-400 mt-2">
                        Welcome back! Here's what's happening in your school.
                    </p>
                </div>
                {renderDashboardContent()}
            </div>
        </AppLayout>
    );
}