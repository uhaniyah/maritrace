<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $query = Assessment::with(['student', 'course']);

        if (request('search')) {
            $query->whereHas('student', function($q) {
                $q->where('full_name', 'like', '%' . request('search') . '%');
            });
        }
        if (request('course_id')) $query->where('course_id', request('course_id'));
        if (request('assessment_type')) $query->where('assessment_type', request('assessment_type'));
        if (request('result')) $query->where('result', request('result'));

        $assessments = $query->orderBy('assessment_date', 'desc')->paginate(15);
        $courses = Course::where('status', 'active')->get();
        return view('admin.assessments.index', compact('assessments', 'courses'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $students = Student::where('status', 'active')->orderBy('full_name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();
        return view('admin.assessments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $validated = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'course_id'       => 'required|exists:courses,id',
            'assessment_type' => 'required|in:Written,Practical,Oral,Simulation,GMDSS,Firefighting,Survival,Medical,BRM',
            'assessment_date' => 'required|date',
            'score'           => 'required|numeric|min:0|max:100',
            'max_score'       => 'required|numeric|min:1',
            'passing_score'   => 'required|numeric|min:0|max:100',
            'assessor_name'   => 'required|string|max:255',
            'remarks'         => 'nullable|string',
            'attempt_number'  => 'required|integer|min:1',
        ]);

        $validated['result'] = $validated['score'] >= $validated['passing_score'] ? 'pass' : 'fail';
        Assessment::create($validated);
        return redirect()->route('admin.assessments.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $assessment = Assessment::with(['student', 'course'])->findOrFail($id);
        return view('admin.assessments.show', compact('assessment'));
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $assessment = Assessment::findOrFail($id);
        $students = Student::where('status', 'active')->orderBy('full_name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();
        return view('admin.assessments.edit', compact('assessment', 'students', 'courses'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $assessment = Assessment::findOrFail($id);

        $validated = $request->validate([
            'student_id'      => 'required|exists:students,id',
            'course_id'       => 'required|exists:courses,id',
            'assessment_type' => 'required|in:Written,Practical,Oral,Simulation,GMDSS,Firefighting,Survival,Medical,BRM',
            'assessment_date' => 'required|date',
            'score'           => 'required|numeric|min:0|max:100',
            'max_score'       => 'required|numeric|min:1',
            'passing_score'   => 'required|numeric|min:0|max:100',
            'assessor_name'   => 'required|string|max:255',
            'remarks'         => 'nullable|string',
            'attempt_number'  => 'required|integer|min:1',
        ]);

        $validated['result'] = $validated['score'] >= $validated['passing_score'] ? 'pass' : 'fail';
        $assessment->update($validated);
        return redirect()->route('admin.assessments.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Assessment::findOrFail($id)->delete();
        return redirect()->route('admin.assessments.index')->with('success', 'Penilaian berhasil dihapus.');
    }
}