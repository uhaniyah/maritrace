<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CertificateController extends Controller
{
    /**
     * Display a listing of certificates.
     */
    public function index(): View
    {
        $query = Certificate::with(['student', 'course']);

        if (request('search')) {
            $query->where('certificate_number', 'like', '%'.request('search').'%')
                ->orWhereHas('student', function ($q) {
                    $q->where('full_name', 'like', '%'.request('search').'%');
                });
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('course_id')) {
            $query->where('course_id', request('course_id'));
        }

        if (request('expiring_soon')) {
            $query->where('status', 'valid')->where('expiry_date', '<=', now()->addDays(30));
        }

        $certificates = $query->orderBy('issued_date', 'desc')->paginate(15);
        $courses = Course::where('status', 'active')->get();

        return view('admin.certificates.index', compact('certificates', 'courses'));
    }

    /**
     * Show the form for creating a new certificate.
     */
    public function create(): View
    {
        $students = Student::where('status', 'active')->orderBy('full_name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();

        return view('admin.certificates.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created certificate in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'certificate_number' => 'required|string|max:100|unique:certificates',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date|after:issued_date',
            'issuing_authority' => 'required|string|max:255',
            'stcw_regulation' => 'nullable|string|max:255',
            'competency' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:50',
            'status' => 'required|in:valid,expired,revoked,suspended',
            'notes' => 'nullable|string',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('certificate_file')) {
            $path = $request->file('certificate_file')->store('certificates', 'public');
            $validated['file_path'] = $path;
        }

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diterbitkan.');
    }

    /**
     * Display the specified certificate.
     */
    public function show(int $id): View
    {
        $certificate = Certificate::with(['student', 'course'])->findOrFail($id);

        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified certificate.
     */
    public function edit(int $id): View
    {
        $certificate = Certificate::findOrFail($id);
        $students = Student::where('status', 'active')->orderBy('full_name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();

        return view('admin.certificates.edit', compact('certificate', 'students', 'courses'));
    }

    /**
     * Update the specified certificate in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $certificate = Certificate::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'certificate_number' => 'required|string|max:100|unique:certificates,certificate_number,'.$id,
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date|after:issued_date',
            'issuing_authority' => 'required|string|max:255',
            'stcw_regulation' => 'nullable|string|max:255',
            'competency' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:50',
            'status' => 'required|in:valid,expired,revoked,suspended',
            'notes' => 'nullable|string',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('certificate_file')) {
            // Delete old file if exists
            if ($certificate->file_path) {
                Storage::disk('public')->delete($certificate->file_path);
            }

            $path = $request->file('certificate_file')->store('certificates', 'public');
            $validated['file_path'] = $path;
        }

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    /**
     * Remove the specified certificate from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $certificate = Certificate::findOrFail($id);

        if ($certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil dihapus.');
    }
}
