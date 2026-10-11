<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Calon Penerima - BATAM EDU-GOV AI</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .card-hover {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased min-h-screen flex flex-col selection:bg-green-200">

    <!-- Outer Wrapper -->
    <div class="flex-1 flex flex-col md:flex-row min-h-screen">

        <!-- ============================================================== -->
        <!-- SIDEBAR (Modern & Clean, matching Wireframe layout)            -->
        <!-- ============================================================== -->
        <aside id="sidebar" class="w-full md:w-64 lg:w-72 bg-black border-r border-neutral-800 flex flex-col justify-between shrink-0 z-30 transition-all">
            
            <!-- Top Section: Brand & Nav Links -->
            <div>
                <!-- Brand Header -->
                <div class="p-5 border-b border-neutral-800 flex items-center justify-between">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo BATAM EDU-GOV AI" class="h-10 w-auto object-contain">
                    </a>

                    <!-- Mobile Toggle Button -->
                    <button type="button" onclick="toggleSidebarMenu()" class="md:hidden p-2 text-gray-400 hover:text-white rounded-lg hover:bg-neutral-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Role Badge in Sidebar -->
                <div class="px-5 pt-4 pb-2">
                    <div class="flex items-center justify-between text-xs font-semibold text-gray-400 mb-1">
                        <span class="uppercase tracking-wider text-[11px] text-gray-400">Portal Layanan</span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-neutral-900 text-green-400 border border-neutral-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Masyarakat
                        </span>
                    </div>
                </div>

                <!-- Navigation List -->
                <nav id="sidebar-nav" class="hidden md:block p-4 space-y-1.5">
                    
                    <!-- Item 1: DASHBOARD (Active) -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#166534] text-white text-sm font-semibold shadow-sm transition-all group">
                        <svg class="w-5 h-5 text-white/90 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Item 2: PENGAJUAN -->
                    <a href="{{ route('pengajuan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Pengajuan Beasiswa</span>
                    </a>

                    <!-- Item 3: STATUS -->
                    <button type="button" onclick="openStatusModal()" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Status Seleksi</span>
                    </button>

                    <!-- Item 4: BANTUAN -->
                    <a href="{{ route('bantuan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Pusat Bantuan</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Section: User Profile & Logout -->
            <div id="sidebar-footer" class="hidden md:block p-4 border-t border-neutral-800 bg-black">
                <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-neutral-900 transition-colors mb-2 cursor-pointer" onclick="openProfileModal()">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover ring-2 ring-green-600/30">
                    @else
                        <div class="w-10 h-10 rounded-full bg-[#166534] text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-neutral-800 text-gray-300 hover:text-red-400 hover:bg-neutral-900 hover:border-red-900/40 text-xs font-bold transition-all">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ============================================================== -->
        <!-- MAIN CONTENT AREA                                              -->
        <!-- ============================================================== -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Top Header Navbar (Black style matching landing page) -->
            <header class="bg-black border-b border-neutral-800 px-6 py-4 flex flex-wrap items-center justify-between gap-4 sticky top-0 z-20">
                
                <!-- Breadcrumbs / Hierarchy -->
                <div class="flex items-center gap-2 text-xs font-semibold text-gray-400">
                    <span class="bg-neutral-900 text-gray-300 px-2.5 py-1 rounded-md border border-neutral-800">
                        Sistem Calon Penerima
                    </span>
                    <span class="text-neutral-600">/</span>
                    <span class="text-white font-bold">Dinas Pendidikan Kota Batam</span>
                </div>

                <!-- Right Elements: NIK Badge & Avatar -->
                <div class="flex items-center gap-3">
                    <!-- NIK Badge -->
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-neutral-900 text-gray-300 rounded-lg text-xs font-mono border border-neutral-800">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                        </svg>
                        <span>NIK: 217101******</span>
                    </div>

                    <!-- User Avatar Button -->
                    <button type="button" onclick="openProfileModal()" class="flex items-center gap-2 p-1 pl-2 pr-3 bg-neutral-900 border border-neutral-800 rounded-full hover:bg-neutral-800 hover:border-neutral-700 transition-colors shadow-sm">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-7 h-7 rounded-full object-cover">
                        @else
                            <div class="w-7 h-7 rounded-full bg-[#166534] text-white flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-xs font-bold text-gray-200 hidden sm:inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Main Body -->
            <main class="flex-1 p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto">

                <!-- Welcome Flash Alert -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between text-emerald-800 text-sm font-medium shadow-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <!-- ========================================================== -->
                <!-- HEADER TITLE SECTION                                       -->
                <!-- ========================================================== -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-gray-200/80">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                            Dashboard Calon Penerima
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Selamat datang, <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>. Pantau kuota beasiswa dan ajukan berkas Anda di sini.
                        </p>
                    </div>

                    <!-- Status Pill (Matches Wireframe: STATUS: AKTIF) -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold shadow-sm self-start sm:self-auto">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>STATUS: PERIODE AKTIF 2025</span>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- 3 STAT / KPI CARDS ([01], [02], [03])                      -->
                <!-- ========================================================== -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Card [01]: STATUS -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 card-hover shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                                <span>Status Pengajuan</span>
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-[11px] font-mono">[01]</span>
                            </div>
                            @if(isset($latestPengajuan) && $latestPengajuan)
                                <div class="flex items-center gap-2.5 mb-1.5">
                                    <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <h3 class="text-xl font-extrabold text-emerald-800">Tahap Verifikasi</h3>
                                </div>
                                <span class="inline-block px-2.5 py-1 rounded-md bg-green-50 text-[#166534] border border-green-200 text-xs font-mono font-bold">
                                    {{ $latestPengajuan->nomor_registrasi }}
                                </span>
                            @else
                                <div class="flex items-center gap-2.5 mb-2">
                                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                    <h3 class="text-xl font-extrabold text-gray-900">Belum Mengajukan</h3>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            @if(isset($latestPengajuan) && $latestPengajuan)
                                <p class="text-xs text-gray-500 leading-relaxed">
                                    Jalur: <strong class="text-gray-800">{{ $latestPengajuan->jalur }}</strong> &bull; Berkas Anda sedang diproses oleh sistem.
                                </p>
                            @else
                                <p class="text-xs text-gray-500 leading-relaxed">
                                    Pilih jalur beasiswa untuk mengisi biodata dan mengunggah berkas persyaratan.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Card [02]: KUOTA -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 card-hover shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                                <span>Alokasi Kuota</span>
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-[11px] font-mono">[02]</span>
                            </div>
                            <div class="flex items-baseline gap-2 mb-2">
                                <h3 class="text-2xl font-extrabold text-[#166534]">1.250</h3>
                                <span class="text-sm font-semibold text-gray-500">Mahasiswa</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-500 leading-relaxed">
                                Total pagu beasiswa APBD Disdik Batam jenjang D4 & S1 tahun anggaran 2025.
                            </p>
                        </div>
                    </div>

                    <!-- Card [03]: JADWAL AKHIR -->
                    <div class="bg-white rounded-2xl border border-gray-200 p-6 card-hover shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">
                                <span>Jadwal Akhir Submit</span>
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-[11px] font-mono">[03]</span>
                            </div>
                            <div class="flex items-center gap-2.5 mb-2">
                                <h3 class="text-2xl font-extrabold text-gray-900">30 April 2025</h3>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-500">Batas akhir unggah & validasi</span>
                                <span class="text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md font-semibold text-[11px]">Sisa 20 Hari</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ========================================================== -->
                <!-- SECTION: STATUS / ACTION BANNER PENGAJUAN                  -->
                <!-- ========================================================== -->
                @if(isset($latestPengajuan) && $latestPengajuan)
                    <!-- Active Application Card -->
                    <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-5">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-green-100 text-[#166534]">
                                        TERDAFTAR
                                    </span>
                                    <span class="text-xs font-mono font-bold text-gray-500">{{ $latestPengajuan->nomor_registrasi }}</span>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900">Pengajuan Beasiswa: Jalur {{ $latestPengajuan->jalur }}</h2>
                                <p class="text-xs text-gray-500 mt-0.5">Dikirim pada {{ $latestPengajuan->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200 self-start sm:self-auto">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                                Menunggu Verifikasi & Validasi
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="text-gray-400 block font-medium mb-1">Nama Lengkap & NIK</span>
                                <p class="font-bold text-gray-900 text-sm">{{ $latestPengajuan->nama_lengkap }}</p>
                                <p class="font-mono text-gray-500 mt-0.5">{{ substr($latestPengajuan->nik, 0, 6) }}******{{ substr($latestPengajuan->nik, -4) }}</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="text-gray-400 block font-medium mb-1">Perguruan Tinggi & Prodi</span>
                                <p class="font-bold text-gray-900 text-sm">{{ $latestPengajuan->nama_kampus }}</p>
                                <p class="text-gray-500 mt-0.5">{{ $latestPengajuan->program_studi }} (NIM: {{ $latestPengajuan->nim }})</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="text-gray-400 block font-medium mb-1">Berkas Terlampir</span>
                                <div class="space-y-1 text-green-700 font-semibold mt-1">
                                    @if($latestPengajuan->file_ktp) <div>✓ e-KTP Batam</div> @endif
                                    @if($latestPengajuan->file_raport) <div>✓ Rapor / Transkrip</div> @endif
                                    @if($latestPengajuan->file_utbk) <div>✓ Sertifikat Nilai UTBK</div> @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <a href="{{ route('pengajuan.sukses', $latestPengajuan->id) }}" class="text-xs font-bold text-[#166534] hover:underline flex items-center gap-1">
                                <span>Lihat Bukti Tanda Terima Pengajuan</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>

                            <a href="{{ route('pengajuan.index') }}" class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 text-xs font-bold transition-all">
                                Ajukan Jalur Tambahan
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Call To Action Banner -->
                    <div class="bg-gradient-to-r from-gray-900 to-black rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                        <div class="space-y-3 z-10 max-w-xl">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/20 text-green-300 border border-green-500/30 text-xs font-bold">
                                PERIODE PENDAFTARAN SEDANG BERLANGSUNG
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                                Belum Mengajukan Bantuan Pendidikan?
                            </h2>
                            <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                                Manfaatkan pagu beasiswa Pemerintah Kota Batam 2025. Pilih salah satu jalur (SNBP, SNBT, atau Afirmasi Hinterland), lengkapi biodata diri, dan unggah dokumen persyaratan Anda.
                            </p>
                        </div>
                        <div class="z-10 shrink-0">
                            <a href="{{ route('pengajuan.index') }}" class="px-8 py-4 rounded-2xl bg-[#166534] hover:bg-green-700 text-white font-extrabold text-sm shadow-lg hover:shadow-xl transition-all flex items-center gap-3">
                                <span>Pilih Jalur & Ajukan Sekarang</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- ========================================================== -->
                <!-- SECTION: TAHAPAN SISTEM (STEP 01 - 04)                     -->
                <!-- ========================================================== -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-8 shadow-sm space-y-6">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 tracking-tight">Tahapan Alur Sistem Beasiswa</h2>
                            <p class="text-xs text-gray-500 mt-0.5">Alur proses pendaftaran mulai dari registrasi akun hingga pencairan dana</p>
                        </div>
                        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-full border border-gray-200 font-mono">
                            STEP 01 - 04
                        </span>
                    </div>

                    <!-- 4 Steps Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                        <!-- Step 01: Selesai -->
                        <div class="bg-green-50/60 border border-green-200 rounded-xl p-5 relative overflow-hidden">
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-8 h-8 rounded-full bg-[#166534] text-white flex items-center justify-center text-xs font-bold shadow-sm">
                                    01
                                </span>
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-green-700 bg-green-100 px-2 py-0.5 rounded-full">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Selesai
                                </span>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Registrasi & Akun</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Akun terverifikasi dengan email & identitas NIK Batam di portal.
                            </p>
                        </div>

                        <!-- Step 02: Sedang Dibuka / Saat Ini -->
                        <div class="bg-white border-2 border-[#166534] rounded-xl p-5 relative shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-8 h-8 rounded-full bg-[#166534] text-white flex items-center justify-center text-xs font-bold shadow-sm">
                                    02
                                </span>
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#166534] bg-green-50 px-2 py-0.5 rounded-full border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#166534] animate-ping"></span>
                                    Tahap Anda
                                </span>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Pilih Jalur & Upload Berkas</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Unggah KTP, KK, KHS / Rapor, dan surat keterangan aktif kuliah.
                            </p>
                        </div>

                        <!-- Step 03: Menunggu -->
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 relative opacity-85">
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center text-xs font-bold">
                                    03
                                </span>
                                <span class="text-[11px] font-semibold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">
                                    Menunggu Berkas
                                </span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Verifikasi & Validasi Disdik</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                Pengecekan keabsahan berkas dan validasi data oleh panitia seleksi.
                            </p>
                        </div>

                        <!-- Step 04: Menunggu -->
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 relative opacity-85">
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center text-xs font-bold">
                                    04
                                </span>
                                <span class="text-[11px] font-semibold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">
                                    Tahap Akhir
                                </span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-sm mb-1">Pengumuman & Pencairan Dana</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                SK Walikota diterbitkan dan dana ditransfer ke rekening Bank Riau Kepri.
                            </p>
                        </div>

                    </div>
                </div>

            </main>

            <!-- Reusable Footer Component -->
            <x-footer />

        </div>
    </div>

    <!-- ================================================================== -->
    <!-- MODAL: DETAIL STATUS SELEKSI                                       -->
    <!-- ================================================================== -->
    <div id="modal-status" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl border border-gray-200 max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl relative">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <div>
                    <span class="text-xs font-bold text-[#166534] uppercase tracking-wider">Status Pelacakan</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-0.5">Status Seleksi Beasiswa</h3>
                </div>
                <button type="button" onclick="closeStatusModal()" class="w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-900 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-4 text-xs">
                <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200 space-y-2.5">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">Nama Pemohon:</span>
                        <span class="font-bold text-gray-900">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">Email Akun:</span>
                        <span class="font-bold text-gray-900">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">Status Berkas:</span>
                        @if(isset($latestPengajuan) && $latestPengajuan)
                            <span class="font-bold text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-full text-[11px]">
                                Menunggu Verifikasi
                            </span>
                        @else
                            <span class="font-bold text-amber-800 bg-amber-100 px-2.5 py-1 rounded-full text-[11px]">
                                Belum Mengajukan
                            </span>
                        @endif
                    </div>
                </div>

                @if(isset($latestPengajuan) && $latestPengajuan)
                    <div class="border border-gray-200 rounded-2xl p-4 space-y-3">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="font-bold text-gray-800">No. Registrasi:</span>
                            <span class="font-mono font-bold text-green-700">{{ $latestPengajuan->nomor_registrasi }}</span>
                        </div>
                        <div class="space-y-2 text-gray-600">
                            <div class="flex items-center justify-between">
                                <span>Jalur Pengajuan:</span>
                                <span class="font-bold text-gray-900">Jalur {{ $latestPengajuan->jalur }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>1. Validasi Kependudukan NIK Batam</span>
                                <span class="text-green-700 font-bold">✓ Terpenuhi</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>2. Formulir & Biodata Lengkap</span>
                                <span class="text-green-700 font-bold">✓ Lengkap</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>3. Dokumen Persyaratan Digital</span>
                                <span class="text-green-700 font-bold">✓ Terunggah</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>4. Verifikasi & Validasi Disdik</span>
                                <span class="text-amber-600 font-semibold animate-pulse">Sedang Proses</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="border border-gray-200 rounded-2xl p-4 space-y-3">
                        <p class="font-bold text-gray-800 border-b border-gray-100 pb-2">Checklist Berkas Beasiswa:</p>
                        <div class="space-y-2 text-gray-600">
                            <div class="flex items-center justify-between">
                                <span>1. Akun & Validasi NIK Disdukcapil</span>
                                <span class="text-green-700 font-bold">✓ Terpenuhi</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>2. Formulir & Pilihan Jalur</span>
                                <span class="text-amber-600 font-semibold">Menunggu Pilihan</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>3. Unggah Berkas Persyaratan</span>
                                <span class="text-gray-400">Belum Ada</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>4. Verifikasi & Validasi Disdik</span>
                                <span class="text-gray-400">Belum Ada</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="border-t border-gray-100 pt-4 flex justify-end gap-3">
                <button type="button" onclick="closeStatusModal()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-gray-100 transition-colors">
                    Tutup
                </button>
                @if(isset($latestPengajuan) && $latestPengajuan)
                    <a href="{{ route('pengajuan.sukses', $latestPengajuan->id) }}" class="px-5 py-2.5 bg-[#166534] hover:bg-green-800 text-white rounded-xl text-sm font-bold shadow-md transition-all">
                        Bukti Tanda Terima
                    </a>
                @else
                    <a href="{{ route('pengajuan.index') }}" class="px-5 py-2.5 bg-[#166534] hover:bg-green-800 text-white rounded-xl text-sm font-bold shadow-md transition-all">
                        Pilih Jalur & Ajukan
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ================================================================== -->
    <!-- MODAL: INFORMASI AKUN PROFIL                                       -->
    <!-- ================================================================== -->
    <div id="modal-profile" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-gray-200 max-w-md w-full p-6 space-y-5 shadow-2xl relative">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-lg font-bold text-gray-900">Profil Calon Penerima</h3>
                <button type="button" onclick="closeProfileModal()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-900 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-200">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-14 h-14 rounded-full object-cover ring-2 ring-green-600/30">
                    @else
                        <div class="w-14 h-14 rounded-full bg-[#166534] text-white flex items-center justify-center text-xl font-bold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="min-w-0">
                        <h4 class="text-base font-bold text-gray-900 truncate">{{ Auth::user()->name }}</h4>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-1 text-[10px] font-bold text-green-800 bg-green-100 px-2 py-0.5 rounded-full">
                            Masyarakat Terverifikasi
                        </span>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-2xl p-4 space-y-2 text-xs">
                    <div class="flex justify-between py-1 border-b border-gray-100">
                        <span class="text-gray-500">Metode Masuk:</span>
                        <span class="font-bold text-gray-800">{{ Auth::user()->google_id ? 'Google OAuth' : 'Email/Password' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-100">
                        <span class="text-gray-500">Integrasi SIAK:</span>
                        <span class="font-bold text-green-700">Terhubung</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-gray-500">Tanggal Akun:</span>
                        <span class="font-bold text-gray-800">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '2025' }}</span>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-red-600 hover:bg-red-50 border border-red-200 transition-colors">
                        Keluar Akun
                    </button>
                </form>
                <button type="button" onclick="closeProfileModal()" class="px-5 py-2 rounded-xl bg-gray-900 hover:bg-black text-white text-xs font-bold transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleSidebarMenu() {
            const nav = document.getElementById('sidebar-nav');
            const footer = document.getElementById('sidebar-footer');
            if (nav.classList.contains('hidden')) {
                nav.classList.remove('hidden');
                footer.classList.remove('hidden');
            } else {
                nav.classList.add('hidden');
                footer.classList.add('hidden');
            }
        }

        function openStatusModal() {
            document.getElementById('modal-status').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('modal-status').classList.add('hidden');
        }

        function openProfileModal() {
            document.getElementById('modal-profile').classList.remove('hidden');
        }

        function closeProfileModal() {
            document.getElementById('modal-profile').classList.add('hidden');
        }

        // Close modal on background click
        window.addEventListener('click', function(event) {
            ['modal-status', 'modal-profile'].forEach(id => {
                const el = document.getElementById(id);
                if (event.target === el) {
                    el.classList.add('hidden');
                }
            });
        });
    </script>

</body>
</html>
