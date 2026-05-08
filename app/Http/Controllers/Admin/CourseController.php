<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $query = Course::with(['instructor', 'modules']);

        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('course_code', 'like', '%' . request('search') . '%');
        }
        if (request('standard_type')) {
            $query->where('standard_type', request('standard_type'));
        }
        if (request('status')) {
            $query->where('status', request('status'));
        }
        if (request('category')) {
            $query->where('category', request('category'));
        }

        $courses = $query->orderBy('created_at', 'desc')->paginate(12);
        $instructors = Instructor::where('status', 'active')->get();

        return view('admin.courses.index', compact('courses', 'instructors'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $instructors = Instructor::where('status', 'active')->get();
        return view('admin.courses.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $validated = $request->validate([
            'course_code'       => 'required|string|max:50|unique:courses',
            'title'             => 'required|string|max:255',
            'standard_type'     => 'required|in:STCW,IMO,Internal',
            'imo_course_number' => 'nullable|string|max:50',
            'category'          => 'required|string|max:100',
            'level'             => 'required|in:Basic,Operational,Management,Rating',
            'duration_hours'    => 'required|integer|min:1',
            'duration_days'     => 'required|integer|min:1',
            'description'       => 'required|string',
            'objectives'        => 'nullable|string',
            'prerequisites'     => 'nullable|string',
            'instructor_id'     => 'nullable|exists:instructors,id',
            'max_participants'  => 'required|integer|min:1',
            'passing_score'     => 'required|integer|min:0|max:100',
            'status'            => 'required|in:active,inactive,draft',
            'fee'               => 'nullable|numeric|min:0',
        ]);

        Course::create($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $course = Course::with(['instructor', 'modules', 'enrollments.student', 'assessments'])->findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $course = Course::findOrFail($id);
        $instructors = Instructor::where('status', 'active')->get();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'course_code'       => 'required|string|max:50|unique:courses,course_code,' . $id,
            'title'             => 'required|string|max:255',
            'standard_type'     => 'required|in:STCW,IMO,Internal',
            'imo_course_number' => 'nullable|string|max:50',
            'category'          => 'required|string|max:100',
            'level'             => 'required|in:Basic,Operational,Management,Rating',
            'duration_hours'    => 'required|integer|min:1',
            'duration_days'     => 'required|integer|min:1',
            'description'       => 'required|string',
            'objectives'        => 'nullable|string',
            'prerequisites'     => 'nullable|string',
            'instructor_id'     => 'nullable|exists:instructors,id',
            'max_participants'  => 'required|integer|min:1',
            'passing_score'     => 'required|integer|min:0|max:100',
            'status'            => 'required|in:active,inactive,draft',
            'fee'               => 'nullable|numeric|min:0',
        ]);

        $course->update($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Course::findOrFail($id)->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dihapus.');
    }
}