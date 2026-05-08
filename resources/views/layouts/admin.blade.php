<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Maritime LMS Poltekpel Barombong</title>
    {{--
    <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.15);
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-900 to-blue-950 text-white flex flex-col flex-shrink-0">
            <!-- Logo -->
            <div class="p-5 border-b border-blue-800">
                <div class="flex items-center">
                    <span class="text-3xl mr-3">⚓</span>
                    <div>
                        <h1 class="font-bold text-sm leading-tight">Poltekpel Barombong</h1>
                        <p class="text-xs text-blue-300">Maritime LMS</p>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="px-4 py-3 border-b border-blue-800 bg-blue-800/30">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-xs font-bold mr-2">
                        {{ strtoupper(substr(session('admin_user', 'A'), 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium">{{ session('admin_user', 'Admin') }}</p>
                        <p class="text-xs text-blue-300">{{ session('admin_role', 'Administrator') }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-3">
                <p class="text-xs text-blue-400 uppercase font-semibold px-3 mb-2">Menu Utama</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5 mr-3 text-blue-300"></i> Dashboard
                </a>

                <p class="text-xs text-blue-400 uppercase font-semibold px-3 mb-2 mt-4">Akademik</p>
                <a href="{{ route('admin.courses.index') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.courses*') ? 'active' : '' }}">
                    <i class="fas fa-book-open w-5 mr-3 text-blue-300"></i> Kursus & Materi
                </a>
                <a href="{{ route('admin.students.index') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.students*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate w-5 mr-3 text-blue-300"></i> Peserta Didik
                </a>
                <a href="{{ route('admin.instructors.index') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.instructors*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher w-5 mr-3 text-blue-300"></i> Instruktur
                </a>
                <a href="{{ route('admin.enrollments.index') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.enrollments*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list w-5 mr-3 text-blue-300"></i> Pendaftaran
                </a>

                <p class="text-xs text-blue-400 uppercase font-semibold px-3 mb-2 mt-4">Penilaian & Sertifikasi</p>
                <a href="{{ route('admin.assessments.index') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.assessments*') ? 'active' : '' }}">
                    <i class="fas fa-tasks w-5 mr-3 text-blue-300"></i> Penilaian
                </a>
                <a href="{{ route('admin.certificates.index') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.certificates*') ? 'active' : '' }}">
                    <i class="fas fa-certificate w-5 mr-3 text-blue-300"></i> Sertifikat
                </a>

                <p class="text-xs text-blue-400 uppercase font-semibold px-3 mb-2 mt-4">Laporan</p>
                <a href="{{ route('admin.reports.index') }}"
                    class="sidebar-link flex items-center px-3 py-2.5 rounded-lg mb-1 text-sm transition-all {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar w-5 mr-3 text-blue-300"></i> Laporan & Analitik
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-blue-800">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-3 py-2 rounded-lg text-sm text-red-300 hover:bg-red-900/30 transition-all">
                        <i class="fas fa-sign-out-alt w-5 mr-3"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header
                class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex items-center justify-between flex-shrink-0">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-sm text-gray-500">
                        @yield('page-subtitle', 'Sistem Informasi Manajemen Pendidikan Maritim')</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>STCW Compliant
                    </span>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-teal-100 text-teal-700 text-xs font-medium">
                        <span class="w-2 h-2 bg-teal-500 rounded-full mr-2"></span>IMO Approved
                    </span>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div
                        class="mb-4 flex items-center bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 flex items-center bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @livewireScripts
</body>

</html>