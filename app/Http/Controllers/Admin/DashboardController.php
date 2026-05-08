<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Enrollment;
use App\Models\Certificate;
use App\Models\Assessment;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $totalCourses = Course::count();
        $activeCourses = Course::where('status', 'active')->count();
        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'active')->count();
        $totalInstructors = Instructor::count();
        $totalEnrollments = Enrollment::count();
        $completedEnrollments = Enrollment::where('status', 'completed')->count();
        $totalCertificates = Certificate::count();
        $validCertificates = Certificate::where('status', 'valid')->count();
        $expiringSoon = Certificate::where('status', 'valid')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();
        $completionRate = $totalEnrollments > 0 ? round(($completedEnrollments / $totalEnrollments) * 100, 1) : 0;

        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $recentCertificates = Certificate::with(['student', 'course'])
            ->orderBy('issued_date', 'desc')
            ->limit(5)
            ->get();

        $stcwCourses = Course::where('standard_type', 'STCW')->count();
        $imoCourses = Course::where('standard_type', 'IMO')->count();

        $coursesByCategory = Course::selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->get();

        return view('admin.dashboard', compact(
            'totalCourses', 'activeCourses', 'totalStudents', 'activeStudents',
            'totalInstructors', 'totalEnrollments', 'completedEnrollments',
            'totalCertificates', 'validCertificates', 'expiringSoon',
            'completionRate', 'recentEnrollments', 'recentCertificates',
            'stcwCourses', 'imoCourses', 'coursesByCategory'
        ));
    }
}