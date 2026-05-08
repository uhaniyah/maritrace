<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/', function () { return view('welcome'); });

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Courses (STCW/IMO)
Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');
Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
Route::post('/admin/courses', [CourseController::class, 'store'])->name('admin.courses.store');
Route::get('/admin/courses/{id}', [CourseController::class, 'show'])->name('admin.courses.show');
Route::get('/admin/courses/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
Route::put('/admin/courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
Route::delete('/admin/courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');

// Course Modules
Route::get('/admin/courses/{courseId}/modules/create', [ModuleController::class, 'create'])->name('admin.modules.create');
Route::post('/admin/courses/{courseId}/modules', [ModuleController::class, 'store'])->name('admin.modules.store');
Route::get('/admin/modules/{id}/edit', [ModuleController::class, 'edit'])->name('admin.modules.edit');
Route::put('/admin/modules/{id}', [ModuleController::class, 'update'])->name('admin.modules.update');
Route::delete('/admin/modules/{id}', [ModuleController::class, 'destroy'])->name('admin.modules.destroy');

// Students
Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students.index');
Route::get('/admin/students/create', [StudentController::class, 'create'])->name('admin.students.create');
Route::post('/admin/students', [StudentController::class, 'store'])->name('admin.students.store');
Route::get('/admin/students/{id}', [StudentController::class, 'show'])->name('admin.students.show');
Route::get('/admin/students/{id}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
Route::put('/admin/students/{id}', [StudentController::class, 'update'])->name('admin.students.update');
Route::delete('/admin/students/{id}', [StudentController::class, 'destroy'])->name('admin.students.destroy');

// Instructors
Route::get('/admin/instructors', [InstructorController::class, 'index'])->name('admin.instructors.index');
Route::get('/admin/instructors/create', [InstructorController::class, 'create'])->name('admin.instructors.create');
Route::post('/admin/instructors', [InstructorController::class, 'store'])->name('admin.instructors.store');
Route::get('/admin/instructors/{id}', [InstructorController::class, 'show'])->name('admin.instructors.show');
Route::get('/admin/instructors/{id}/edit', [InstructorController::class, 'edit'])->name('admin.instructors.edit');
Route::put('/admin/instructors/{id}', [InstructorController::class, 'update'])->name('admin.instructors.update');
Route::delete('/admin/instructors/{id}', [InstructorController::class, 'destroy'])->name('admin.instructors.destroy');

// Enrollments
Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollments.index');
Route::get('/admin/enrollments/create', [EnrollmentController::class, 'create'])->name('admin.enrollments.create');
Route::post('/admin/enrollments', [EnrollmentController::class, 'store'])->name('admin.enrollments.store');
Route::get('/admin/enrollments/{id}', [EnrollmentController::class, 'show'])->name('admin.enrollments.show');
Route::put('/admin/enrollments/{id}/status', [EnrollmentController::class, 'updateStatus'])->name('admin.enrollments.updateStatus');
Route::delete('/admin/enrollments/{id}', [EnrollmentController::class, 'destroy'])->name('admin.enrollments.destroy');

// Assessments
Route::get('/admin/assessments', [AssessmentController::class, 'index'])->name('admin.assessments.index');
Route::get('/admin/assessments/create', [AssessmentController::class, 'create'])->name('admin.assessments.create');
Route::post('/admin/assessments', [AssessmentController::class, 'store'])->name('admin.assessments.store');
Route::get('/admin/assessments/{id}', [AssessmentController::class, 'show'])->name('admin.assessments.show');
Route::get('/admin/assessments/{id}/edit', [AssessmentController::class, 'edit'])->name('admin.assessments.edit');
Route::put('/admin/assessments/{id}', [AssessmentController::class, 'update'])->name('admin.assessments.update');
Route::delete('/admin/assessments/{id}', [AssessmentController::class, 'destroy'])->name('admin.assessments.destroy');

// Certificates
Route::get('/admin/certificates', [CertificateController::class, 'index'])->name('admin.certificates.index');
Route::get('/admin/certificates/create', [CertificateController::class, 'create'])->name('admin.certificates.create');
Route::post('/admin/certificates', [CertificateController::class, 'store'])->name('admin.certificates.store');
Route::get('/admin/certificates/{id}', [CertificateController::class, 'show'])->name('admin.certificates.show');
Route::get('/admin/certificates/{id}/edit', [CertificateController::class, 'edit'])->name('admin.certificates.edit');
Route::put('/admin/certificates/{id}', [CertificateController::class, 'update'])->name('admin.certificates.update');
Route::delete('/admin/certificates/{id}', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');

// Reports
Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
Route::get('/admin/reports/stcw-compliance', [ReportController::class, 'stcwCompliance'])->name('admin.reports.stcw');
Route::get('/admin/reports/course-completion', [ReportController::class, 'courseCompletion'])->name('admin.reports.completion');
Route::get('/admin/reports/certificates', [ReportController::class, 'certificates'])->name('admin.reports.certificates');