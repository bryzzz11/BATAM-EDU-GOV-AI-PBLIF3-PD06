<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BATAM EDU-GOV AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
        <img src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo" class="h-8 w-auto">

        <div class="flex items-center gap-4">
            {{-- Avatar --}}
            @if(Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-[#166534]/30">
            @else
                <div class="w-9 h-9 rounded-full bg-[#166534] flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif

            <div class="hidden sm:block">
                <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-semibold text-gray-500 hover:text-red-600 transition-colors px-3 py-2 rounded-lg hover:bg-red-50">
                    Keluar
                </button>
            </form>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-5xl mx-auto px-6 py-12">

        {{-- Welcome Banner --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-3 text-green-800 text-sm font-medium">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Selamat datang, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
            <p class="text-gray-500 mt-2">Berikut ringkasan akun dan status beasiswa Anda.</p>
        </div>

        {{-- Info Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Status Akun</p>
                <p class="text-2xl font-bold text-[#166534]">Aktif</p>
                <p class="text-xs text-gray-500 mt-1">Terverifikasi</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Metode Login</p>
                <p class="text-2xl font-bold text-gray-800">
                    {{ Auth::user()->google_id ? 'Google' : 'Email' }}
                </p>
                <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->email }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pengajuan Beasiswa</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
                <p class="text-xs text-gray-500 mt-1">Belum ada pengajuan</p>
            </div>
        </div>

        {{-- Placeholder Section --}}
        <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-700 mb-2">Belum ada pengajuan beasiswa</h3>
            <p class="text-sm text-gray-400 mb-6">Mulai ajukan beasiswa sesuai kriteria dan domisili Batam Anda.</p>
            <button class="px-6 py-2.5 bg-[#166534] text-white text-sm font-bold rounded-xl hover:bg-green-800 transition-colors">
                Ajukan Beasiswa
            </button>
        </div>
    </main>

</body>
</html>
