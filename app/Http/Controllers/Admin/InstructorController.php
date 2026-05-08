<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $query = Instructor::withCount('courses');

        if (request('search')) {
            $query->where('full_name', 'like', '%' . request('search') . '%')
                  ->orWhere('employee_id', 'like', '%' . request('search') . '%');
        }
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $instructors = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.instructors.index', compact('instructors'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        return view('admin.instructors.create');
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $validated = $request->validate([
            'employee_id'      => 'required|string|max:50|unique:instructors',
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|unique:instructors',
            'phone'            => 'nullable|string|max:20',
            'specialization'   => 'required|string|max:255',
            'qualifications'   => 'nullable|string',
            'certificates_held'=> 'nullable|string',
            'years_experience' => 'required|integer|min:0',
            'status'           => 'required|in:active,inactive',
        ]);

        Instructor::create($validated);
        return redirect()->route('admin.instructors.index')->with('success', 'Instruktur berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $instructor = Instructor::with('courses')->findOrFail($id);
        return view('admin.instructors.show', compact('instructor'));
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $instructor = Instructor::findOrFail($id);
        return view('admin.instructors.edit', compact('instructor'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $instructor = Instructor::findOrFail($id);

        $validated = $request->validate([
            'employee_id'      => 'required|string|max:50|unique:instructors,employee_id,' . $id,
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|unique:instructors,email,' . $id,
            'phone'            => 'nullable|string|max:20',
            'specialization'   => 'required|string|max:255',
            'qualifications'   => 'nullable|string',
            'certificates_held'=> 'nullable|string',
            'years_experience' => 'required|integer|min:0',
            'status'           => 'required|in:active,inactive',
        ]);

        $instructor->update($validated);
        return redirect()->route('admin.instructors.index')->with('success', 'Data instruktur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Instructor::findOrFail($id)->delete();
        return redirect()->route('admin.instructors.index')->with('success', 'Instruktur berhasil dihapus.');
    }
}