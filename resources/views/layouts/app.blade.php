<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Poltekpel Barombong Maritime LMS')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50">
    @isset($slot)
        {{ $slot }}
    @else
        @yield('content')
    @endisset
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <span class="text-2xl mr-2">⚓</span>
                    <div>
                        <h3 class="font-bold text-lg">Poltekpel Barombong</h3>
                        <p class="text-xs text-gray-400">Maritime Learning Center</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm">Politeknik Pelayaran Barombong — pusat pendidikan dan pelatihan maritim
                    berstandar STCW & IMO di Indonesia.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-blue-400">Program Pelatihan</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>Basic Safety Training (BST)</li>
                    <li>GMDSS GOC/ROC</li>
                    <li>Advanced Firefighting</li>
                    <li>Bridge Resource Management</li>
                    <li>ECDIS Navigation</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-blue-400">Standar Internasional</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>STCW Convention & Code</li>
                    <li>IMO Model Courses</li>
                    <li>SOLAS Regulation</li>
                    <li>MARPOL Convention</li>
                    <li>MLC 2006</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4 text-blue-400">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><i class="fas fa-map-marker-alt mr-2"></i>Jl. Barombong, Makassar, Sulawesi Selatan</li>
                    <li><i class="fas fa-phone mr-2"></i>(0411) 860-386</li>
                    <li><i class="fas fa-envelope mr-2"></i>info@poltekpel-barombong.ac.id</li>
                    <li><i class="fas fa-globe mr-2"></i>www.poltekpel-barombong.ac.id</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 py-6 text-center text-sm text-gray-400">
            <p>© {{ date('Y') }} Politeknik Pelayaran Barombong. All rights reserved.</p>
            <p class="mt-1">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank"
                    class="text-blue-400 hover:underline">LaraCopilot</a></p>
        </div>
    </footer>
    @livewireScripts
</body>

</html>