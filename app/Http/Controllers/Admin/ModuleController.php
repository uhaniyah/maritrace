<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function create($courseId)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $course = Course::findOrFail($courseId);
        return view('admin.modules.create', compact('course'));
    }

    public function store(Request $request, $courseId)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $course = Course::findOrFail($courseId);

        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'type'           => 'required|in:Theory,Practical,Simulation,Assessment',
            'description'    => 'nullable|string',
            'content'        => 'nullable|string',
            'duration_hours' => 'required|numeric|min:0.5',
            'order_number'   => 'required|integer|min:1',
            'is_mandatory'   => 'boolean',
        ]);

        $validated['course_id'] = $course->id;
        $validated['is_mandatory'] = $request->boolean('is_mandatory', true);

        Module::create($validated);
        return redirect()->route('admin.courses.show', $courseId)->with('success', 'Modul berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $module = Module::with('course')->findOrFail($id);
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $module = Module::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'type'           => 'required|in:Theory,Practical,Simulation,Assessment',
            'description'    => 'nullable|string',
            'content'        => 'nullable|string',
            'duration_hours' => 'required|numeric|min:0.5',
            'order_number'   => 'required|integer|min:1',
            'is_mandatory'   => 'boolean',
        ]);

        $validated['is_mandatory'] = $request->boolean('is_mandatory', true);
        $module->update($validated);

        return redirect()->route('admin.courses.show', $module->course_id)->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $module = Module::findOrFail($id);
        $courseId = $module->course_id;
        $module->delete();
        return redirect()->route('admin.courses.show', $courseId)->with('success', 'Modul berhasil dihapus.');
    }
}