@extends('layouts.admin')
@section('title', 'Peserta Didik')
@section('page-title', 'Manajemen Peserta Didik')
@section('page-subtitle', 'Daftar taruna dan pelaut peserta pelatihan')

@section('content')
<div class="flex items-center justify-between mb-5">
    <form method="GET" class="flex items-center space-x-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / NIM / email..." class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-64 focus:ring-2 focus:ring-blue-500">
        <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            <option value="graduated" {{ request('status') === 'graduated' ? 'selected' : '' }}>Lulus</option>
        </select>
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm"><i class="fas fa-search"></i></button>
        <a href="{{ route('admin.students.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Reset</a>
    </form>
    <a href="{{ route('admin.students.create') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-800">
        <i class="fas fa-user-plus mr-2"></i>Tambah Peserta
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Peserta</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jabatan</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kewarganegaraan</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kursus</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($students as $student)
            <tr class="hover:bg-gray-50 transition-all">
                <td class="px-5 py-4">
                    <div class="flex items-center">
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white text-sm font-bold flex items-center justify-center mr-3">{{ strtoupper(substr($student->full_name, 0, 1)) }}</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $student->full_name }}</p>
                            <p class="text-xs text-gray-400">{{ $student->student_id }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-sm text-gray-600">{{ $student->rank }}</td>
                <td class="px-5 py-4 text-sm text-gray-600">{{ $student->nationality }}</td>
                <td class="px-5 py-4 text-sm">
                    <span class="bg-blue-50 text-blue-700 text-xs px-2 py-0.5 rounded font-medium">{{ $student->enrollments_count }} kursus</span>
                </td>
                <td class="px-5 py-4">
                    <span class="text-xs px-2 py-1 rounded-full font-medium
                        {{ $student->status === 'active' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $student->status === 'inactive' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $student->status === 'graduated' ? 'bg-purple-100 text-purple-700' : '' }}">{{ ucfirst($student->status) }}</span>
                </td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.students.show', $student->id) }}" class="text-xs text-blue-600 hover:underline mr-2">Detail</a>
                    <a href="{{ route('admin.students.edit', $student->id) }}" class="text-xs text-yellow-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus peserta ini?')">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-12 text-center text-gray-400"><i class="fas fa-users text-3xl mb-2 block"></i>Belum ada peserta didik</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $students->appends(request()->query())->links() }}</div>
@endsection
