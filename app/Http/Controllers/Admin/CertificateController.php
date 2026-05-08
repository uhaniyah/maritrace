<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $query = Certificate::with(['student', 'course']);

        if (request('search')) {
            $query->where('certificate_number', 'like', '%' . request('search') . '%')
                  ->orWhereHas('student', function($q) {
                      $q->where('full_name', 'like', '%' . request('search') . '%');
                  });
        }
        if (request('status')) $query->where('status', request('status'));
        if (request('course_id')) $query->where('course_id', request('course_id'));
        if (request('expiring_soon')) {
            $query->where('status', 'valid')->where('expiry_date', '<=', now()->addDays(30));
        }

        $certificates = $query->orderBy('issued_date', 'desc')->paginate(15);
        $courses = Course::where('status', 'active')->get();
        return view('admin.certificates.index', compact('certificates', 'courses'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $students = Student::where('status', 'active')->orderBy('full_name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();
        return view('admin.certificates.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $validated = $request->validate([
            'student_id'         => 'required|exists:students,id',
            'course_id'          => 'required|exists:courses,id',
            'certificate_number' => 'required|string|max:100|unique:certificates',
            'issued_date'        => 'required|date',
            'expiry_date'        => 'required|date|after:issued_date',
            'issuing_authority'  => 'required|string|max:255',
            'stcw_regulation'    => 'nullable|string|max:255',
            'competency'         => 'nullable|string|max:255',
            'grade'              => 'nullable|string|max:50',
            'status'             => 'required|in:valid,expired,revoked,suspended',
            'notes'              => 'nullable|string',
        ]);

        Certificate::create($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diterbitkan.');
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $certificate = Certificate::with(['student', 'course'])->findOrFail($id);
        return view('admin.certificates.show', compact('certificate'));
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $certificate = Certificate::findOrFail($id);
        $students = Student::where('status', 'active')->orderBy('full_name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();
        return view('admin.certificates.edit', compact('certificate', 'students', 'courses'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $certificate = Certificate::findOrFail($id);

        $validated = $request->validate([
            'student_id'         => 'required|exists:students,id',
            'course_id'          => 'required|exists:courses,id',
            'certificate_number' => 'required|string|max:100|unique:certificates,certificate_number,' . $id,
            'issued_date'        => 'required|date',
            'expiry_date'        => 'required|date|after:issued_date',
            'issuing_authority'  => 'required|string|max:255',
            'stcw_regulation'    => 'nullable|string|max:255',
            'competency'         => 'nullable|string|max:255',
            'grade'              => 'nullable|string|max:50',
            'status'             => 'required|in:valid,expired,revoked,suspended',
            'notes'              => 'nullable|string',
        ]);

        $certificate->update($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Certificate::findOrFail($id)->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil dihapus.');
    }
}