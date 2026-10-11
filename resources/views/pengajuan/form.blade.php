<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengajuan {{ $currentJalur['title'] }} - BATAM EDU-GOV AI</title>
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

        <!-- ============================================================== -->
        <!-- SIDEBAR (Black Theme)                                          -->
        <!-- ============================================================== -->
        <aside id="sidebar" class="w-full md:w-64 lg:w-72 bg-black border-r border-neutral-800 flex flex-col justify-between shrink-0 z-30 transition-all">
            
            <!-- Top Section -->
            <div>
                <div class="p-5 border-b border-neutral-800 flex items-center justify-between">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo BATAM EDU-GOV AI" class="h-10 w-auto object-contain">
                    </a>

                    <button type="button" onclick="toggleSidebarMenu()" class="md:hidden p-2 text-gray-400 hover:text-white rounded-lg hover:bg-neutral-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <div class="px-5 pt-4 pb-2">
                    <div class="flex items-center justify-between text-xs font-semibold text-gray-400 mb-1">
                        <span class="uppercase tracking-wider text-[11px] text-gray-400">Portal Layanan</span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-neutral-900 text-green-400 border border-neutral-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Masyarakat
                        </span>
                    </div>
                </div>

                <nav id="sidebar-nav" class="hidden md:block p-4 space-y-1.5">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('pengajuan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#166534] text-white text-sm font-semibold shadow-sm transition-all group">
                        <svg class="w-5 h-5 text-white/90 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Pengajuan Beasiswa</span>
                    </a>

                    <a href="{{ route('dashboard') }}#section-status" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Status Seleksi</span>
                    </a>

                    <a href="{{ route('bantuan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-neutral-900 text-sm font-medium transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Pusat Bantuan</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Section -->
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

            <!-- Top Header Navbar -->
            <header class="bg-black border-b border-neutral-800 px-6 py-4 flex flex-wrap items-center justify-between gap-4 sticky top-0 z-20">
                <div class="flex items-center gap-2 text-xs font-semibold text-gray-400">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-200 transition-colors">Dashboard</a>
                    <span class="text-neutral-600">/</span>
                    <a href="{{ route('pengajuan.index') }}" class="hover:text-gray-200 transition-colors">Pengajuan Beasiswa</a>
                    <span class="text-neutral-600">/</span>
                    <span class="text-white font-bold">{{ $currentJalur['title'] }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-neutral-900 text-gray-300 rounded-lg text-xs font-mono border border-neutral-800">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                        </svg>
                        <span>NIK: 217101******</span>
                    </div>

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
            <main class="flex-1 p-6 md:p-10 space-y-8 max-w-5xl w-full mx-auto">

                <!-- Alert Errors if any -->
                @if (isset($errors) && $errors->any())
                    <div class="p-5 bg-red-50 border border-red-200 rounded-2xl text-red-800 text-xs space-y-1.5 shadow-sm">
                        <div class="font-bold flex items-center gap-2 text-sm text-red-900">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Terdapat beberapa data yang belum lengkap atau tidak sesuai:
                        </div>
                        <ul class="list-disc list-inside space-y-1 pl-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- ========================================================== -->
                <!-- HEADER & JALUR BANNER                                      -->
                <!-- ========================================================== -->
                <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-green-100 text-[#166534] border border-green-200">
                                {{ $currentJalur['code'] }}
                            </span>
                            <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Pemerintah Kota Batam</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                            Formulir Pendaftaran: {{ $currentJalur['title'] }}
                        </h1>
                        <p class="text-xs text-gray-500">
                            {{ $currentJalur['subtitle'] }} &bull; Alokasi: <span class="font-bold text-[#166534]">{{ $currentJalur['nominal'] }}</span>
                        </p>
                    </div>

                    <a href="{{ route('pengajuan.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-gray-300 text-gray-600 hover:text-gray-900 bg-gray-50 text-xs font-bold transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Ganti Jalur Lain</span>
                    </a>
                </div>

                <!-- ========================================================== -->
                <!-- STEPPER PROGRESS WIZARD                                    -->
                <!-- ========================================================== -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Step 1 Button -->
                    <button type="button" id="tab-step-1" onclick="goToStep(1)" class="p-4 rounded-2xl border-2 border-[#166534] bg-green-50/50 flex items-center gap-3 text-left transition-all">
                        <div id="badge-step-1" class="w-9 h-9 rounded-xl bg-[#166534] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">
                            1
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Tahap 1</p>
                            <h4 class="text-sm font-extrabold text-gray-900">Pengisian Biodata Lengkap</h4>
                        </div>
                    </button>

                    <!-- Step 2 Button -->
                    <button type="button" id="tab-step-2" onclick="validateAndGoToStep2()" class="p-4 rounded-2xl border-2 border-gray-200 bg-white hover:border-gray-300 flex items-center gap-3 text-left transition-all">
                        <div id="badge-step-2" class="w-9 h-9 rounded-xl bg-gray-100 text-gray-500 flex items-center justify-center font-bold text-sm shrink-0">
                            2
                        </div>
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tahap 2</p>
                            <h4 id="title-step-2" class="text-sm font-bold text-gray-500">Unggah Dokumen Berkas</h4>
                        </div>
                    </button>
                </div>

                <!-- ========================================================== -->
                <!-- MULTI-STEP FORM                                            -->
                <!-- ========================================================== -->
                <form id="form-pengajuan" action="{{ route('pengajuan.store', $jalurKey) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- ====================================================== -->
                    <!-- STEP 1 CONTAINER: BIODATA                              -->
                    <!-- ====================================================== -->
                    <div id="container-step-1" class="space-y-8">

                        <!-- Section A: Data Pribadi & Identitas -->
                        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
                            <div class="border-b border-gray-100 pb-4">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#166534]"></span>
                                    1. Data Identitas Pribadi (Sesuai e-KTP)
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">Pastikan data sesuai dengan kartu identitas KTP Kota Batam resmi</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nama Lengkap Pemohon <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_lengkap" id="input_nama_lengkap" value="{{ old('nama_lengkap', $user->name) }}" required placeholder="Masukkan nama lengkap sesuai KTP" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">NIK e-KTP Batam (16 Digit) <span class="text-red-500">*</span></label>
                                    <input type="text" name="nik" id="input_nik" maxlength="16" value="{{ old('nik') }}" required placeholder="Contoh: 2171050809020004" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm font-mono focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                                    <input type="text" name="tempat_lahir" id="input_tempat_lahir" value="{{ old('tempat_lahir', 'Batam') }}" required placeholder="Kota tempat lahir" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_lahir" id="input_tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                    <select name="jenis_kelamin" id="input_jenis_kelamin" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nomor WhatsApp / HP Aktif <span class="text-red-500">*</span></label>
                                    <input type="tel" name="no_hp" id="input_no_hp" value="{{ old('no_hp') }}" required placeholder="Contoh: 081234567890" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Email Pemohon <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="input_email" value="{{ old('email', $user->email) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- Section B: Domisili Kota Batam -->
                        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
                            <div class="border-b border-gray-100 pb-4">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#166534]"></span>
                                    2. Alamat Domisili KTP di Kota Batam
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">Digunakan untuk validasi kependudukan SIAK Disdukcapil Kota Batam</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Kecamatan <span class="text-red-500">*</span></label>
                                    <select name="kecamatan" id="input_kecamatan" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                        <option value="">-- Pilih Kecamatan di Batam --</option>
                                        @php
                                            $kecamatans = ['Batam Kota', 'Batu Ampar', 'Bengkong', 'Nongsa', 'Sekupang', 'Lubuk Baja', 'Sagulung', 'Batu Aji', 'Belakang Padang', 'Bulang', 'Galang', 'Sei Beduk'];
                                        @endphp
                                        @foreach($kecamatans as $kec)
                                            <option value="{{ $kec }}" {{ old('kecamatan') == $kec ? 'selected' : '' }}>{{ $kec }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Kelurahan <span class="text-red-500">*</span></label>
                                    <input type="text" name="kelurahan" id="input_kelurahan" value="{{ old('kelurahan') }}" required placeholder="Contoh: Belian / Baloi Permai" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Alamat Lengkap (RT/RW, No Rumah, Nama Jalan) <span class="text-red-500">*</span></label>
                                    <textarea name="alamat_lengkap" id="input_alamat_lengkap" rows="3" required placeholder="Contoh: Perumahan Graha Batam Blok C No. 12, RT 02 / RW 05" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">{{ old('alamat_lengkap') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section C: Data Pendidikan & Akademik -->
                        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
                            <div class="border-b border-gray-100 pb-4">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#166534]"></span>
                                    3. Data Pendidikan & Akademik
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">Data perguruan tinggi atau jenjang pendidikan yang sedang ditempuh</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Perguruan Tinggi (PTN/PTS) <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_kampus" id="input_nama_kampus" value="{{ old('nama_kampus') }}" required placeholder="Contoh: Politeknik Negeri Batam / Universitas Riau" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Program Studi / Jurusan <span class="text-red-500">*</span></label>
                                    <input type="text" name="program_studi" id="input_program_studi" value="{{ old('program_studi') }}" required placeholder="Contoh: Teknik Informatika / Manajemen" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nomor Induk Mahasiswa (NIM) <span class="text-red-500">*</span></label>
                                    <input type="text" name="nim" id="input_nim" value="{{ old('nim') }}" required placeholder="Contoh: 3312311045" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm font-mono focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Semester <span class="text-red-500">*</span></label>
                                        <input type="number" name="semester" id="input_semester" min="1" max="14" value="{{ old('semester', 1) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">IPK / Nilai Rata-rata</label>
                                        <input type="number" step="0.01" min="0" max="4.00" name="ipk_nilai" id="input_ipk_nilai" value="{{ old('ipk_nilai') }}" placeholder="Contoh: 3.65" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Next Navigation Button -->
                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('pengajuan.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 text-sm font-bold transition-all">
                                Batal & Pilih Jalur Lain
                            </a>

                            <button type="button" onclick="validateAndGoToStep2()" class="px-8 py-3.5 rounded-xl bg-[#166534] hover:bg-green-800 text-white text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                                <span>Lanjut ke Upload Dokumen</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>

                    </div>

                    <!-- ====================================================== -->
                    <!-- STEP 2 CONTAINER: UPLOAD DOKUMEN                       -->
                    <!-- ====================================================== -->
                    <div id="container-step-2" class="hidden space-y-8">

                        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
                            <div class="border-b border-gray-100 pb-4">
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-bold text-xs mb-2">
                                    MODUL EKSTRAKSI BERKAS
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">
                                    Unggah Berkas Persyaratan ({{ $currentJalur['title'] }})
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    Sistem akan memproses dokumen menggunakan AI OCR untuk mengekstrak identitas NIK, nama, dan nilai akademik secara akurat.
                                </p>
                            </div>

                            <!-- List of Required Documents specific to the path -->
                            <div class="space-y-6">

                                <!-- DOKUMEN 1: E-KTP (Semua Jalur) -->
                                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50 hover:bg-green-50/20 transition-all text-center relative group">
                                    <div class="max-w-md mx-auto space-y-3">
                                        <div class="w-12 h-12 rounded-2xl bg-white text-[#166534] shadow-sm flex items-center justify-center mx-auto border border-gray-200 group-hover:scale-105 transition-transform">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-900">Scan e-KTP Kota Batam <span class="text-red-500">*</span></h4>
                                            <p class="text-xs text-gray-500 mt-1">File KTP asli Kota Batam (JPG, PNG, atau PDF maks 5MB). Pastikan NIK dan foto terbaca jelas untuk ekstraksi OCR.</p>
                                        </div>
                                        <input type="file" name="file_ktp" id="file_ktp" accept=".pdf,.jpg,.jpeg,.png" required onchange="handleFilePreview('file_ktp', 'preview_ktp')" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#166534] file:text-white hover:file:bg-green-800 file:cursor-pointer cursor-pointer">
                                        <div id="preview_ktp" class="hidden text-xs font-semibold text-green-700 bg-green-50 p-2 rounded-lg border border-green-200 text-center"></div>
                                    </div>
                                </div>

                                @if($jalurKey === 'snbp')
                                    <!-- DOKUMEN 2 (SNBP): Scan Rapor SMA / Transkrip -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50 hover:bg-green-50/20 transition-all text-center relative group">
                                        <div class="max-w-md mx-auto space-y-3">
                                            <div class="w-12 h-12 rounded-2xl bg-white text-emerald-700 shadow-sm flex items-center justify-center mx-auto border border-gray-200 group-hover:scale-105 transition-transform">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-bold text-gray-900">Scan Rapor SMA / Transkrip Nilai <span class="text-red-500">*</span></h4>
                                                <p class="text-xs text-gray-500 mt-1">Scan halaman nilai semester akhir SMA/SMK atau transkrip resmi PTN (PDF/JPG/PNG maks 5MB) untuk ekstraksi nilai AI OCR.</p>
                                            </div>
                                            <input type="file" name="file_raport" id="file_raport" accept=".pdf,.jpg,.jpeg,.png" required onchange="handleFilePreview('file_raport', 'preview_raport')" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#166534] file:text-white hover:file:bg-green-800 file:cursor-pointer cursor-pointer">
                                            <div id="preview_raport" class="hidden text-xs font-semibold text-green-700 bg-green-50 p-2 rounded-lg border border-green-200 text-center"></div>
                                        </div>
                                    </div>
                                @endif

                                @if($jalurKey === 'snbt')
                                    <!-- DOKUMEN 2 (SNBT): Sertifikat Nilai UTBK -->
                                    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 bg-gray-50 hover:bg-blue-50/20 transition-all text-center relative group">
                                        <div class="max-w-md mx-auto space-y-3">
                                            <div class="w-12 h-12 rounded-2xl bg-white text-blue-700 shadow-sm flex items-center justify-center mx-auto border border-gray-200 group-hover:scale-105 transition-transform">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-bold text-gray-900">Sertifikat Nilai UTBK Resmi <span class="text-red-500">*</span></h4>
                                                <p class="text-xs text-gray-500 mt-1">Sertifikat resmi skor UTBK yang diterbitkan panitia SNPMB / Kemendikbud (PDF/JPG/PNG maks 5MB) untuk verifikasi nilai kuantitatif.</p>
                                            </div>
                                            <input type="file" name="file_utbk" id="file_utbk" accept=".pdf,.jpg,.jpeg,.png" required onchange="handleFilePreview('file_utbk', 'preview_utbk')" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-900 file:text-white hover:file:bg-black file:cursor-pointer cursor-pointer">
                                            <div id="preview_utbk" class="hidden text-xs font-semibold text-blue-700 bg-blue-50 p-2 rounded-lg border border-blue-200 text-center"></div>
                                        </div>
                                    </div>
                                @endif

                                @if($jalurKey === 'hinterland')
                                    <!-- Catatan Jalur Hinterland -->
                                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl text-xs text-amber-900 flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-700 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <p>
                                            <strong>Khusus Jalur Hinterland:</strong> Pada tahap MVP ini, Anda cukup mengunggah <strong>Scan e-KTP Kota Batam</strong> dengan alamat kepulauan (Belakang Padang, Galang, Bulang). Surat rekomendasi dan KK pendukung dapat disusulkan pada tahap verifikasi manual.
                                        </p>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <!-- Pernyataan & Tombol Submit -->
                        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-sm">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input type="checkbox" required class="w-4 h-4 rounded text-[#166534] focus:ring-[#166534] mt-0.5">
                                <span class="text-xs text-gray-600 leading-relaxed">
                                    Saya menyatakan dengan sesungguhnya bahwa seluruh data biodata dan berkas dokumen yang saya lampirkan adalah benar, sah, dan dapat dipertanggungjawabkan di hadapan hukum dan Dinas Pendidikan Kota Batam.
                                </span>
                            </label>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <button type="button" onclick="goToStep(1)" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 text-sm font-bold transition-all flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                    <span>Kembali ke Biodata</span>
                                </button>

                                <button type="submit" class="px-8 py-3.5 rounded-xl bg-[#166534] hover:bg-green-800 text-white text-sm font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                                    <span>Kirim Pengajuan Beasiswa</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </div>
                        </div>

                    </div>

                </form>

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

        function openProfileModal() {
            document.getElementById('modal-profile').classList.remove('hidden');
        }

        function closeProfileModal() {
            document.getElementById('modal-profile').classList.add('hidden');
        }

        function goToStep(step) {
            const step1Container = document.getElementById('container-step-1');
            const step2Container = document.getElementById('container-step-2');
            const tab1 = document.getElementById('tab-step-1');
            const tab2 = document.getElementById('tab-step-2');
            const badge1 = document.getElementById('badge-step-1');
            const badge2 = document.getElementById('badge-step-2');
            const title2 = document.getElementById('title-step-2');

            if (step === 1) {
                step1Container.classList.remove('hidden');
                step2Container.classList.add('hidden');

                tab1.className = 'p-4 rounded-2xl border-2 border-[#166534] bg-green-50/50 flex items-center gap-3 text-left transition-all';
                badge1.className = 'w-9 h-9 rounded-xl bg-[#166534] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm';

                tab2.className = 'p-4 rounded-2xl border-2 border-gray-200 bg-white hover:border-gray-300 flex items-center gap-3 text-left transition-all';
                badge2.className = 'w-9 h-9 rounded-xl bg-gray-100 text-gray-500 flex items-center justify-center font-bold text-sm shrink-0';
                title2.className = 'text-sm font-bold text-gray-500';
            } else if (step === 2) {
                step1Container.classList.add('hidden');
                step2Container.classList.remove('hidden');

                tab1.className = 'p-4 rounded-2xl border-2 border-gray-200 bg-white hover:border-gray-300 flex items-center gap-3 text-left transition-all';
                badge1.className = 'w-9 h-9 rounded-xl bg-green-100 text-[#166534] flex items-center justify-center font-bold text-sm shrink-0';

                tab2.className = 'p-4 rounded-2xl border-2 border-[#166534] bg-green-50/50 flex items-center gap-3 text-left transition-all';
                badge2.className = 'w-9 h-9 rounded-xl bg-[#166534] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm';
                title2.className = 'text-sm font-extrabold text-gray-900';

                window.scrollTo({ top: 150, behavior: 'smooth' });
            }
        }

        function validateAndGoToStep2() {
            const requiredFields = [
                'input_nama_lengkap',
                'input_nik',
                'input_tempat_lahir',
                'input_tanggal_lahir',
                'input_jenis_kelamin',
                'input_no_hp',
                'input_email',
                'input_kecamatan',
                'input_kelurahan',
                'input_alamat_lengkap',
                'input_nama_kampus',
                'input_program_studi',
                'input_nim',
                'input_semester'
            ];

            let firstInvalid = null;
            for (const id of requiredFields) {
                const el = document.getElementById(id);
                if (el && !el.value.trim()) {
                    firstInvalid = el;
                    el.classList.add('border-red-500', 'bg-red-50/50');
                } else if (el) {
                    el.classList.remove('border-red-500', 'bg-red-50/50');
                }
            }

            const nikEl = document.getElementById('input_nik');
            if (nikEl && nikEl.value.trim().length !== 16) {
                alert('NIK e-KTP harus berjumlah 16 digit angka.');
                nikEl.focus();
                return;
            }

            if (firstInvalid) {
                alert('Silakan lengkapi seluruh data bertanda bintang (*) pada Biodata sebelum melanjutkan ke tahap upload berkas.');
                firstInvalid.focus();
                return;
            }

            goToStep(2);
        }

        function handleFilePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            if (input && input.files && input.files[0]) {
                const file = input.files[0];
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                preview.innerHTML = `✓ Terpilih: <span class="font-bold">${file.name}</span> (${fileSize} MB) - Siap diekstrak AI OCR`;
                preview.classList.remove('hidden');
            } else if (preview) {
                preview.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
