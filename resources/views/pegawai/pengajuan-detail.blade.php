<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review xAI: {{ $pengajuan->nomor_registrasi }} - BATAM EDU-GOV AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#F8F9FA] text-gray-900 antialiased flex flex-col selection:bg-green-200">

    <!-- Top Header Navbar -->
    <header class="bg-black text-white border-b border-neutral-800 sticky top-0 z-30 shadow-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-3.5">
            <div class="flex items-center gap-4">
                <a href="{{ route('pegawai.dashboard') }}" class="flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Dashboard</span>
                </a>
                <span class="text-neutral-700">|</span>
                <span class="text-xs text-gray-400 font-mono">{{ $pengajuan->nomor_registrasi }}</span>
            </div>

            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded-xl text-xs font-extrabold uppercase tracking-wide border
                    @if(Auth::user()->role === 'admin') bg-purple-950 text-purple-300 border-purple-800/60
                    @elseif(Auth::user()->role === 'verifikator') bg-blue-950 text-blue-300 border-blue-800/60
                    @else bg-emerald-950 text-emerald-300 border-emerald-800/60 @endif">
                    {{ Auth::user()->role === 'pimpinan' ? 'Pengambil Keputusan' : ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>
    </header>

    @php
        $xai = $pengajuan->xai_data ?? [];
        $score = $xai['skor_total'] ?? 0;
        $rekomendasi = $xai['rekomendasi'] ?? 'PERLU_VERIFIKASI_MANUAL';
        $checks = $xai['checks'] ?? [];
        $kesimpulan = $xai['kesimpulan_xai'] ?? 'Sistem telah menganalisis kelayakan berkas berdasarkan data eksternal.';
        $engine = $xai['ai_engine'] ?? 'Python 3 + Scikit-Learn (Random Forest) xAI';
        $contributions = $xai['feature_contributions'] ?? [];
        $modelMeta = $xai['model_metadata'] ?? [];
    @endphp

    <main class="mx-auto max-w-7xl w-full px-6 py-8 flex-1 space-y-8">

        <!-- Top Title Bar -->
        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider
                        @if($pengajuan->jalur === 'SNBP') bg-green-100 text-green-800
                        @elseif($pengajuan->jalur === 'SNBT') bg-blue-100 text-blue-800
                        @else bg-amber-100 text-amber-800 @endif">
                        Jalur {{ $pengajuan->jalur }}
                    </span>
                    <span class="text-xs text-gray-400 font-mono">No. Registrasi: {{ $pengajuan->nomor_registrasi }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                    {{ $pengajuan->nama_lengkap }}
                </h1>
                <p class="text-xs text-gray-500">
                    Mendaftar pada {{ $pengajuan->created_at->format('d F Y - H:i') }} WIB &bull; NIK: <span class="font-mono font-bold text-gray-800">{{ $pengajuan->nik }}</span>
                </p>
            </div>

            <!-- Current Status Badge -->
            <div class="flex flex-col items-start md:items-end gap-2 shrink-0">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status Berkas Saat Ini:</span>
                @if($pengajuan->status === 'menunggu_verifikasi')
                    <span class="px-4 py-2 rounded-2xl text-xs font-extrabold bg-blue-50 text-blue-800 border border-blue-200 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Menunggu Verifikasi Petugas
                    </span>
                @elseif($pengajuan->status === 'perlu_perbaikan')
                    <span class="px-4 py-2 rounded-2xl text-xs font-extrabold bg-amber-50 text-amber-800 border border-amber-200 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Dikembalikan ke Pemohon (Perlu Perbaikan)
                    </span>
                @elseif($pengajuan->status === 'menunggu_keputusan')
                    <span class="px-4 py-2 rounded-2xl text-xs font-extrabold bg-purple-50 text-purple-800 border border-purple-200 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                        Lolos Verifikator - Menunggu Keputusan Pimpinan
                    </span>
                @elseif($pengajuan->status === 'disetujui')
                    <span class="px-4 py-2 rounded-2xl text-xs font-extrabold bg-green-50 text-green-800 border border-green-200 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Disetujui Beasiswa (Penerima Resmi)
                    </span>
                @elseif($pengajuan->status === 'ditolak')
                    <span class="px-4 py-2 rounded-2xl text-xs font-extrabold bg-red-50 text-red-800 border border-red-200 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                        Ditolak
                    </span>
                @endif
            </div>
        </div>

        @if($pengajuan->catatan)
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                    <span>Catatan Terakhir Petugas:</span>
                </p>
                <p class="text-xs text-gray-800 font-medium leading-relaxed">{{ $pengajuan->catatan }}</p>
            </div>
        @endif

        <!-- Two Columns Layout: Data vs xAI -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT COLUMN: Data Pemohon & Dokumen Berkas (5 Cols) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Card Biodata -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm space-y-5">
                    <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#166534]"></span>
                            Biodata Calon Penerima
                        </h3>
                        <span class="text-[10px] font-bold text-gray-400">Tahap 1</span>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">Nama Lengkap</span>
                            <span class="font-bold text-gray-900 text-right">{{ $pengajuan->nama_lengkap }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">NIK e-KTP</span>
                            <span class="font-mono font-bold text-gray-900 text-right">{{ $pengajuan->nik }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">Tempat / Tgl Lahir</span>
                            <span class="font-semibold text-gray-900 text-right">{{ $pengajuan->tempat_lahir }}, {{ $pengajuan->tanggal_lahir?->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">Jenis Kelamin</span>
                            <span class="font-semibold text-gray-900 text-right">{{ $pengajuan->jenis_kelamin }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">Kecamatan</span>
                            <span class="font-semibold text-gray-900 text-right">{{ $pengajuan->kecamatan }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">Kelurahan</span>
                            <span class="font-semibold text-gray-900 text-right">{{ $pengajuan->kelurahan }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">Alamat Lengkap</span>
                            <span class="font-semibold text-gray-900 text-right max-w-[240px]">{{ $pengajuan->alamat_lengkap }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-50">
                            <span class="text-gray-500 font-semibold">No. WhatsApp</span>
                            <span class="font-mono text-gray-900 text-right">{{ $pengajuan->no_hp }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-500 font-semibold">Perguruan Tinggi</span>
                            <span class="font-bold text-emerald-800 text-right">{{ $pengajuan->nama_kampus }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-500 font-semibold">Program Studi</span>
                            <span class="font-bold text-gray-900 text-right">{{ $pengajuan->program_studi }} (Smtr {{ $pengajuan->semester }})</span>
                        </div>
                        <div class="flex justify-between py-1 bg-green-50/50 p-2 rounded-xl">
                            <span class="text-emerald-900 font-bold">IPK / Nilai Rapor</span>
                            <span class="font-mono font-black text-emerald-700 text-sm">{{ $pengajuan->ipk_nilai ? number_format($pengajuan->ipk_nilai, 2) : '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Card Berkas Dokumen Fisik -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm space-y-4">
                    <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                            Dokumen Lampiran Berkas
                        </h3>
                        <span class="text-[10px] font-bold text-gray-400">Tahap 2</span>
                    </div>

                    <div class="space-y-3">
                        <!-- File KTP -->
                        <div class="p-3 bg-gray-50 rounded-2xl border border-gray-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-700 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                                    Scan e-KTP Kota Batam
                                </span>
                                @if($pengajuan->file_ktp)
                                    <a href="{{ asset($pengajuan->file_ktp) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-white border border-gray-300 hover:border-gray-400 text-[11px] font-bold text-gray-700">
                                        Lihat Asli ↗
                                    </a>
                                @endif
                            </div>
                            @if($pengajuan->file_ktp)
                                <div class="rounded-xl overflow-hidden border border-gray-300 bg-black flex items-center justify-center max-h-48">
                                    <img src="{{ asset($pengajuan->file_ktp) }}" alt="e-KTP" class="max-h-48 object-contain">
                                </div>
                            @else
                                <p class="text-xs text-red-500 italic">Belum ada file KTP terlampir.</p>
                            @endif
                        </div>

                        <!-- File Rapor / UTBK -->
                        @if($pengajuan->file_raport)
                            <div class="p-3 bg-gray-50 rounded-2xl border border-gray-200 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-gray-700 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        Scan Rapor / Transkrip Nilai
                                    </span>
                                    <a href="{{ asset($pengajuan->file_raport) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-white border border-gray-300 hover:border-gray-400 text-[11px] font-bold text-gray-700">
                                        Lihat Asli ↗
                                    </a>
                                </div>
                                <div class="rounded-xl overflow-hidden border border-gray-300 bg-black flex items-center justify-center max-h-48">
                                    <img src="{{ asset($pengajuan->file_raport) }}" alt="Rapor" class="max-h-48 object-contain">
                                </div>
                            </div>
                        @endif

                        @if($pengajuan->file_utbk)
                            <div class="p-3 bg-gray-50 rounded-2xl border border-gray-200 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-gray-700 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        Sertifikat Nilai UTBK
                                    </span>
                                    <a href="{{ asset($pengajuan->file_utbk) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-white border border-gray-300 hover:border-gray-400 text-[11px] font-bold text-gray-700">
                                        Lihat Asli ↗
                                    </a>
                                </div>
                                <div class="rounded-xl overflow-hidden border border-gray-300 bg-black flex items-center justify-center max-h-48">
                                    <img src="{{ asset($pengajuan->file_utbk) }}" alt="UTBK" class="max-h-48 object-contain">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Hasil xAI Engine & Action Panel (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">

                <!-- CARD MATRIKS xAI EXPLAINABLE AI -->
                <div class="bg-gradient-to-br from-slate-950 via-neutral-900 to-black rounded-3xl border border-emerald-500/30 p-6 sm:p-8 text-white shadow-xl relative overflow-hidden space-y-6">
                    <div class="absolute -right-16 -top-16 h-56 w-56 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>

                    <!-- Header xAI -->
                    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-neutral-800 pb-5">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 mb-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>{{ $engine }}</span>
                            </div>
                            <h2 class="text-xl font-black text-white">Hasil Validasi Silang Pangkalan Data</h2>
                            <p class="text-xs text-gray-400 mt-1">Diverifikasi silang secara otomatis dengan Disdukcapil Batam & Kemdikbud</p>
                        </div>

                        <!-- Score Gauge -->
                        <div class="flex items-center gap-3 bg-neutral-900/90 border border-neutral-700 p-3.5 rounded-2xl shrink-0">
                            <div class="text-right">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Skor Kelayakan</p>
                                <p class="text-2xl font-black @if($score >= 85) text-emerald-400 @elseif($score >= 60) text-amber-400 @else text-red-400 @endif font-mono">
                                    {{ $score }}/100
                                </p>
                            </div>
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center font-black text-lg
                                @if($score >= 85) bg-emerald-500/20 text-emerald-400 border border-emerald-500/40
                                @elseif($score >= 60) bg-amber-500/20 text-amber-400 border border-amber-500/40
                                @else bg-red-500/20 text-red-400 border border-red-500/40 @endif">
                                {{ $score >= 85 ? 'A' : ($score >= 60 ? 'B' : 'C') }}
                            </div>
                        </div>
                    </div>

                    <!-- Rekomendasi Narasi xAI -->
                    <div class="relative z-10 p-4 rounded-2xl bg-white/[0.04] border border-white/10 space-y-1.5">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-black uppercase tracking-wider
                                @if($score >= 85) text-emerald-400 @elseif($score >= 60) text-amber-400 @else text-red-400 @endif">
                                ● Rekomendasi Keputusan xAI: {{ str_replace('_', ' ', $rekomendasi) }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed">{{ $kesimpulan }}</p>
                    </div>

                    <!-- Checklist Parameter Transparan -->
                    <div class="relative z-10 space-y-3 pt-2">
                        <p class="text-[11px] font-black uppercase tracking-wider text-gray-400">Rincian Parameter Yang Diuji (Audit Trail):</p>

                        @foreach($checks as $chk)
                            <div class="p-3.5 rounded-2xl bg-neutral-900/80 border border-neutral-800 space-y-2 transition-all hover:border-neutral-700">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-center gap-2">
                                        @if($chk['status'] === 'valid')
                                            <span class="w-6 h-6 rounded-lg bg-emerald-950 text-emerald-400 border border-emerald-800/80 flex items-center justify-center text-xs font-black shrink-0">✓</span>
                                        @elseif($chk['status'] === 'warning')
                                            <span class="w-6 h-6 rounded-lg bg-amber-950 text-amber-400 border border-amber-800/80 flex items-center justify-center text-xs font-black shrink-0">!</span>
                                        @elseif($chk['status'] === 'danger')
                                            <span class="w-6 h-6 rounded-lg bg-red-950 text-red-400 border border-red-800/80 flex items-center justify-center text-xs font-black shrink-0">✕</span>
                                        @else
                                            <span class="w-6 h-6 rounded-lg bg-blue-950 text-blue-400 border border-blue-800/80 flex items-center justify-center text-xs font-black shrink-0">i</span>
                                        @endif
                                        <div>
                                            <span class="text-xs font-bold text-white">{{ $chk['aspek'] }}</span>
                                            <span class="text-[10px] text-gray-400 ml-1.5 uppercase font-mono">({{ $chk['kategori'] }})</span>
                                        </div>
                                    </div>
                                    <span class="font-mono text-xs font-black @if($chk['skor'] == $chk['skor_maks']) text-emerald-400 @else text-amber-400 @endif shrink-0">
                                        {{ $chk['skor'] }}/{{ $chk['skor_maks'] }} pt
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px] bg-black/50 p-2.5 rounded-xl border border-neutral-800/80">
                                    <div>
                                        <span class="text-gray-400">Data Pemohon:</span>
                                        <p class="font-semibold text-gray-200 truncate">{{ $chk['data_pemohon'] }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">Pangkalan Eksternal:</span>
                                        <p class="font-semibold text-emerald-400 truncate">{{ $chk['data_sistem'] }}</p>
                                    </div>
                                </div>

                                <p class="text-[11px] text-gray-400 leading-relaxed pl-1">
                                    💡 <strong>Penjelasan AI:</strong> {{ $chk['penjelasan'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    @if(!empty($contributions))
                        <!-- FEATURE IMPORTANCE ATTRIBUTION (ML xAI) -->
                        <div class="relative z-10 space-y-3 pt-4 border-t border-neutral-800">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div>
                                    <p class="text-[11px] font-black uppercase tracking-wider text-emerald-400 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                        <span>Bobot Kontribusi Fitur Machine Learning (Feature Importance)</span>
                                    </p>
                                    <p class="text-[10px] text-gray-400 mt-0.5">Model: Random Forest Classifier (35 Estimators) &bull; Explainability: Gini Importance Attribution</p>
                                </div>
                                <span class="text-[10px] font-mono font-bold text-emerald-400 bg-emerald-950/60 border border-emerald-800/60 px-2 py-0.5 rounded-lg">Python Scikit-Learn</span>
                            </div>

                            <div class="grid grid-cols-1 gap-2.5 bg-neutral-900/80 border border-neutral-800 p-4 rounded-2xl">
                                @foreach($contributions as $item)
                                    @php
                                        $bobot = $item['bobot_kontribusi'] ?? 0;
                                        $status = $item['status'] ?? 'valid';
                                    @endphp
                                    <div class="space-y-1">
                                        <div class="flex items-center justify-between text-xs">
                                            <span class="text-gray-200 font-medium flex items-center gap-1.5">
                                                @if($status === 'valid')
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                                @elseif($status === 'warning')
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                                @else
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                                @endif
                                                {{ $item['fitur'] }}
                                            </span>
                                            <div class="flex items-center gap-2">
                                                <span class="font-mono text-[11px] font-bold text-emerald-400">{{ $bobot }}%</span>
                                                <span class="text-[9px] uppercase font-bold px-1.5 py-0.5 rounded
                                                    @if($status === 'valid') bg-emerald-950 text-emerald-300 border border-emerald-800/60
                                                    @elseif($status === 'warning') bg-amber-950 text-amber-300 border border-amber-800/60
                                                    @else bg-red-950 text-red-300 border border-red-800/60 @endif">
                                                    {{ $status }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="w-full bg-neutral-800 rounded-full h-1.5 overflow-hidden">
                                            <div class="h-1.5 rounded-full transition-all duration-500
                                                @if($status === 'valid') bg-gradient-to-r from-emerald-600 to-emerald-400
                                                @elseif($status === 'warning') bg-gradient-to-r from-amber-600 to-amber-400
                                                @else bg-gradient-to-r from-red-600 to-red-400 @endif"
                                                style="width: {{ min(100, max(6, $bobot * 2.5)) }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    </div>
                </div>

                <!-- ACTION DECISION PANEL -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-6">
                    <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-extrabold text-gray-900">
                                @if(Auth::user()->role === 'pimpinan')
                                    Penetapan Keputusan Pimpinan (SK Beasiswa)
                                @else
                                    Keputusan Tindakan Verifikator
                                @endif
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">Tentukan langkah tindak lanjut berdasarkan hasil telaah dokumen dan analisis xAI</p>
                        </div>
                    </div>

                    <!-- FOR VERIFIKATOR -->
                    @if(Auth::user()->role === 'verifikator' || Auth::user()->role === 'admin')
                        <div class="space-y-4">
                            <!-- 1. Tombol Setuju & Teruskan ke Pimpinan -->
                            <form action="{{ route('pegawai.pengajuan.teruskan', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin berkas telah valid dan siap diteruskan ke Pengambil Keputusan?')">
                                @csrf
                                <div class="p-4 bg-green-50/50 rounded-2xl border border-green-200 space-y-3">
                                    <div class="flex items-center gap-2 text-green-900 font-extrabold text-xs">
                                        <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Opsi 1: Setujui & Teruskan ke Pimpinan</span>
                                    </div>
                                    <input type="text" name="catatan" placeholder="Catatan rekomendasi verifikator untuk pimpinan (opsional)..." class="w-full bg-white border border-green-300 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-green-600 outline-none">
                                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#166534] hover:bg-green-800 text-white font-extrabold text-xs shadow-sm transition-all flex items-center justify-center gap-2">
                                        <span>Loloskan Verifikasi & Teruskan ke Pimpinan</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </button>
                                </div>
                            </form>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- 2. Kembalikan untuk Perbaikan -->
                                <form action="{{ route('pegawai.pengajuan.kembalikan', $pengajuan->id) }}" method="POST" class="p-4 bg-amber-50/50 rounded-2xl border border-amber-200 space-y-3" onsubmit="return confirm('Kembalikan berkas ke calon penerima untuk diperbaiki?')">
                                    @csrf
                                    <div class="text-amber-900 font-bold text-xs flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        <span>Opsi 2: Kembalikan ke Pemohon</span>
                                    </div>
                                    <textarea name="catatan_perbaikan" rows="3" required placeholder="Tuliskan alasan perbaikan (misal: Foto KTP terpotong / Scan rapor semester 3 buram)..." class="w-full bg-white border border-amber-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-amber-600 outline-none"></textarea>
                                    <button type="submit" class="w-full py-2 px-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs transition-colors">
                                        Kembalikan (Perlu Perbaikan)
                                    </button>
                                </form>

                                <!-- 3. Tolak Pengajuan -->
                                <form action="{{ route('pegawai.pengajuan.tolak', $pengajuan->id) }}" method="POST" class="p-4 bg-red-50/50 rounded-2xl border border-red-200 space-y-3" onsubmit="return confirm('Apakah Anda yakin ingin menolak pengajuan ini secara permanen?')">
                                    @csrf
                                    <div class="text-red-900 font-bold text-xs flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        <span>Opsi 3: Tolak Pengajuan</span>
                                    </div>
                                    <textarea name="alasan_penolakan" rows="3" required placeholder="Alasan penolakan mutlak (misal: NIK palsu / Tidak terdaftar di Batam)..." class="w-full bg-white border border-red-300 rounded-xl p-2.5 text-xs focus:ring-2 focus:ring-red-600 outline-none"></textarea>
                                    <button type="submit" class="w-full py-2 px-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs transition-colors">
                                        Tolak Permohonan
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    <!-- FOR PIMPINAN (PENGAMBIL KEPUTUSAN) -->
                    @if(Auth::user()->role === 'pimpinan')
                        <div class="space-y-4">
                            <form action="{{ route('pegawai.pengajuan.putuskan', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Simpan keputusan resmi penetapan beasiswa ini?')">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Pilih Keputusan Akhir:</label>
                                        <div class="grid grid-cols-2 gap-4">
                                            <label class="p-4 rounded-2xl border-2 border-green-300 bg-green-50/50 flex items-center gap-3 cursor-pointer hover:bg-green-50">
                                                <input type="radio" name="keputusan" value="disetujui" checked class="w-4 h-4 text-[#166534] focus:ring-[#166534]">
                                                <div>
                                                    <span class="block text-xs font-black text-green-900">SETUJUI BEASISWA</span>
                                                    <span class="text-[11px] text-green-700">Terbitkan SK Penerima Beasiswa</span>
                                                </div>
                                            </label>

                                            <label class="p-4 rounded-2xl border-2 border-red-300 bg-red-50/50 flex items-center gap-3 cursor-pointer hover:bg-red-50">
                                                <input type="radio" name="keputusan" value="ditolak" class="w-4 h-4 text-red-600 focus:ring-red-600">
                                                <div>
                                                    <span class="block text-xs font-black text-red-900">TOLAK BEASISWA</span>
                                                    <span class="text-[11px] text-red-700">Tidak Memenuhi Kuota/Kriteria</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Catatan SK / Pengambilan Keputusan (Opsional):</label>
                                        <textarea name="catatan" rows="3" placeholder="Masukkan nomor SK atau pertimbangan pimpinan..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-3 text-xs focus:ring-2 focus:ring-[#166534] outline-none"></textarea>
                                    </div>

                                    <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gray-900 hover:bg-black text-white font-black text-sm shadow-md transition-all flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Simpan & Terbitkan Keputusan Pimpinan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500">
        <p>&copy; 2026 Pemerintah Kota Batam &bull; Dinas Pendidikan &bull; Panel Pegawai Sistem Seleksi Beasiswa</p>
    </footer>

</body>
</html>
