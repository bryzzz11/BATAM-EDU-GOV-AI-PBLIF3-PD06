<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jalur Pengajuan - BATAM EDU-GOV AI</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
        .card-hover {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -12px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased min-h-screen flex flex-col selection:bg-green-200">

    <!-- Outer Wrapper -->
    <div class="flex-1 flex flex-col md:flex-row min-h-screen">

        <!-- ============================================================== -->
        <!-- SIDEBAR (Black Theme)                                          -->
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
                    
                    <!-- Item 1: DASHBOARD -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Item 2: PENGAJUAN (Active) -->
                    <a href="{{ route('pengajuan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#166534] text-white text-sm font-semibold shadow-sm transition-all group">
                        <svg class="w-5 h-5 text-white/90 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Pengajuan Beasiswa</span>
                    </a>

                    <!-- Item 3: STATUS -->
                    <a href="{{ route('dashboard') }}#section-status" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Status Seleksi</span>
                    </a>

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

            <!-- Top Header Navbar (Black Theme) -->
            <header class="bg-black border-b border-neutral-800 px-6 py-4 flex flex-wrap items-center justify-between gap-4 sticky top-0 z-20">
                
                <!-- Breadcrumbs / Hierarchy -->
                <div class="flex items-center gap-2 text-xs font-semibold text-gray-400">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-200 transition-colors">Dashboard</a>
                    <span class="text-neutral-600">/</span>
                    <span class="bg-neutral-900 text-gray-300 px-2.5 py-1 rounded-md border border-neutral-800">
                        Pengajuan Beasiswa
                    </span>
                    <span class="text-neutral-600">/</span>
                    <span class="text-white font-bold">Pilih Jalur</span>
                </div>

                <!-- Right Elements: NIK Badge & Avatar -->
                <div class="flex items-center gap-3">
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

                @if(session('error'))
                    <div class="p-4 bg-red-50 border border-red-200 rounded-2xl flex items-center justify-between text-red-800 text-sm font-medium shadow-sm">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- ========================================================== -->
                <!-- HEADER TITLE SECTION                                       -->
                <!-- ========================================================== -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-gray-200/80">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-50 border border-green-200 text-xs font-bold text-green-800 mb-2">
                            TAHUN ANGGARAN 2025
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                            Pilih Jalur Pengajuan Beasiswa
                        </h1>
                        <p class="text-sm text-gray-600 mt-1 max-w-3xl">
                            Tentukan jalur bantuan pendidikan Pemerintah Kota Batam yang sesuai dengan status kelulusan, domisili, atau prestasi akademik Anda. Setelah memilih, Anda akan diarahkan untuk mengisi biodata dan mengunggah dokumen persyaratan.
                        </p>
                    </div>

                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 text-xs font-bold transition-all self-start sm:self-auto shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </div>

                <!-- ========================================================== -->
                <!-- 3 JALUR CARDS GRID                                         -->
                <!-- ========================================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-2">

                    <!-- JALUR 1: JALUR SNBP -->
                    <div class="bg-white rounded-2xl border-2 border-transparent hover:border-green-300 p-6 card-hover shadow-sm flex flex-col justify-between space-y-6 relative">
                        <div class="space-y-5">
                            <!-- Card Header -->
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold text-[#166534] bg-green-50 px-2.5 py-1 rounded-md border border-green-200">
                                    SNBP-01
                                </span>
                                <span class="text-xs font-semibold text-gray-500">Prestasi Akademik</span>
                            </div>

                            <!-- Icon & Title Illustration Box -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50/40 rounded-2xl p-5 border border-green-100 flex flex-col items-center text-center">
                                <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-[#166534] mb-3 border border-green-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Jalur SNBP</h3>
                                <p class="text-xs text-gray-500 mt-1">Seleksi Nasional Berdasarkan Prestasi</p>
                                <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-white text-xs font-bold text-[#166534] border border-green-200 shadow-xs">
                                    Rp 6.000.000 / semester
                                </div>
                            </div>

                            <!-- Requirements List -->
                            <div class="space-y-2.5 pt-1">
                                <p class="text-xs font-bold text-gray-700 uppercase tracking-wider">Persyaratan Utama:</p>
                                <ul class="text-xs text-gray-600 space-y-2">
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Mahasiswa baru yang lolos seleksi SNBP di PTN</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Memiliki e-KTP dan KK Kota Batam resmi</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>IPK minimal 3.25 atau Rapor SMA terverifikasi</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Dokumen Diperlukan Box -->
                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 text-xs">
                                <span class="font-bold text-gray-700 block mb-1">Dokumen Wajib:</span>
                                <span class="text-gray-500">Scan e-KTP Batam + Scan Rapor SMA / Transkrip</span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ route('pengajuan.form', 'snbp') }}" class="w-full py-3.5 px-4 bg-[#166534] hover:bg-green-800 text-white rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
                                <span>Ajukan Jalur SNBP</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- JALUR 2: JALUR SNBT -->
                    <div class="bg-white rounded-2xl border-2 border-transparent hover:border-blue-300 p-6 card-hover shadow-sm flex flex-col justify-between space-y-6 relative">
                        <div class="space-y-5">
                            <!-- Card Header -->
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold text-blue-800 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">
                                    SNBT-02
                                </span>
                                <span class="text-xs font-semibold text-gray-500">Tes Skolastik</span>
                            </div>

                            <!-- Icon & Title Illustration Box -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50/40 rounded-2xl p-5 border border-blue-100 flex flex-col items-center text-center">
                                <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-blue-700 mb-3 border border-blue-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Jalur SNBT</h3>
                                <p class="text-xs text-gray-500 mt-1">Seleksi Nasional Berdasarkan Tes UTBK</p>
                                <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-white text-xs font-bold text-blue-700 border border-blue-200 shadow-xs">
                                    Rp 7.000.000 / semester
                                </div>
                            </div>

                            <!-- Requirements List -->
                            <div class="space-y-2.5 pt-1">
                                <p class="text-xs font-bold text-gray-700 uppercase tracking-wider">Persyaratan Utama:</p>
                                <ul class="text-xs text-gray-600 space-y-2">
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Lolos seleksi UTBK-SNBT di PTN terakreditasi</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Mahasiswa aktif semester 1 sampai dengan 4</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Melampirkan sertifikat skor UTBK resmi</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Dokumen Diperlukan Box -->
                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 text-xs">
                                <span class="font-bold text-gray-700 block mb-1">Dokumen Wajib:</span>
                                <span class="text-gray-500">Scan e-KTP Batam + Sertifikat Nilai UTBK</span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ route('pengajuan.form', 'snbt') }}" class="w-full py-3.5 px-4 bg-gray-900 hover:bg-black text-white rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
                                <span>Ajukan Jalur SNBT</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- JALUR 3: JALUR HINTERLAND -->
                    <div class="bg-white rounded-2xl border-2 border-transparent hover:border-amber-300 p-6 card-hover shadow-sm flex flex-col justify-between space-y-6 relative">
                        <div class="space-y-5">
                            <!-- Card Header -->
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold text-amber-800 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                                    HTL-03
                                </span>
                                <span class="text-xs font-semibold text-gray-500">Afirmasi Wilayah</span>
                            </div>

                            <!-- Icon & Title Illustration Box -->
                            <div class="bg-gradient-to-br from-amber-50 to-orange-50/40 rounded-2xl p-5 border border-amber-100 flex flex-col items-center text-center">
                                <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-amber-700 mb-3 border border-amber-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Jalur Hinterland</h3>
                                <p class="text-xs text-gray-500 mt-1">Afirmasi Kepulauan & Pesisir Batam</p>
                                <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-white text-xs font-bold text-amber-800 border border-amber-200 shadow-xs">
                                    Rp 6.000.000 / semester
                                </div>
                            </div>

                            <!-- Requirements List -->
                            <div class="space-y-2.5 pt-1">
                                <p class="text-xs font-bold text-gray-700 uppercase tracking-wider">Persyaratan Utama:</p>
                                <ul class="text-xs text-gray-600 space-y-2">
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Putra/putri pulau (Belakang Padang, Galang, Bulang)</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Surat rekomendasi camat / lurah setempat</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>KTP & KK domisili kepulauan minimal 3 tahun</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Dokumen Diperlukan Box -->
                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 text-xs">
                                <span class="font-bold text-gray-700 block mb-1">Dokumen Wajib:</span>
                                <span class="text-gray-500">Scan e-KTP Domisili Hinterland</span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ route('pengajuan.form', 'hinterland') }}" class="w-full py-3.5 px-4 bg-[#166534] hover:bg-green-800 text-white rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
                                <span>Ajukan Jalur Hinterland</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                </div>

            </main>

            <!-- Reusable Footer Component -->
            <x-footer />

        </div>
    </div>

    <!-- Modal Profile Info -->
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
        function openProfileModal() {
            document.getElementById('modal-profile').classList.remove('hidden');
        }
        function closeProfileModal() {
            document.getElementById('modal-profile').classList.add('hidden');
        }
    </script>
</body>
</html>
