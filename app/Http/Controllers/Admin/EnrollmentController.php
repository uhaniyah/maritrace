<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $query = Enrollment::with(['student', 'course']);

        if (request('search')) {
            $query->whereHas('student', function($q) {
                $q->where('full_name', 'like', '%' . request('search') . '%')
                  ->orWhere('student_id', 'like', '%' . request('search') . '%');
            });
        }
        if (request('status')) {
            $query->where('status', request('status'));
        }
        if (request('course_id')) {
            $query->where('course_id', request('course_id'));
        }

        $enrollments = $query->orderBy('created_at', 'desc')->paginate(15);
        $courses = Course::where('status', 'active')->get();
        return view('admin.enrollments.index', compact('enrollments', 'courses'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $students = Student::where('status', 'active')->orderBy('full_name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();
        return view('admin.enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $validated = $request->validate([
            'student_id'   => 'required|exists:students,id',
            'course_id'    => 'required|exists:courses,id',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after:start_date',
            'batch_number' => 'nullable|string|max:50',
            'notes'        => 'nullable|string',
        ]);

        $exists = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->whereIn('status', ['enrolled', 'in_progress'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['student_id' => 'Peserta sudah terdaftar di kursus ini.'])->withInput();
        }

        $validated['status'] = 'enrolled';
        Enrollment::create($validated);
        return redirect()->route('admin.enrollments.index')->with('success', 'Pendaftaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $enrollment = Enrollment::with(['student', 'course.modules'])->findOrFail($id);
        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $enrollment = Enrollment::findOrFail($id);

        $request->validate([
            'status'         => 'required|in:enrolled,in_progress,completed,failed,withdrawn',
            'final_score'    => 'nullable|numeric|min:0|max:100',
            'completion_date'=> 'nullable|date',
        ]);

        $enrollment->update([
            'status'          => $request->status,
            'final_score'     => $request->final_score,
            'completion_date' => $request->completion_date,
        ]);

        return redirect()->route('admin.enrollments.show', $id)->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Enrollment::findOrFail($id)->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
}