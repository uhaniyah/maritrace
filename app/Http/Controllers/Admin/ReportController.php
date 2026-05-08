<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Certificate;
use App\Models\Assessment;

class ReportController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        return view('admin.reports.index');
    }

    public function stcwCompliance()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $stcwCourses = Course::where('standard_type', 'STCW')->withCount(['enrollments', 'enrollments as completed_count' => function($q) {
            $q->where('status', 'completed');
        }])->get();

        $totalStcwEnrollments = Enrollment::whereHas('course', function($q) {
            $q->where('standard_type', 'STCW');
        })->count();

        $completedStcwEnrollments = Enrollment::where('status', 'completed')->whereHas('course', function($q) {
            $q->where('standard_type', 'STCW');
        })->count();

        $stcwCompliance = $totalStcwEnrollments > 0
            ? round(($completedStcwEnrollments / $totalStcwEnrollments) * 100, 1)
            : 0;

        $validStcwCertificates = Certificate::where('status', 'valid')->whereHas('course', function($q) {
            $q->where('standard_type', 'STCW');
        })->count();

        return view('admin.reports.stcw', compact(
            'stcwCourses', 'totalStcwEnrollments', 'completedStcwEnrollments',
            'stcwCompliance', 'validStcwCertificates'
        ));
    }

    public function courseCompletion()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $courses = Course::withCount([
            'enrollments',
            'enrollments as completed_count' => fn($q) => $q->where('status', 'completed'),
            'enrollments as in_progress_count' => fn($q) => $q->where('status', 'in_progress'),
            'enrollments as failed_count' => fn($q) => $q->where('status', 'failed'),
        ])->where('status', 'active')->get();

        $overallCompletion = Enrollment::count() > 0
            ? round((Enrollment::where('status', 'completed')->count() / Enrollment::count()) * 100, 1)
            : 0;

        return view('admin.reports.completion', compact('courses', 'overallCompletion'));
    }

    public function certificates()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $totalCertificates = Certificate::count();
        $validCerts = Certificate::where('status', 'valid')->count();
        $expiredCerts = Certificate::where('status', 'expired')->count();
        $expiringSoon = Certificate::where('status', 'valid')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->with(['student', 'course'])
            ->get();

        $certsByType = Certificate::with('course')
            ->get()
            ->groupBy(fn($c) => $c->course->standard_type ?? 'Unknown');

        return view('admin.reports.certificates', compact(
            'totalCertificates', 'validCerts', 'expiredCerts', 'expiringSoon', 'certsByType'
        ));
    }
}