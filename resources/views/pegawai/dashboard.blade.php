<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pegawai - BATAM EDU-GOV AI</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    <header class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('Lambang_Kota_Batam.png') }}" alt="Lambang Kota Batam" class="h-10 w-10 object-contain">
                <div>
                    <p class="text-xs font-semibold text-gray-500">PEMERINTAH KOTA BATAM</p>
                    <p class="font-bold">Panel Pegawai</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Keluar
                </button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-12">
        @if (session('success'))
            <div role="status" class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold uppercase text-[#166534]">
                {{ ucfirst(Auth::user()->role) }}
            </span>
            <h1 class="mt-5 text-2xl font-bold">Selamat datang, {{ Auth::user()->name }}</h1>
            <p class="mt-2 text-gray-600">Anda berhasil masuk ke panel pegawai BATAM EDU-GOV AI.</p>
        </div>
    </main>
</body>
</html>
