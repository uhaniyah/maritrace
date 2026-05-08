@extends('layouts.admin')
@section('title', $student->full_name)
@section('page-title', $student->full_name)
@section('page-subtitle', $student->student_id . ' — ' . $student->rank)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm p-6 text-center">
            <div class="w-20 h-20 rounded-full bg-blue-600 text-white text-3xl font-bold flex items-center justify-center mx-auto mb-4">{{ strtoupper(substr($student->full_name, 0, 1)) }}</div>
            <h2 class="font-bold text-gray-800 text-lg">{{ $student->full_name }}</h2>
            <p class="text-sm text-gray-500">{{ $student->rank }}</p>
            <span class="mt-2 inline-block text-xs px-3 py-1 rounded-full {{ $student->status === 'active' ? 'bg-green-100 text-green-700' : ($student->status === 'graduated' ? 'bg-purple-100 text-purple-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($student->status) }}</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h4 class="font-bold text-gray-700 mb-4">Data Pelaut</h4>
            <dl class="space-y-3 text-sm">
                <div><dt class="text-gray-400 text-xs">NIM</dt><dd class="font-medium">{{ $student->student_id }}</dd></div>
                <div><dt class="text-gray-400 text-xs">Email</dt><dd class="font-medium text-blue-600">{{ $student->email }}</dd></div>
                <div><dt class="text-gray-400 text-xs">Telepon</dt><dd class="font-medium">{{ $student->phone ?? '-' }}</dd></div>
                <div><dt class="text-gray-400 text-xs">Tgl. Lahir</dt><dd class="font-medium">{{ $student->date_of_birth?->format('d M Y') ?? '-' }}</dd></div>
                <div><dt class="text-gray-400 text-xs">Kewarganegaraan</dt><dd class="font-medium">{{ $student->nationality }}</dd></div>
                <div>
                    <dt class="text-gray-400 text-xs">Buku Pelaut</dt>
                    <dd class="font-medium">
                        {{ $student->seaman_book ?? '-' }}
                        @if($student->seaman_book_path)
                        <a href="{{ $student->seaman_book_url }}" target="_blank" class="ml-2 text-blue-600 hover:underline" title="Lihat Dokumen"><i class="fas fa-external-link-alt text-[10px]"></i></a>
                        @endif
                    </dd>
                </div>
                @if($student->company)<div><dt class="text-gray-400 text-xs">Perusahaan</dt><dd class="font-medium">{{ $student->company }}</dd></div>@endif
                @if($student->vessel_type)<div><dt class="text-gray-400 text-xs">Jenis Kapal</dt><dd class="font-medium">{{ $student->vessel_type }}</dd></div>@endif
            </dl>
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('admin.students.edit', $student->id) }}" class="w-full block text-center bg-blue-700 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-800">Edit Data</a>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-5">
        <!-- Enrollments -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b"><h3 class="font-bold text-gray-800">Riwayat Kursus ({{ $student->enrollments->count() }})</h3></div>
            <table class="w-full">
                <thead class="bg-gray-50"><tr>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">Kursus</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">Periode</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">Nilai</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($student->enrollments as $enr)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 text-sm font-medium">{{ $enr->course->title ?? '-' }}</td>
                        <td class="px-5 py-3 text-xs text-gray-500">{{ $enr->start_date?->format('d/m/Y') }} — {{ $enr->end_date?->format('d/m/Y') }}</td>
                        <td class="px-5 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $enr->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">{{ ucfirst($enr->status) }}</span></td>
                        <td class="px-5 py-3 text-sm font-medium">{{ $enr->final_score ? $enr->final_score . '%' : '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-5 py-6 text-center text-gray-400 text-sm">Belum ada riwayat kursus</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Certificates -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b"><h3 class="font-bold text-gray-800">Sertifikat ({{ $student->certificates->count() }})</h3></div>
            <table class="w-full">
                <thead class="bg-gray-50"><tr>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">No. Sertifikat</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">Program</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">Berlaku s/d</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($student->certificates as $cert)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 text-xs font-mono">{{ $cert->certificate_number }}</td>
                        <td class="px-5 py-3 text-sm">{{ $cert->course->title ?? '-' }}</td>
                        <td class="px-5 py-3 text-sm">{{ $cert->expiry_date?->format('d/m/Y') }}</td>
                        <td class="px-5 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $cert->status === 'valid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($cert->status) }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-5 py-6 text-center text-gray-400 text-sm">Belum ada sertifikat</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
