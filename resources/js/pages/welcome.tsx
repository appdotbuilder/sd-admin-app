import React from 'react';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

interface Props {
    stats?: {
        total_students: number;
        total_teachers: number;
        total_parents: number;
        total_classes: number;
        total_grades: number;
        total_attendances: number;
    };
    recent_activities?: Array<{
        type: string;
        message: string;
        time: string;
        icon: string;
    }>;
    [key: string]: unknown;
}

export default function Welcome({ stats, recent_activities }: Props) {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Elementary School Administration System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <header className="bg-white shadow-sm dark:bg-gray-800">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center py-6">
                            <div className="flex items-center">
                                <div className="text-3xl mr-3">🏫</div>
                                <div>
                                    <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                                        Elementary School Administration
                                    </h1>
                                    <p className="text-sm text-gray-600 dark:text-gray-300">
                                        Comprehensive School Management System
                                    </p>
                                </div>
                            </div>
                            <nav className="flex items-center gap-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                                    >
                                        Go to Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="text-gray-600 hover:text-gray-900 px-4 py-2 rounded-lg font-medium transition-colors dark:text-gray-300 dark:hover:text-white"
                                        >
                                            Log in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                                        >
                                            Get Started
                                        </Link>
                                    </>
                                )}
                            </nav>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div className="text-center mb-16">
                        <h2 className="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                            🎓 Complete School Management Solution
                        </h2>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                            Manage students, teachers, classes, subjects, schedules, grades, and attendance 
                            all in one comprehensive platform designed for elementary schools.
                        </p>
                    </div>

                    {/* Stats Section */}
                    {stats && (
                        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-16">
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg">
                                <div className="text-3xl mb-2">👨‍🎓</div>
                                <div className="text-2xl font-bold text-blue-600 dark:text-blue-400">{stats.total_students}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-300">Students</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg">
                                <div className="text-3xl mb-2">👩‍🏫</div>
                                <div className="text-2xl font-bold text-green-600 dark:text-green-400">{stats.total_teachers}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-300">Teachers</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg">
                                <div className="text-3xl mb-2">👨‍👩‍👧‍👦</div>
                                <div className="text-2xl font-bold text-purple-600 dark:text-purple-400">{stats.total_parents}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-300">Parents</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg">
                                <div className="text-3xl mb-2">🏛️</div>
                                <div className="text-2xl font-bold text-orange-600 dark:text-orange-400">{stats.total_classes}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-300">Classes</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg">
                                <div className="text-3xl mb-2">📊</div>
                                <div className="text-2xl font-bold text-red-600 dark:text-red-400">{stats.total_grades}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-300">Grades Today</div>
                            </div>
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg">
                                <div className="text-3xl mb-2">✅</div>
                                <div className="text-2xl font-bold text-teal-600 dark:text-teal-400">{stats.total_attendances}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-300">Attendance Today</div>
                            </div>
                        </div>
                    )}

                    {/* Features Grid */}
                    <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                            <div className="text-4xl mb-4">👥</div>
                            <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">
                                User Management
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300 text-sm">
                                Manage administrators, teachers, parents, and students with role-based access control
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                            <div className="text-4xl mb-4">📚</div>
                            <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">
                                Academic Management
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300 text-sm">
                                Create and manage grades, classes, subjects, and academic schedules efficiently
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                            <div className="text-4xl mb-4">🎯</div>
                            <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">
                                Grade Management
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300 text-sm">
                                Track student performance with comprehensive grading and assessment tools
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                            <div className="text-4xl mb-4">📋</div>
                            <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">
                                Attendance Tracking
                            </h3>
                            <p className="text-gray-600 dark:text-gray-300 text-sm">
                                Monitor student attendance with detailed reporting and notifications
                            </p>
                        </div>
                    </div>

                    {/* User Roles */}
                    <div className="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg mb-16">
                        <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center">
                            🔑 Role-Based Access System
                        </h3>
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div className="text-center p-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                <div className="text-3xl mb-3">🛡️</div>
                                <h4 className="font-bold text-blue-900 dark:text-blue-100 mb-2">Administrator</h4>
                                <p className="text-sm text-blue-700 dark:text-blue-200">
                                    Full system access - manage all users, classes, and academic data
                                </p>
                            </div>
                            <div className="text-center p-6 bg-green-50 dark:bg-green-900/20 rounded-xl">
                                <div className="text-3xl mb-3">👩‍🏫</div>
                                <h4 className="font-bold text-green-900 dark:text-green-100 mb-2">Teacher</h4>
                                <p className="text-sm text-green-700 dark:text-green-200">
                                    Manage assigned classes, input grades, and track student attendance
                                </p>
                            </div>
                            <div className="text-center p-6 bg-purple-50 dark:bg-purple-900/20 rounded-xl">
                                <div className="text-3xl mb-3">👨‍👩‍👧</div>
                                <h4 className="font-bold text-purple-900 dark:text-purple-100 mb-2">Parent</h4>
                                <p className="text-sm text-purple-700 dark:text-purple-200">
                                    View child's academic progress, grades, and attendance records
                                </p>
                            </div>
                            <div className="text-center p-6 bg-orange-50 dark:bg-orange-900/20 rounded-xl">
                                <div className="text-3xl mb-3">👨‍🎓</div>
                                <h4 className="font-bold text-orange-900 dark:text-orange-100 mb-2">Student</h4>
                                <p className="text-sm text-orange-700 dark:text-orange-200">
                                    Access personal schedule, view grades, and track own progress
                                </p>
                            </div>
                        </div>
                    </div>

                    {/* Recent Activities */}
                    {recent_activities && recent_activities.length > 0 && (
                        <div className="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                            <h3 className="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                                📈 Recent System Activity
                            </h3>
                            <div className="space-y-4">
                                {recent_activities.map((activity, index) => (
                                    <div key={index} className="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div className="text-2xl mr-4">{activity.icon}</div>
                                        <div className="flex-1">
                                            <p className="text-gray-900 dark:text-white font-medium">{activity.message}</p>
                                            <p className="text-sm text-gray-500 dark:text-gray-400">{activity.time}</p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    )}

                    {/* Call to Action */}
                    <div className="text-center mt-16">
                        <div className="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white">
                            <h3 className="text-3xl font-bold mb-4">Ready to Get Started? 🚀</h3>
                            <p className="text-xl mb-6 opacity-90">
                                Join thousands of schools already using our platform to streamline their administration
                            </p>
                            {!auth.user && (
                                <div className="space-x-4">
                                    <Link
                                        href={route('register')}
                                        className="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition-colors inline-block"
                                    >
                                        Start Free Trial
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-600 transition-colors inline-block"
                                    >
                                        Sign In
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </main>

                {/* Footer */}
                <footer className="bg-white dark:bg-gray-800 mt-16">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        <div className="text-center text-gray-600 dark:text-gray-300">
                            <p className="mb-2">🏫 Elementary School Administration System</p>
                            <p className="text-sm">
                                Built with ❤️ by{" "}
                                <a 
                                    href="https://app.build" 
                                    target="_blank" 
                                    className="font-medium text-blue-600 hover:underline dark:text-blue-400"
                                >
                                    app.build
                                </a>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}