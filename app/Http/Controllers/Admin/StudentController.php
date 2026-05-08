<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Certificate;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $query = Student::withCount(['enrollments', 'certificates']);

        if (request('search')) {
            $query->where('full_name', 'like', '%' . request('search') . '%')
                  ->orWhere('student_id', 'like', '%' . request('search') . '%')
                  ->orWhere('email', 'like', '%' . request('search') . '%');
        }
        if (request('status')) {
            $query->where('status', request('status'));
        }
        if (request('rank')) {
            $query->where('rank', request('rank'));
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $validated = $request->validate([
            'student_id'    => 'required|string|max:50|unique:students',
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:students',
            'phone'         => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'nationality'   => 'required|string|max:100',
            'rank'          => 'required|string|max:100',
            'seaman_book'   => 'nullable|string|max:100',
            'company'       => 'nullable|string|max:255',
            'vessel_type'   => 'nullable|string|max:100',
            'address'       => 'nullable|string',
            'status'        => 'required|in:active,inactive,graduated',
        ]);

        Student::create($validated);
        return redirect()->route('admin.students.index')->with('success', 'Peserta didik berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $student = Student::with(['enrollments.course', 'certificates.course'])->findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'student_id'    => 'required|string|max:50|unique:students,student_id,' . $id,
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email,' . $id,
            'phone'         => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'nationality'   => 'required|string|max:100',
            'rank'          => 'required|string|max:100',
            'seaman_book'   => 'nullable|string|max:100',
            'company'       => 'nullable|string|max:255',
            'vessel_type'   => 'nullable|string|max:100',
            'address'       => 'nullable|string',
            'status'        => 'required|in:active,inactive,graduated',
        ]);

        $student->update($validated);
        return redirect()->route('admin.students.index')->with('success', 'Data peserta didik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Student::findOrFail($id)->delete();
        return redirect()->route('admin.students.index')->with('success', 'Peserta didik berhasil dihapus.');
    }
}