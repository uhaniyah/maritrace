<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Maritime LMS Poltekpel Barombong</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap'); body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-blue-900 to-teal-800 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <span class="text-6xl block mb-3">⚓</span>
            <h1 class="text-white text-2xl font-extrabold">Poltekpel Barombong</h1>
            <p class="text-blue-300 text-sm">Maritime Learning Management System</p>
            <div class="flex justify-center gap-2 mt-3">
                <span class="text-xs bg-blue-700/50 text-blue-200 px-3 py-1 rounded-full">STCW Compliant</span>
                <span class="text-xs bg-teal-700/50 text-teal-200 px-3 py-1 rounded-full">IMO Approved</span>
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Login Administrator</h2>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-5 text-sm">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form action="/admin/login" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                        <input type="email" name="email" value="{{ old('email', 'admin@poltekpel-barombong.ac.id') }}"
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                        <input type="password" name="password" value="admin123"
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" required>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-700 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition-all text-sm">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Dashboard
                </button>
            </form>

            <!-- Test Credentials -->
            <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-xs font-bold text-gray-600 mb-3"><i class="fas fa-info-circle mr-1 text-blue-500"></i>Kredensial Demo:</p>
                <div class="space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">admin@poltekpel-barombong.ac.id</span>
                        <span class="font-mono bg-gray-200 px-2 py-0.5 rounded text-gray-700">admin123</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">akademik@poltekpel-barombong.ac.id</span>
                        <span class="font-mono bg-gray-200 px-2 py-0.5 rounded text-gray-700">akademik123</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">instruktur@poltekpel-barombong.ac.id</span>
                        <span class="font-mono bg-gray-200 px-2 py-0.5 rounded text-gray-700">instruktur123</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
