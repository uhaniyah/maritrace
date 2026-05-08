@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview Sistem Manajemen Pendidikan Maritim')

@section('content')
<!-- Welcome Bar -->
<div class="bg-gradient-to-r from-blue-800 to-teal-700 rounded-2xl p-6 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold">Selamat datang, {{ session('admin_user', 'Admin') }}! 👋</h2>
            <p class="text-blue-200 text-sm mt-1">Sistem Manajemen Pembelajaran Maritim — Poltekpel Barombong</p>
        </div>
        <div class="text-right hidden md:block">
            <p class="text-blue-200 text-xs">{{ now()->format('l, d F Y') }}</p>
            <p class="font-bold text-lg">{{ now()->format('H:i') }} WIB</p>
        </div>
    </div>
</div>

<!-- KPI Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium">Total Kursus</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalCourses }}</p>
                <p class="text-xs text-green-600 mt-1"><i class="fas fa-circle text-green-500 mr-1"></i>{{ $activeCourses }} aktif</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-xl">📚</div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-teal-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium">Peserta Didik</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalStudents }}</p>
                <p class="text-xs text-green-600 mt-1"><i class="fas fa-circle text-green-500 mr-1"></i>{{ $activeStudents }} aktif</p>
            </div>
            <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 text-xl">👨‍🎓</div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-indigo-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium">Instruktur</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalInstructors }}</p>
                <p class="text-xs text-gray-400 mt-1">Bersertifikat STCW</p>
            </div>
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 text-xl">👨‍🏫</div>
        </div>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500 font-medium">Tingkat Selesai</p>
                <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $completionRate }}%</p>
                <p class="text-xs text-gray-400 mt-1">{{ $completedEnrollments }}/{{ $totalEnrollments }} kursus</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 text-xl">✅</div>
        </div>
    </div>
</div>

<!-- Second Row KPIs -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <p class="text-xs text-gray-500 font-medium mb-1">Sertifikat Valid</p>
        <p class="text-2xl font-bold text-gray-800">{{ $validCertificates }}</p>
        <p class="text-xs text-gray-400">dari {{ $totalCertificates }} total</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <p class="text-xs text-gray-500 font-medium mb-1">Kursus STCW</p>
        <p class="text-2xl font-bold text-blue-700">{{ $stcwCourses }}</p>
        <p class="text-xs text-gray-400">Program STCW aktif</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <p class="text-xs text-gray-500 font-medium mb-1">Kursus IMO</p>
        <p class="text-2xl font-bold text-teal-700">{{ $imoCourses }}</p>
        <p class="text-xs text-gray-400">IMO Model Courses</p>
    </div>
    @if($expiringSoon > 0)
    <div class="bg-orange-50 rounded-xl p-5 shadow-sm border border-orange-200">
        <p class="text-xs text-orange-600 font-medium mb-1">⚠️ Segera Kadaluarsa</p>
        <p class="text-2xl font-bold text-orange-700">{{ $expiringSoon }}</p>
        <p class="text-xs text-orange-500">Sertifikat ≤ 30 hari</p>
    </div>
    @else
    <div class="bg-white rounded-xl p-5 shadow-sm">
        <p class="text-xs text-gray-500 font-medium mb-1">Total Pendaftaran</p>
        <p class="text-2xl font-bold text-gray-800">{{ $totalEnrollments }}</p>
        <p class="text-xs text-gray-400">Semua batch</p>
    </div>
    @endif
</div>

<!-- Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Enrollments -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800">Pendaftaran Terbaru</h3>
            <a href="{{ route('admin.enrollments.index') }}" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Peserta</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Kursus</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentEnrollments as $enr)
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="px-4 py-3 text-sm">
                            <div class="font-medium text-gray-800">{{ $enr->student->full_name ?? '-' }}</div>
                            <div class="text-xs text-gray-400">{{ $enr->student->student_id ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ Str::limit($enr->course->title ?? '-', 25) }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full font-medium
                                {{ $enr->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $enr->status === 'in_progress' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $enr->status === 'enrolled' ? 'bg-gray-100 text-gray-700' : '' }}
                                {{ $enr->status === 'failed' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $enr->status === 'withdrawn' ? 'bg-orange-100 text-orange-700' : '' }}">{{ ucfirst($enr->status) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-4 py-8 text-center text-gray-400 text-sm">Belum ada pendaftaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Certificates -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800">Sertifikat Terbaru Diterbitkan</h3>
            <a href="{{ route('admin.certificates.index') }}" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Pemegang</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Program</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Berlaku s/d</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentCertificates as $cert)
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="px-4 py-3 text-sm">
                            <div class="font-medium text-gray-800">{{ $cert->student->full_name ?? '-' }}</div>
                            <div class="text-xs text-gray-400">{{ $cert->certificate_number }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ Str::limit($cert->course->title ?? '-', 25) }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="{{ $cert->status === 'valid' ? 'text-green-700' : 'text-red-600' }} font-medium">
                                {{ $cert->expiry_date ? $cert->expiry_date->format('d/m/Y') : '-' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-4 py-8 text-center text-gray-400 text-sm">Belum ada sertifikat</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
