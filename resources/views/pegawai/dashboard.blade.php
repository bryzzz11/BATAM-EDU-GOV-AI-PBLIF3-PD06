<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pegawai - BATAM EDU-GOV AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#F8F9FA] text-gray-900 antialiased flex flex-col selection:bg-green-200">

    <!-- Top Navigation Header -->
    <header class="bg-black text-white border-b border-neutral-800 sticky top-0 z-30 shadow-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-3.5">
            <div class="flex items-center gap-4">
                <a href="{{ route('pegawai.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('Lambang_Kota_Batam.png') }}" alt="Lambang Kota Batam" class="h-9 w-9 object-contain">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-400">Pemerintah Kota Batam</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-neutral-800 text-gray-300 border border-neutral-700">PBLIF3-PD06</span>
                        </div>
                        <p class="font-extrabold text-sm tracking-tight text-white">BATAM EDU-GOV AI &bull; Panel Pegawai</p>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('pegawai.data-eksternal') }}" class="px-3.5 py-2 rounded-xl border border-neutral-800 bg-neutral-900 hover:bg-neutral-800 text-xs font-bold text-gray-300 transition-colors flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7C5 4 4 5 4 7z"/></svg>
                    <span>Data Eksternal</span>
                </a>

                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-xs font-bold text-gray-200">{{ $user->name }}</span>
                    <span class="text-[11px] font-medium text-emerald-400 font-mono">{{ $user->employee_id ?? $user->email }}</span>
                </div>

                <span class="px-3 py-1 rounded-xl text-xs font-extrabold uppercase tracking-wide border
                    @if($role === 'admin') bg-purple-950 text-purple-300 border-purple-800/60
                    @elseif($role === 'verifikator') bg-blue-950 text-blue-300 border-blue-800/60
                    @else bg-emerald-950 text-emerald-300 border-emerald-800/60 @endif">
                    {{ $role === 'pimpinan' ? 'Pengambil Keputusan' : ucfirst($role) }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 rounded-xl border border-neutral-800 bg-neutral-900 px-3.5 py-2 text-xs font-bold text-gray-300 hover:text-red-400 hover:border-red-900/50 hover:bg-neutral-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl w-full px-6 py-8 flex-1 space-y-8">

        <!-- Flash Notifications -->
        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 p-4 text-xs font-semibold text-green-800 flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if (session('warning'))
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-xs font-semibold text-amber-800 flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span>{{ session('warning') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-xs font-semibold text-red-800 flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Banner Role Intro -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-neutral-900 to-black p-6 sm:p-8 text-white shadow-xl border border-neutral-800">
            <div class="absolute -right-12 -top-12 h-44 w-44 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-white/10 text-emerald-400 border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Modul Verifikasi Berbasis Explainable AI (xAI)
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        @if($role === 'verifikator')
                            Portal Verifikator Berkas & Validasi Silang AI
                        @elseif($role === 'pimpinan')
                            Panel Pengambil Keputusan Penerima Beasiswa
                        @else
                            Pusat Administrasi & Integrasi Data Beasiswa
                        @endif
                    </h1>
                    <p class="text-xs text-gray-300 max-w-2xl leading-relaxed">
                        @if($role === 'verifikator')
                            Tinjau kelayakan berkas pemohon dengan bantuan matriks transparansi xAI yang mencocokkan identitas KTP (SIAK Disdukcapil) dan prestasi rapor/UTBK (Pangkalan Kemdikbud).
                        @elseif($role === 'pimpinan')
                            Tinjau daftar calon penerima yang telah lolos verifikasi tim dan terbitkan Surat Keputusan (SK) penetapan penerimaan beasiswa.
                        @else
                            Kelola pangkalan data referensi eksternal, pemantauan pengajuan, serta manajemen hak akses pegawai.
                        @endif
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('pegawai.data-eksternal', ['tab' => 'dukcapil']) }}" class="p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/10 text-center min-w-[120px] transition-all group block" title="Kelola Data Dukcapil Batam">
                        <p class="text-2xl font-black text-emerald-400 group-hover:scale-105 transition-transform">{{ $stats['dukcapil_count'] }}</p>
                        <p class="text-[10px] text-gray-400 group-hover:text-gray-200 font-semibold uppercase tracking-wider">Data Dukcapil ↗</p>
                    </a>
                    <a href="{{ route('pegawai.data-eksternal', ['tab' => 'akademik']) }}" class="p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/10 text-center min-w-[120px] transition-all group block" title="Kelola Data Akademik Kemdikbud">
                        <p class="text-2xl font-black text-blue-400 group-hover:scale-105 transition-transform">{{ $stats['akademik_count'] }}</p>
                        <p class="text-[10px] text-gray-400 group-hover:text-gray-200 font-semibold uppercase tracking-wider">Data Akademik ↗</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Metric Stat Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Total Berkas -->
            <a href="{{ route('pegawai.dashboard') }}" class="p-5 rounded-2xl bg-white border border-gray-200 hover:border-gray-300 shadow-sm transition-all group">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Masuk</p>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-gray-900">{{ $stats['total'] }}</span>
                    <span class="text-xs text-gray-400 font-semibold">Semua</span>
                </div>
            </a>

            <!-- Menunggu Verifikasi -->
            <a href="{{ route('pegawai.dashboard', ['status' => 'menunggu_verifikasi']) }}" class="p-5 rounded-2xl bg-white border border-gray-200 hover:border-blue-300 shadow-sm transition-all group">
                <p class="text-xs font-bold text-blue-600 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Menunggu Verif
                </p>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-blue-700">{{ $stats['menunggu_verifikasi'] }}</span>
                    <span class="text-[11px] text-blue-600/80 font-bold">Verifikator</span>
                </div>
            </a>

            <!-- Perlu Perbaikan -->
            <a href="{{ route('pegawai.dashboard', ['status' => 'perlu_perbaikan']) }}" class="p-5 rounded-2xl bg-white border border-gray-200 hover:border-amber-300 shadow-sm transition-all group">
                <p class="text-xs font-bold text-amber-600 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Perlu Perbaikan
                </p>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-amber-700">{{ $stats['perlu_perbaikan'] }}</span>
                    <span class="text-[11px] text-amber-600/80 font-bold">Di Pemohon</span>
                </div>
            </a>

            <!-- Menunggu Keputusan Pimpinan -->
            <a href="{{ route('pegawai.dashboard', ['status' => 'menunggu_keputusan']) }}" class="p-5 rounded-2xl bg-white border border-gray-200 hover:border-purple-300 shadow-sm transition-all group">
                <p class="text-xs font-bold text-purple-600 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                    Siap Diputuskan
                </p>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-purple-700">{{ $stats['menunggu_keputusan'] }}</span>
                    <span class="text-[11px] text-purple-600/80 font-bold">Pimpinan</span>
                </div>
            </a>

            <!-- Disetujui -->
            <a href="{{ route('pegawai.dashboard', ['status' => 'disetujui']) }}" class="p-5 rounded-2xl bg-white border border-gray-200 hover:border-green-300 shadow-sm transition-all col-span-2 lg:col-span-1 group">
                <p class="text-xs font-bold text-green-700 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Diterima
                </p>
                <div class="mt-2 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-green-800">{{ $stats['disetujui'] }}</span>
                    <span class="text-[11px] text-green-700 font-bold">SK Terbit</span>
                </div>
            </a>
        </div>

        <!-- Filter & Search Section -->
        <div class="bg-white rounded-3xl border border-gray-200 p-5 shadow-sm space-y-4">
            <form action="{{ route('pegawai.dashboard') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                
                <div class="sm:col-span-5 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pemohon, NIK, atau no registrasi..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 text-xs focus:ring-2 focus:ring-[#166534] focus:border-[#166534] outline-none">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <div class="sm:col-span-3">
                    <select name="status" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 text-xs focus:ring-2 focus:ring-[#166534] outline-none">
                        <option value="">-- Semua Status --</option>
                        <option value="menunggu_verifikasi" @selected(request('status') === 'menunggu_verifikasi')>Menunggu Verifikasi</option>
                        <option value="perlu_perbaikan" @selected(request('status') === 'perlu_perbaikan')>Perlu Perbaikan</option>
                        <option value="menunggu_keputusan" @selected(request('status') === 'menunggu_keputusan')>Menunggu Keputusan Pimpinan</option>
                        <option value="disetujui" @selected(request('status') === 'disetujui')>Disetujui Beasiswa</option>
                        <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <select name="jalur" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 text-xs focus:ring-2 focus:ring-[#166534] outline-none">
                        <option value="">-- Semua Jalur --</option>
                        <option value="snbp" @selected(request('jalur') === 'snbp')>SNBP</option>
                        <option value="snbt" @selected(request('jalur') === 'snbt')>SNBT</option>
                        <option value="hinterland" @selected(request('jalur') === 'hinterland')>Hinterland</option>
                    </select>
                </div>

                <div class="sm:col-span-2 flex items-center gap-2">
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gray-900 hover:bg-black text-white text-xs font-bold transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('pegawai.dashboard') }}" class="p-2.5 rounded-xl border border-gray-300 hover:bg-gray-100 text-gray-500 text-xs font-bold transition-colors" title="Reset">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </a>
                </div>
            </form>
        </div>

        <!-- Table of Pengajuan -->
        <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-extrabold text-gray-900">Daftar Berkas Pengajuan Beasiswa</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Menampilkan permohonan calon penerima beserta hasil kalkulasi verifikasi xAI</p>
                </div>
                <span class="text-xs font-bold text-gray-400">{{ $pengajuans->total() }} Data Ditemukan</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-gray-50/75 border-b border-gray-200 text-gray-500 font-bold uppercase tracking-wider text-[10px]">
                            <th class="py-3.5 px-6">No. Registrasi</th>
                            <th class="py-3.5 px-6">Calon Penerima</th>
                            <th class="py-3.5 px-4">Jalur</th>
                            <th class="py-3.5 px-4">Kampus & Nilai</th>
                            <th class="py-3.5 px-4">Skor & Rekomendasi xAI</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-medium">
                        @forelse($pengajuans as $p)
                            @php
                                $xai = $p->xai_data;
                                $score = $xai['skor_total'] ?? 0;
                            @endphp
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="py-4 px-6 font-mono font-bold text-gray-900">
                                    {{ $p->nomor_registrasi }}
                                    <span class="block text-[10px] text-gray-400 font-sans font-normal">{{ $p->created_at->format('d M Y, H:i') }}</span>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="font-extrabold text-gray-900 text-sm">{{ $p->nama_lengkap }}</div>
                                    <div class="text-[11px] text-gray-500 font-mono mt-0.5">NIK: {{ $p->nik }}</div>
                                    <div class="text-[11px] text-gray-500">Kec. {{ $p->kecamatan }}</div>
                                </td>

                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold border
                                        @if($p->jalur === 'SNBP') bg-green-50 text-green-800 border-green-200
                                        @elseif($p->jalur === 'SNBT') bg-blue-50 text-blue-800 border-blue-200
                                        @else bg-amber-50 text-amber-800 border-amber-200 @endif">
                                        {{ $p->jalur }}
                                    </span>
                                </td>

                                <td class="py-4 px-4 space-y-0.5">
                                    <p class="font-semibold text-gray-800 truncate max-w-[180px]">{{ $p->nama_kampus }}</p>
                                    <p class="text-[11px] text-gray-500 truncate max-w-[180px]">{{ $p->program_studi }}</p>
                                    <p class="text-[11px] font-mono text-emerald-700 font-bold">Nilai: {{ $p->ipk_nilai ? number_format($p->ipk_nilai, 2) : '-' }}</p>
                                </td>

                                <td class="py-4 px-4">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 overflow-hidden">
                                                <div class="h-2 rounded-full @if($score >= 85) bg-emerald-500 @elseif($score >= 60) bg-amber-500 @else bg-red-500 @endif" style="width: {{ $score }}%"></div>
                                            </div>
                                            <span class="font-mono font-extrabold text-xs @if($score >= 85) text-emerald-700 @elseif($score >= 60) text-amber-700 @else text-red-700 @endif">
                                                {{ $score }}%
                                            </span>
                                        </div>
                                        <span class="inline-block text-[9px] font-extrabold uppercase px-2 py-0.5 rounded-full
                                            @if($score >= 85) bg-emerald-100 text-emerald-800
                                            @elseif($score >= 60) bg-amber-100 text-amber-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $score >= 85 ? '✓ Lolos xAI' : ($score >= 60 ? '⚠️ Perlu Review' : '✕ Anomali') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-4">
                                    @if($p->status === 'menunggu_verifikasi')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-800 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                            Menunggu Verif
                                        </span>
                                    @elseif($p->status === 'perlu_perbaikan')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Perlu Perbaikan
                                        </span>
                                    @elseif($p->status === 'menunggu_keputusan')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-50 text-purple-800 border border-purple-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                            Siap Diputuskan
                                        </span>
                                    @elseif($p->status === 'disetujui')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-50 text-green-800 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Disetujui Beasiswa
                                        </span>
                                    @elseif($p->status === 'ditolak')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-800 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('pegawai.pengajuan.show', $p->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#166534] hover:bg-green-800 text-white font-bold text-xs shadow-sm transition-all">
                                        <span>Review & xAI</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <p class="font-bold text-gray-600">Belum ada pengajuan beasiswa yang cocok.</p>
                                    <p class="text-xs text-gray-400 mt-1">Coba ubah kriteria pencarian atau status filter di atas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pengajuans->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $pengajuans->links() }}
                </div>
            @endif
        </div>

    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500">
        <p>&copy; 2026 Pemerintah Kota Batam &bull; Dinas Pendidikan &bull; PBLIF3-PD06 Sistem Seleksi Beasiswa Cerdas</p>
    </footer>

</body>
</html>
