@extends('layouts.admin')
@section('title', 'Kursus')
@section('page-title', 'Manajemen Kursus')
@section('page-subtitle', 'Program pelatihan berstandar STCW & IMO')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-2">
        <form method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kursus..." class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56 focus:ring-2 focus:ring-blue-500">
            <select name="standard_type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Standar</option>
                <option value="STCW" {{ request('standard_type') === 'STCW' ? 'selected' : '' }}>STCW</option>
                <option value="IMO" {{ request('standard_type') === 'IMO' ? 'selected' : '' }}>IMO</option>
                <option value="Internal" {{ request('standard_type') === 'Internal' ? 'selected' : '' }}>Internal</option>
            </select>
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700"><i class="fas fa-search"></i></button>
            <a href="{{ route('admin.courses.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Reset</a>
        </form>
    </div>
    <a href="{{ route('admin.courses.create') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-800 flex items-center">
        <i class="fas fa-plus mr-2"></i>Tambah Kursus
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse($courses as $course)
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden">
        <div class="h-2 {{ $course->standard_type === 'STCW' ? 'bg-blue-600' : ($course->standard_type === 'IMO' ? 'bg-teal-600' : 'bg-gray-400') }}"></div>
        <div class="p-5">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <span class="text-xs font-bold bg-gray-100 text-gray-600 px-2 py-1 rounded mr-1">{{ $course->course_code }}</span>
                    <span class="text-xs font-semibold px-2 py-1 rounded {{ $course->standard_type === 'STCW' ? 'bg-blue-100 text-blue-700' : ($course->standard_type === 'IMO' ? 'bg-teal-100 text-teal-700' : 'bg-gray-100 text-gray-600') }}">{{ $course->standard_type }}</span>
                </div>
                <span class="text-xs px-2 py-1 rounded-full {{ $course->status === 'active' ? 'bg-green-100 text-green-700' : ($course->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                    {{ ucfirst($course->status) }}
                </span>
            </div>
            <h3 class="font-bold text-gray-800 text-sm mb-2">{{ $course->title }}</h3>
            @if($course->imo_course_number)
            <p class="text-xs text-blue-500 mb-2">{{ $course->imo_course_number }}</p>
            @endif
            <div class="grid grid-cols-2 gap-2 text-xs text-gray-500 mb-4">
                <span><i class="fas fa-clock mr-1"></i>{{ $course->duration_hours }} jam / {{ $course->duration_days }} hari</span>
                <span><i class="fas fa-users mr-1"></i>Maks. {{ $course->max_participants }} peserta</span>
                <span><i class="fas fa-layer-group mr-1"></i>{{ $course->level }}</span>
                <span><i class="fas fa-check-circle mr-1"></i>Lulus: {{ $course->passing_score }}%</span>
            </div>
            @if($course->instructor)
            <p class="text-xs text-gray-500 mb-3"><i class="fas fa-chalkboard-teacher mr-1"></i>{{ $course->instructor->full_name }}</p>
            @endif
            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                <span class="text-xs text-gray-400">{{ $course->modules_count ?? $course->modules->count() }} modul</span>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.courses.show', $course->id) }}" class="text-xs text-blue-600 hover:underline">Detail</a>
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-xs text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kursus ini?')">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 text-gray-400">
        <i class="fas fa-book-open text-4xl mb-3 block"></i>
        Belum ada kursus. <a href="{{ route('admin.courses.create') }}" class="text-blue-600 hover:underline">Tambah kursus pertama</a>
    </div>
    @endforelse
</div>
<div class="mt-6">{{ $courses->appends(request()->query())->links() }}</div>
@endsection
