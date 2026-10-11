<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Berhasil - BATAM EDU-GOV AI</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased min-h-screen flex flex-col selection:bg-green-200">

    <!-- Outer Wrapper -->
    <div class="flex-1 flex flex-col md:flex-row min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-full md:w-64 lg:w-72 bg-black border-r border-neutral-800 flex flex-col justify-between shrink-0 z-30 transition-all">
            <div>
                <div class="p-5 border-b border-neutral-800 flex items-center justify-between">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo BATAM EDU-GOV AI" class="h-10 w-auto object-contain">
                    </a>
                </div>

                <nav class="p-4 space-y-1.5">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('pengajuan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#166534] text-white text-sm font-semibold shadow-sm transition-all">
                        <svg class="w-5 h-5 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Pengajuan Beasiswa</span>
                    </a>

                    <a href="{{ route('bantuan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Pusat Bantuan</span>
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-neutral-800 bg-black">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-neutral-800 text-gray-300 hover:text-red-400 hover:bg-neutral-900 text-xs font-bold transition-all">
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">

            <header class="bg-black border-b border-neutral-800 px-6 py-4 flex flex-wrap items-center justify-between gap-4 sticky top-0 z-20">
                <div class="flex items-center gap-2 text-xs font-semibold text-gray-400">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-200">Dashboard</a>
                    <span class="text-neutral-600">/</span>
                    <a href="{{ route('pengajuan.index') }}" class="hover:text-gray-200">Pengajuan</a>
                    <span class="text-neutral-600">/</span>
                    <span class="text-white font-bold">Bukti Pengajuan</span>
                </div>
            </header>

            <main class="flex-1 p-6 md:p-12 max-w-3xl w-full mx-auto space-y-8">

                <!-- Success Box -->
                <div class="bg-white rounded-3xl border border-gray-200 p-8 sm:p-10 shadow-sm text-center space-y-6">
                    <div class="w-20 h-20 bg-green-100 text-[#166534] rounded-3xl flex items-center justify-center mx-auto shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>

                    <div class="space-y-2">
                        <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-green-50 text-green-800 border border-green-200">
                            STATUS: MENUNGGU VERIFIKASI & VALIDASI
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                            Pengajuan Beasiswa Berhasil Terkirim!
                        </h1>
                        <p class="text-sm text-gray-500 max-w-md mx-auto">
                            Biodata dan dokumen berkas Anda telah tersimpan dengan aman di sistem. Selanjutnya data akan divalidasi oleh panitia beasiswa.
                        </p>
                    </div>

                    <!-- Registration ID Card -->
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 space-y-4 max-w-md mx-auto text-left">
                        <div class="flex justify-between items-center border-b border-gray-200/80 pb-3">
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Nomor Registrasi Resmi</span>
                                <h3 class="text-xl font-mono font-extrabold text-gray-900 mt-0.5">{{ $pengajuan->nomor_registrasi }}</h3>
                            </div>
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $pengajuan->nomor_registrasi }}'); alert('Nomor registrasi berhasil disalin!');" class="p-2 text-gray-400 hover:text-gray-800 rounded-lg hover:bg-gray-200 transition-colors" title="Salin Nomor">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Jalur Beasiswa:</span>
                                <span class="font-bold text-gray-900">Jalur {{ $pengajuan->jalur }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Nama Pemohon:</span>
                                <span class="font-bold text-gray-900">{{ $pengajuan->nama_lengkap }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">NIK e-KTP:</span>
                                <span class="font-mono font-bold text-gray-900">{{ substr($pengajuan->nik, 0, 6) }}******{{ substr($pengajuan->nik, -4) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Perguruan Tinggi:</span>
                                <span class="font-bold text-gray-900">{{ $pengajuan->nama_kampus }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Waktu Pengajuan:</span>
                                <span class="font-bold text-gray-900">{{ $pengajuan->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-200">
                            <span class="text-[11px] font-bold text-gray-700 block mb-1.5">Berkas Terunggah:</span>
                            <div class="space-y-1 text-[11px] text-gray-600">
                                @if($pengajuan->file_ktp)
                                    <div class="flex items-center gap-1.5 text-green-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Scan e-KTP Kota Batam</span>
                                    </div>
                                @endif
                                @if($pengajuan->file_raport)
                                    <div class="flex items-center gap-1.5 text-green-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Scan Rapor SMA / Transkrip Nilai</span>
                                    </div>
                                @endif
                                @if($pengajuan->file_utbk)
                                    <div class="flex items-center gap-1.5 text-green-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Sertifikat Nilai UTBK Resmi</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-[#166534] hover:bg-green-800 text-white font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2">
                            <span>Kembali ke Dashboard Utama</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

            </main>

            <x-footer />
        </div>
    </div>
</body>
</html>
