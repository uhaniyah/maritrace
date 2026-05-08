@extends('layouts.app')

@section('title', 'Poltekpel Barombong — Maritime LMS')

@section('content')
<!-- Navigation -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center">
            <span class="text-3xl mr-3">⚓</span>
            <div>
                <h1 class="font-bold text-gray-800 text-lg leading-tight">Poltekpel Barombong</h1>
                <p class="text-xs text-gray-500">Maritime Learning Management System</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="hidden md:inline text-sm text-gray-600">STCW & IMO Compliant</span>
            <a href="{{ route('admin.login') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-800 transition-all">
                <i class="fas fa-sign-in-alt mr-2"></i>Login Admin
            </a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="bg-gradient-to-br from-blue-900 via-blue-800 to-teal-700 text-white py-24">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">🌊 Berstandar STCW 2010 Manila Amendments & IMO Model Courses</span>
                <h1 class="text-5xl font-extrabold leading-tight mb-6">Platform Pendidikan Maritim Terdepan</h1>
                <p class="text-xl text-blue-100 mb-8">Sistem manajemen pembelajaran maritim terintegrasi untuk Politeknik Pelayaran Barombong — memenuhi standar STCW Convention, IMO Courses, dan regulasi pelayaran internasional.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.login') }}" class="bg-white text-blue-900 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition-all shadow-lg">
                        <i class="fas fa-tachometer-alt mr-2"></i>Akses Dashboard
                    </a>
                    <a href="#programs" class="border-2 border-white text-white px-8 py-3 rounded-xl font-bold hover:bg-white/10 transition-all">
                        <i class="fas fa-book-open mr-2"></i>Lihat Program
                    </a>
                </div>
            </div>
            <div class="hidden md:grid grid-cols-2 gap-4">
                <div class="bg-white/10 backdrop-blur rounded-xl p-5 text-center">
                    <div class="text-4xl font-extrabold">12+</div>
                    <div class="text-blue-200 text-sm mt-1">Program STCW/IMO</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-5 text-center">
                    <div class="text-4xl font-extrabold">500+</div>
                    <div class="text-blue-200 text-sm mt-1">Peserta Aktif</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-5 text-center">
                    <div class="text-4xl font-extrabold">98%</div>
                    <div class="text-blue-200 text-sm mt-1">Tingkat Kelulusan</div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-5 text-center">
                    <div class="text-4xl font-extrabold">25+</div>
                    <div class="text-blue-200 text-sm mt-1">Instruktur Bersertifikat</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan Maritime LMS</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Dirancang khusus untuk memenuhi kebutuhan pendidikan dan pelatihan pelayaran berstandar internasional.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-blue-50 rounded-2xl p-7 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center text-white text-2xl mb-5">📋</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Manajemen Kursus STCW/IMO</h3>
                <p class="text-gray-600">Kelola program pelatihan sesuai standar STCW Convention dan IMO Model Courses secara terstruktur dan terukur.</p>
            </div>
            <div class="bg-teal-50 rounded-2xl p-7 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-teal-600 rounded-xl flex items-center justify-center text-white text-2xl mb-5">🏅</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Manajemen Sertifikat</h3>
                <p class="text-gray-600">Penerbitan dan pemantauan sertifikat kompetensi STCW secara digital dengan pelacakan masa berlaku dan notifikasi kadaluarsa.</p>
            </div>
            <div class="bg-indigo-50 rounded-2xl p-7 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-indigo-600 rounded-xl flex items-center justify-center text-white text-2xl mb-5">📊</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Laporan Kepatuhan IMO</h3>
                <p class="text-gray-600">Laporan komprehensif kepatuhan STCW, tingkat penyelesaian kursus, dan analitik performa peserta untuk audit.</p>
            </div>
            <div class="bg-orange-50 rounded-2xl p-7 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-orange-500 rounded-xl flex items-center justify-center text-white text-2xl mb-5">👨‍🎓</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Manajemen Peserta</h3>
                <p class="text-gray-600">Database lengkap peserta didik termasuk data buku pelaut, jabatan kapal, perusahaan, dan riwayat pelatihan.</p>
            </div>
            <div class="bg-green-50 rounded-2xl p-7 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center text-white text-2xl mb-5">✅</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Sistem Penilaian Multi-Tipe</h3>
                <p class="text-gray-600">Penilaian Written, Practical, Simulation, GMDSS, Firefighting, Survival sesuai standar kompetensi STCW.</p>
            </div>
            <div class="bg-purple-50 rounded-2xl p-7 hover:shadow-lg transition-all">
                <div class="w-14 h-14 bg-purple-600 rounded-xl flex items-center justify-center text-white text-2xl mb-5">👨‍🏫</div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Manajemen Instruktur</h3>
                <p class="text-gray-600">Pengelolaan instruktur bersertifikat STCW dengan riwayat spesialisasi, kualifikasi, dan penugasan kursus.</p>
            </div>
        </div>
    </div>
</section>

<!-- Programs -->
<section id="programs" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Program Pelatihan Unggulan</h2>
            <p class="text-gray-500">Memenuhi persyaratan sertifikasi STCW dan standar IMO Model Courses</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['BST', 'Basic Safety Training', 'STCW Reg. VI/1', 'Safety', '5 Hari / 40 Jam', 'bg-red-500'],
                ['AFF', 'Advanced Firefighting', 'STCW Reg. VI/3', 'Safety', '4 Hari / 32 Jam', 'bg-orange-500'],
                ['SCRB', 'Survival Craft & Rescue Boats', 'STCW Reg. VI/2', 'Safety', '3 Hari / 24 Jam', 'bg-yellow-500'],
                ['GOC', 'GMDSS General Operator Certificate', 'STCW Reg. IV/2', 'Communication', '10 Hari / 80 Jam', 'bg-blue-500'],
                ['BRM', 'Bridge Resource Management', 'STCW Reg. VIII/2', 'Management', '5 Hari / 40 Jam', 'bg-indigo-500'],
                ['ECDIS', 'Electronic Chart Display (ECDIS)', 'STCW Reg. II/1', 'Navigation', '5 Hari / 40 Jam', 'bg-teal-500'],
            ] as $prog)
            <div class="bg-white rounded-xl shadow hover:shadow-md transition-all overflow-hidden">
                <div class="{{ $prog[5] }} h-2"></div>
                <div class="p-6">
                    <span class="inline-block bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded mb-3">{{ $prog[0] }}</span>
                    <h3 class="font-bold text-gray-800 mb-2">{{ $prog[1] }}</h3>
                    <p class="text-xs text-blue-600 font-medium mb-3">{{ $prog[2] }}</p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span><i class="fas fa-tag mr-1"></i>{{ $prog[3] }}</span>
                        <span><i class="fas fa-clock mr-1"></i>{{ $prog[4] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Compliance Banner -->
<section class="py-16 bg-gradient-to-r from-blue-900 to-teal-800 text-white">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Diakui & Terakreditasi Secara Internasional</h2>
        <div class="flex flex-wrap justify-center gap-8 mt-8">
            @foreach(['IMO Approved', 'STCW 2010 Compliant', 'BSH Verified', 'Kemenhub RI', 'ISO 9001:2015', 'ISM Code Compliant'] as $badge)
            <div class="bg-white/10 backdrop-blur rounded-xl px-6 py-4 text-center">
                <i class="fas fa-award text-yellow-400 text-2xl mb-2 block"></i>
                <span class="text-sm font-semibold">{{ $badge }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
