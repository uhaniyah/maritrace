<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Courses (STCW/IMO)
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Course Modules
    Route::get('/courses/{courseId}/modules/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::post('/courses/{courseId}/modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('/modules/{id}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('/modules/{id}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('/modules/{id}', [ModuleController::class, 'destroy'])->name('modules.destroy');

    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Instructors
    Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors.index');
    Route::get('/instructors/create', [InstructorController::class, 'create'])->name('instructors.create');
    Route::post('/instructors', [InstructorController::class, 'store'])->name('instructors.store');
    Route::get('/instructors/{id}', [InstructorController::class, 'show'])->name('instructors.show');
    Route::get('/instructors/{id}/edit', [InstructorController::class, 'edit'])->name('instructors.edit');
    Route::put('/instructors/{id}', [InstructorController::class, 'update'])->name('instructors.update');
    Route::delete('/instructors/{id}', [InstructorController::class, 'destroy'])->name('instructors.destroy');

    // Enrollments
    Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::get('/enrollments/{id}', [EnrollmentController::class, 'show'])->name('enrollments.show');
    Route::put('/enrollments/{id}/status', [EnrollmentController::class, 'updateStatus'])->name('enrollments.updateStatus');
    Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

    // Assessments
    Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
    Route::get('/assessments/create', [AssessmentController::class, 'create'])->name('assessments.create');
    Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');
    Route::get('/assessments/{id}', [AssessmentController::class, 'show'])->name('assessments.show');
    Route::get('/assessments/{id}/edit', [AssessmentController::class, 'edit'])->name('assessments.edit');
    Route::put('/assessments/{id}', [AssessmentController::class, 'update'])->name('assessments.update');
    Route::delete('/assessments/{id}', [AssessmentController::class, 'destroy'])->name('assessments.destroy');

    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/create', [CertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/certificates/{id}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificates/{id}/edit', [CertificateController::class, 'edit'])->name('certificates.edit');
    Route::put('/certificates/{id}', [CertificateController::class, 'update'])->name('certificates.update');
    Route::delete('/certificates/{id}', [CertificateController::class, 'destroy'])->name('certificates.destroy');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/stcw-compliance', [ReportController::class, 'stcwCompliance'])->name('reports.stcw');
    Route::get('/reports/course-completion', [ReportController::class, 'courseCompletion'])->name('reports.completion');
    Route::get('/reports/certificates', [ReportController::class, 'certificates'])->name('reports.certificates');
});
