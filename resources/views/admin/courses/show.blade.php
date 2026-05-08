@extends('layouts.admin')
@section('title', $course->title)
@section('page-title', $course->title)
@section('page-subtitle', $course->course_code . ' — ' . $course->standard_type)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Course Info -->
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold bg-gray-100 px-2 py-1 rounded">{{ $course->course_code }}</span>
                        <span class="text-xs px-2 py-1 rounded {{ $course->standard_type === 'STCW' ? 'bg-blue-100 text-blue-700' : 'bg-teal-100 text-teal-700' }}">{{ $course->standard_type }}</span>
                        @if($course->imo_course_number)<span class="text-xs px-2 py-1 rounded bg-purple-100 text-purple-700">{{ $course->imo_course_number }}</span>@endif
                        <span class="text-xs px-2 py-1 rounded {{ $course->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($course->status) }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $course->title }}</h2>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600"><i class="fas fa-edit mr-1"></i>Edit</a>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
                <div class="bg-blue-50 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-blue-700">{{ $course->duration_hours }}</p>
                    <p class="text-xs text-gray-500">Jam</p>
                </div>
                <div class="bg-teal-50 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-teal-700">{{ $course->duration_days }}</p>
                    <p class="text-xs text-gray-500">Hari</p>
                </div>
                <div class="bg-indigo-50 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-indigo-700">{{ $course->max_participants }}</p>
                    <p class="text-xs text-gray-500">Maks. Peserta</p>
                </div>
                <div class="bg-green-50 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-green-700">{{ $course->passing_score }}%</p>
                    <p class="text-xs text-gray-500">Nilai Lulus</p>
                </div>
            </div>
            <div class="mb-4">
                <h4 class="font-semibold text-gray-700 mb-2">Deskripsi</h4>
                <p class="text-sm text-gray-600">{{ $course->description }}</p>
            </div>
            @if($course->objectives)
            <div class="mb-4">
                <h4 class="font-semibold text-gray-700 mb-2">Tujuan Pembelajaran</h4>
                <p class="text-sm text-gray-600">{{ $course->objectives }}</p>
            </div>
            @endif
            @if($course->prerequisites)
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Prasyarat</h4>
                <p class="text-sm text-gray-600">{{ $course->prerequisites }}</p>
            </div>
            @endif
        </div>

        <!-- Modules -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-800">Modul Kursus ({{ $course->modules->count() }})</h3>
                <a href="{{ route('admin.modules.create', $course->id) }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800"><i class="fas fa-plus mr-1"></i>Tambah Modul</a>
            </div>
            @forelse($course->modules as $module)
            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                <div class="flex items-center">
                    <span class="w-7 h-7 rounded-full bg-blue-100 text-blue-700 text-xs font-bold flex items-center justify-center mr-3">{{ $module->order_number }}</span>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $module->title }}</p>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-xs text-gray-400">{{ $module->type }}</span>
                            <span class="text-xs text-gray-400">• {{ $module->duration_hours }} jam</span>
                            @if($module->is_mandatory)<span class="text-xs text-red-500">• Wajib</span>@endif
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="text-xs text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus modul?')">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">Belum ada modul. <a href="{{ route('admin.modules.create', $course->id) }}" class="text-blue-600 hover:underline">Tambah modul pertama</a></p>
            @endforelse
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h4 class="font-bold text-gray-700 mb-4">Informasi Kursus</h4>
            <dl class="space-y-3 text-sm">
                <div><dt class="text-gray-500">Kategori</dt><dd class="font-medium">{{ $course->category }}</dd></div>
                <div><dt class="text-gray-500">Level</dt><dd class="font-medium">{{ $course->level }}</dd></div>
                <div><dt class="text-gray-500">Instruktur</dt><dd class="font-medium">{{ $course->instructor->full_name ?? 'Belum ditetapkan' }}</dd></div>
                @if($course->fee)
                <div><dt class="text-gray-500">Biaya</dt><dd class="font-medium">Rp {{ number_format($course->fee, 0, ',', '.') }}</dd></div>
                @endif
            </dl>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h4 class="font-bold text-gray-700 mb-3">Statistik</h4>
            <div class="space-y-3">
                <div class="flex justify-between text-sm"><span class="text-gray-500">Total Pendaftar</span><span class="font-bold">{{ $course->enrollments->count() }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-gray-500">Selesai</span><span class="font-bold text-green-600">{{ $course->enrollments->where('status','completed')->count() }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-gray-500">Berlangsung</span><span class="font-bold text-blue-600">{{ $course->enrollments->where('status','in_progress')->count() }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
