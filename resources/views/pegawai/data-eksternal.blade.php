<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pangkalan Data Eksternal - BATAM EDU-GOV AI</title>
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
                        <p class="font-extrabold text-sm tracking-tight text-white">BATAM EDU-GOV AI &bull; Pangkalan Data Eksternal</p>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('pegawai.dashboard') }}" class="px-3.5 py-2 rounded-xl border border-neutral-800 bg-neutral-900 hover:bg-neutral-800 text-xs font-bold text-gray-300 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard Berkas</span>
                </a>

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

        <!-- Flash Messages -->
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

        <!-- Banner Intro -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-neutral-900 to-black p-6 sm:p-8 text-white shadow-xl border border-neutral-800">
            <div class="absolute -right-12 -top-12 h-44 w-44 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-white/10 text-emerald-400 border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Basis Data Validasi Silang (External Datasets)
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                        Manajemen Data Eksternal Disdukcapil & Kemdikbud
                    </h1>
                    <p class="text-xs text-gray-300 max-w-2xl leading-relaxed">
                        Pangkalan data ini menjadi tolok ukur (ground truth) bagi mesin Explainable AI (xAI) Python untuk memverifikasi keabsahan NIK, domisili hinterland, dan rekam jejak akademik calon penerima beasiswa Batam.
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/10 text-center min-w-[130px]">
                        <p class="text-3xl font-black text-emerald-400 font-mono">{{ $stats['dukcapil_count'] }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-0.5">Dukcapil Batam</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/10 text-center min-w-[130px]">
                        <p class="text-3xl font-black text-blue-400 font-mono">{{ $stats['akademik_count'] }}</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-0.5">Akademik Kemdikbud</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION: IMPORT EXCEL / CSV (Khusus Admin) -->
        @if($role === 'admin')
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-6">
                <div class="border-b border-gray-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-50 text-purple-700 font-bold text-xs mb-1">
                            MODUL ADMINISTRATOR
                        </div>
                        <h2 class="text-lg font-extrabold text-gray-900">
                            Unggah & Impor File Excel / CSV (Mendukung Ratusan Data Dummy)
                        </h2>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Unggah berkas spreadsheet (.xlsx, .xls, .csv). Engine Python akan memetakan kolom secara otomatis.
                        </p>
                    </div>

                    <!-- Template Download Buttons -->
                    <div class="flex items-center gap-2">
                        <a href="{{ route('pegawai.data-eksternal.template', 'dukcapil') }}" class="px-3 py-1.5 rounded-xl border border-gray-300 hover:border-gray-400 bg-gray-50 text-gray-700 text-xs font-bold transition-all flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span>Template Dukcapil (.csv)</span>
                        </a>
                        <a href="{{ route('pegawai.data-eksternal.template', 'akademik') }}" class="px-3 py-1.5 rounded-xl border border-gray-300 hover:border-gray-400 bg-gray-50 text-gray-700 text-xs font-bold transition-all flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span>Template Akademik (.csv)</span>
                        </a>
                    </div>
                </div>

                <form action="{{ route('pegawai.data-eksternal.import') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- 1. Tipe Pangkalan Data -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">1. Pilih Pangkalan Data Target *</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 p-3 rounded-2xl border border-gray-200 bg-gray-50 hover:bg-emerald-50/40 cursor-pointer transition-colors">
                                    <input type="radio" name="tipe_data" value="dukcapil" checked class="w-4 h-4 text-[#166534] focus:ring-[#166534]">
                                    <div>
                                        <span class="block text-xs font-bold text-gray-900">Disdukcapil Kota Batam</span>
                                        <span class="text-[11px] text-gray-500">NIK, Nama, Tempat/Tgl Lahir, Domisili, Wilayah</span>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-3 rounded-2xl border border-gray-200 bg-gray-50 hover:bg-blue-50/40 cursor-pointer transition-colors">
                                    <input type="radio" name="tipe_data" value="akademik" class="w-4 h-4 text-[#166534] focus:ring-[#166534]">
                                    <div>
                                        <span class="block text-xs font-bold text-gray-900">Akademik Kemdikbud / SNPMB</span>
                                        <span class="text-[11px] text-gray-500">NISN, Sekolah, Kampus Diterima, Nilai Rapor</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 2. Mode Impor -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">2. Mode Pemrosesan Data *</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 p-3 rounded-2xl border border-gray-200 bg-gray-50 hover:bg-gray-100 cursor-pointer transition-colors">
                                    <input type="radio" name="mode" value="upsert" checked class="w-4 h-4 text-[#166534] focus:ring-[#166534]">
                                    <div>
                                        <span class="block text-xs font-bold text-gray-900">Update & Tambah Data Baru</span>
                                        <span class="text-[11px] text-gray-500">Perbarui jika NIK sama, tambah jika baru (Aman)</span>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-3 rounded-2xl border border-red-200 bg-red-50/30 hover:bg-red-50 cursor-pointer transition-colors">
                                    <input type="radio" name="mode" value="truncate" class="w-4 h-4 text-red-600 focus:ring-red-600">
                                    <div>
                                        <span class="block text-xs font-bold text-red-900">Kosongkan & Ganti Semua</span>
                                        <span class="text-[11px] text-red-700">Hapus data lama pada tabel target sebelum impor</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- 3. Berkas File Excel/CSV -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">3. Pilih Berkas Spreadsheet *</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-4 bg-gray-50 hover:bg-gray-100/80 transition-all text-center space-y-2 relative">
                                <input type="file" name="file_excel" id="file_excel" accept=".xlsx,.xls,.csv" required class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#166534] file:text-white hover:file:bg-green-800 file:cursor-pointer cursor-pointer">
                                <p class="text-[11px] text-gray-400">Mendukung: <strong>.xlsx</strong> (Excel), <strong>.xls</strong>, dan <strong>.csv</strong> (Maks 10MB)</p>
                            </div>

                            <button type="submit" class="mt-3 w-full py-3 px-4 rounded-xl bg-[#166534] hover:bg-green-800 text-white font-extrabold text-xs shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l4-4m0 0l4 4m-4-4v12"/></svg>
                                <span>Mulai Impor Data Eksternal</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        <!-- SECTION: TABEL DATA EKSTERNAL -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden space-y-6">
            
            <!-- Tab Switcher -->
            <div class="border-b border-gray-100 px-6 pt-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <a href="{{ route('pegawai.data-eksternal', ['tab' => 'dukcapil']) }}" class="px-5 py-3 rounded-t-2xl font-extrabold text-xs border-b-2 transition-all flex items-center gap-2
                        {{ $activeTab === 'dukcapil' ? 'border-[#166534] text-[#166534] bg-green-50/50' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                        <span>Disdukcapil Batam</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800">{{ $stats['dukcapil_count'] }}</span>
                    </a>

                    <a href="{{ route('pegawai.data-eksternal', ['tab' => 'akademik']) }}" class="px-5 py-3 rounded-t-2xl font-extrabold text-xs border-b-2 transition-all flex items-center gap-2
                        {{ $activeTab === 'akademik' ? 'border-blue-600 text-blue-700 bg-blue-50/50' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                        <span>Akademik Kemdikbud</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-800">{{ $stats['akademik_count'] }}</span>
                    </a>
                </div>

                <!-- Search Input -->
                <form action="{{ route('pegawai.data-eksternal') }}" method="GET" class="flex items-center gap-2 pb-3">
                    <input type="hidden" name="tab" value="{{ $activeTab }}">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari Nama, NIK, Sekolah, dll..." class="w-64 bg-gray-50 border border-gray-300 rounded-xl pl-9 pr-3 py-2 text-xs focus:ring-2 focus:ring-[#166534] outline-none">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button type="submit" class="px-3 py-2 rounded-xl bg-gray-900 text-white font-bold text-xs hover:bg-black transition-colors">
                        Cari
                    </button>
                    @if($search)
                        <a href="{{ route('pegawai.data-eksternal', ['tab' => $activeTab]) }}" class="px-2.5 py-2 rounded-xl bg-gray-200 text-gray-700 font-bold text-xs hover:bg-gray-300 transition-colors">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- TAB 1: DUKCAPIL BATAM -->
            @if($activeTab === 'dukcapil')
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 uppercase font-black tracking-wider text-[11px]">
                                <th class="p-4 pl-6">NIK e-KTP</th>
                                <th class="p-4">Nama Lengkap</th>
                                <th class="p-4">Tempat / Tanggal Lahir</th>
                                <th class="p-4">Gender</th>
                                <th class="p-4">Kecamatan / Kelurahan</th>
                                <th class="p-4">Status SIAK</th>
                                <th class="p-4">Kategori Wilayah</th>
                                @if($role === 'admin')
                                    <th class="p-4 pr-6 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($dukcapils as $d)
                                <tr class="hover:bg-gray-50/70 transition-colors">
                                    <td class="p-4 pl-6 font-mono font-bold text-gray-900">{{ $d->nik }}</td>
                                    <td class="p-4 font-bold text-gray-900">{{ $d->nama_lengkap }}</td>
                                    <td class="p-4 text-gray-600">{{ $d->tempat_lahir }}, {{ $d->tanggal_lahir?->format('d/m/Y') }}</td>
                                    <td class="p-4 text-gray-600">{{ $d->jenis_kelamin }}</td>
                                    <td class="p-4 text-gray-700">
                                        <span class="font-semibold">{{ $d->kecamatan }}</span>
                                        <span class="text-gray-400 block text-[10px]">Kel. {{ $d->kelurahan }}</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold
                                            {{ $d->status_kependudukan === 'AKTIF' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $d->status_kependudukan }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold
                                            {{ $d->kategori_wilayah === 'HINTERLAND' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $d->kategori_wilayah }}
                                        </span>
                                    </td>
                                    @if($role === 'admin')
                                        <td class="p-4 pr-6 text-center">
                                            <form action="{{ route('pegawai.data-eksternal.delete', ['type' => 'dukcapil', 'id' => $d->id]) }}" method="POST" onsubmit="return confirm('Hapus data referensi NIK ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-8 text-center text-gray-400">
                                        Tidak ada data kependudukan ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100">
                    {{ $dukcapils->links() }}
                </div>

            <!-- TAB 2: AKADEMIK KEMDIKBUD -->
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 uppercase font-black tracking-wider text-[11px]">
                                <th class="p-4 pl-6">NIK / NISN</th>
                                <th class="p-4">Nama Siswa</th>
                                <th class="p-4">Asal Sekolah</th>
                                <th class="p-4">Jalur</th>
                                <th class="p-4">Kampus & Prodi Diterima</th>
                                <th class="p-4">Nilai Rapor / UTBK</th>
                                <th class="p-4">Status Kelulusan</th>
                                @if($role === 'admin')
                                    <th class="p-4 pr-6 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($akademiks as $a)
                                <tr class="hover:bg-gray-50/70 transition-colors">
                                    <td class="p-4 pl-6 font-mono text-gray-900">
                                        <div class="font-bold">{{ $a->nik }}</div>
                                        <span class="text-gray-400 text-[10px]">NISN: {{ $a->nisn ?? '-' }}</span>
                                    </td>
                                    <td class="p-4 font-bold text-gray-900">{{ $a->nama_lengkap }}</td>
                                    <td class="p-4 text-gray-600">
                                        <div>{{ $a->asal_sekolah }}</div>
                                        <span class="text-gray-400 text-[10px]">Lulus {{ $a->tahun_lulus ?? '-' }}</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase
                                            @if($a->jalur_seleksi === 'SNBP') bg-green-100 text-green-800
                                            @elseif($a->jalur_seleksi === 'SNBT') bg-blue-100 text-blue-800
                                            @else bg-amber-100 text-amber-800 @endif">
                                            {{ $a->jalur_seleksi }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-700">
                                        <span class="font-bold text-gray-900">{{ $a->nama_kampus_diterima }}</span>
                                        <span class="text-gray-500 block text-[10px]">{{ $a->program_studi_diterima }}</span>
                                    </td>
                                    <td class="p-4 font-mono font-bold text-emerald-700">
                                        @if($a->nilai_rata_rapor)
                                            <div>Rapor: {{ number_format($a->nilai_rata_rapor, 2) }}</div>
                                        @endif
                                        @if($a->skor_utbk)
                                            <div class="text-blue-700 text-[10px]">UTBK: {{ number_format($a->skor_utbk, 1) }}</div>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold
                                            {{ $a->status_kelulusan === 'DITERIMA' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $a->status_kelulusan }}
                                        </span>
                                    </td>
                                    @if($role === 'admin')
                                        <td class="p-4 pr-6 text-center">
                                            <form action="{{ route('pegawai.data-eksternal.delete', ['type' => 'akademik', 'id' => $a->id]) }}" method="POST" onsubmit="return confirm('Hapus data referensi akademik ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-8 text-center text-gray-400">
                                        Tidak ada data akademik ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100">
                    {{ $akademiks->links() }}
                </div>
            @endif

        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500">
        <p>&copy; 2026 Pemerintah Kota Batam &bull; Dinas Pendidikan &bull; Panel Pegawai Sistem Seleksi Beasiswa</p>
    </footer>

</body>
</html>
