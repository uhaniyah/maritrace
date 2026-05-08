@extends('layouts.admin')
@section('title', 'Instruktur')
@section('page-title', 'Manajemen Instruktur')
@section('page-subtitle', 'Instruktur bersertifikat STCW & IMO')

@section('content')
<div class="flex items-center justify-between mb-5">
    <form method="GET" class="flex items-center space-x-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari instruktur..." class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56">
        <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
        </select>
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm"><i class="fas fa-search"></i></button>
        <a href="{{ route('admin.instructors.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Reset</a>
    </form>
    <a href="{{ route('admin.instructors.create') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-800">
        <i class="fas fa-user-plus mr-2"></i>Tambah Instruktur
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @forelse($instructors as $instructor)
    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-5">
        <div class="flex items-start mb-4">
            <div class="w-12 h-12 rounded-full bg-indigo-600 text-white font-bold text-xl flex items-center justify-center mr-4 flex-shrink-0">{{ strtoupper(substr($instructor->full_name, 0, 1)) }}</div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-800">{{ $instructor->full_name }}</h3>
                <p class="text-xs text-gray-500">{{ $instructor->employee_id }}</p>
                <span class="mt-1 inline-block text-xs px-2 py-0.5 rounded-full {{ $instructor->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($instructor->status) }}</span>
            </div>
        </div>
        <div class="space-y-2 mb-4 text-sm">
            <p class="text-gray-600"><i class="fas fa-graduation-cap w-4 mr-2 text-gray-400"></i>{{ $instructor->specialization }}</p>
            <p class="text-gray-600"><i class="fas fa-briefcase w-4 mr-2 text-gray-400"></i>{{ $instructor->years_experience }} tahun pengalaman</p>
            <p class="text-gray-600"><i class="fas fa-book w-4 mr-2 text-gray-400"></i>{{ $instructor->courses_count }} kursus ditangani</p>
        </div>
        <div class="flex gap-2 pt-3 border-t border-gray-100">
            <a href="{{ route('admin.instructors.show', $instructor->id) }}" class="flex-1 text-center text-xs py-1.5 rounded bg-blue-50 text-blue-700 hover:bg-blue-100">Detail</a>
            <a href="{{ route('admin.instructors.edit', $instructor->id) }}" class="flex-1 text-center text-xs py-1.5 rounded bg-yellow-50 text-yellow-700 hover:bg-yellow-100">Edit</a>
            <form action="{{ route('admin.instructors.destroy', $instructor->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus instruktur ini?')">
                @csrf @method('DELETE')
                <button class="w-full text-xs py-1.5 rounded bg-red-50 text-red-700 hover:bg-red-100">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 text-gray-400"><i class="fas fa-chalkboard-teacher text-4xl mb-2 block"></i>Belum ada instruktur</div>
    @endforelse
</div>
<div class="mt-4">{{ $instructors->appends(request()->query())->links() }}</div>
@endsection
