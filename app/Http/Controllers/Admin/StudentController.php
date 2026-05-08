<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index(): View
    {
        $query = Student::withCount(['enrollments', 'certificates']);

        if (request('search')) {
            $query->where('full_name', 'like', '%'.request('search').'%')
                ->orWhere('student_id', 'like', '%'.request('search').'%')
                ->orWhere('email', 'like', '%'.request('search').'%');
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

    /**
     * Show the form for creating a new student.
     */
    public function create(): View
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:50|unique:students',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string|max:100',
            'rank' => 'required|string|max:100',
            'seaman_book' => 'nullable|string|max:100',
            'seaman_book_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'company' => 'nullable|string|max:255',
            'vessel_type' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,graduated',
        ]);

        if ($request->hasFile('seaman_book_file')) {
            $path = $request->file('seaman_book_file')->store('seaman_books', 'public');
            $validated['seaman_book_path'] = $path;
        }

        Student::create($validated);

        return redirect()->route('admin.students.index')->with('success', 'Peserta didik berhasil ditambahkan.');
    }

    /**
     * Display the specified student.
     */
    public function show(int $id): View
    {
        $student = Student::with(['enrollments.course', 'certificates.course'])->findOrFail($id);

        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(int $id): View
    {
        $student = Student::findOrFail($id);

        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|string|max:50|unique:students,student_id,'.$id,
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string|max:100',
            'rank' => 'required|string|max:100',
            'seaman_book' => 'nullable|string|max:100',
            'seaman_book_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'company' => 'nullable|string|max:255',
            'vessel_type' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,graduated',
        ]);

        if ($request->hasFile('seaman_book_file')) {
            // Delete old file if exists
            if ($student->seaman_book_path) {
                Storage::disk('public')->delete($student->seaman_book_path);
            }

            $path = $request->file('seaman_book_file')->store('seaman_books', 'public');
            $validated['seaman_book_path'] = $path;
        }

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', 'Data peserta didik berhasil diperbarui.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        if ($student->seaman_book_path) {
            Storage::disk('public')->delete($student->seaman_book_path);
        }

        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Peserta didik berhasil dihapus.');
    }
}
