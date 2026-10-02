<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BATAM EDU-GOV AI</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes scan {
            0% { transform: translateY(-100%); }
            50% { transform: translateY(300%); }
            100% { transform: translateY(-100%); }
        }
        .animate-scan {
            animation: scan 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased selection:bg-green-200">

    <!-- Navigation -->
    <nav class="bg-black border-b border-gray-900 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Left Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-12 md:h-14 w-auto object-contain" src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo">
                </div>
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-2 items-center bg-neutral-900 p-1 rounded-full border border-neutral-800">
                    <a href="#" class="bg-[#166534] text-white px-5 py-2 rounded-full text-sm font-semibold shadow-sm">Beranda/Publik</a>
                    <a href="#" class="text-gray-300 hover:text-white px-5 py-2 rounded-full text-sm font-medium transition-colors">Alur & Persyaratan</a>
                    <a href="#" class="text-gray-300 hover:text-white px-5 py-2 rounded-full text-sm font-medium transition-colors">Lacak Berkas</a>
                    <a href="#" class="text-gray-300 hover:text-white px-5 py-2 rounded-full text-sm font-medium transition-colors">Pusat Bantuan</a>
                </div>
                <!-- Right Action Buttons -->
                <div class="hidden sm:flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-white text-black px-5 py-2 rounded-lg text-sm font-bold hover:bg-gray-200 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-white text-black px-5 py-2 rounded-lg text-sm font-bold hover:bg-gray-200 transition-colors shadow-sm">Daftar Akun</a>
                            @endif
                        @endauth
                    @else
                        <a href="/login" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Masuk</a>
                        <a href="/register" class="bg-white text-black px-5 py-2 rounded-lg text-sm font-bold hover:bg-gray-200 transition-colors shadow-sm">Daftar Akun</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden pb-16 pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 text-xs font-semibold text-gray-600 mb-6 tracking-wide">
                        SISTEM VERIFIKASI BERKAS TERINTEGRASI
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6 tracking-tight">
                        Bantuan Pendidikan Tinggi Kota Batam, <span class="text-[#166534]">Lebih Mudah dan Transparan</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-lg leading-relaxed">
                        Ajukan bantuan pendidikan secara digital dengan proses verifikasi dokumen yang dibantu teknologi AI dan diawasi langsung oleh Pemerintah Kota Batam.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="#" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-semibold rounded-lg shadow-sm text-white bg-[#166534] hover:bg-green-800 transition-colors">
                            Ajukan Bantuan Sekarang
                        </a>
                        <a href="#" class="inline-flex justify-center items-center px-8 py-3.5 border border-gray-300 text-base font-semibold rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-sm">
                            Cek Status Pengajuan
                        </a>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 font-medium bg-green-50/50 p-3 rounded-lg border border-green-100 inline-flex">
                        Terintegrasi Sistem Single Identity Disdukcapil & PDDIKTI Kemendikbudristek
                    </div>
                </div>
                
                <!-- Hero Image Area (Carousel) -->
                <div class="relative w-full h-[400px] md:h-[500px] rounded-2xl shadow-2xl overflow-hidden group" id="heroCarouselWrapper">
                    <!-- Slides -->
                    <div class="relative w-full h-full">

                        <!-- Slide 1 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-100">
                            <img src="{{ asset('SMA.jpg') }}" alt="Siswa Bahagia" class="w-full h-full object-cover" style="object-position: center 20%; transform: scale(1.05);">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 right-8 text-white">
                                <span class="bg-[#166534] px-3 py-1 rounded text-xs font-bold mb-3 inline-block shadow-sm">Jalur SNBP</span>
                                <h3 class="text-2xl font-bold mb-2">Wujudkan Cita-cita Generasi Emas Batam</h3>
                                <p class="text-sm text-gray-200">Mendukung putra-putri daerah meraih pendidikan tinggi yang berkualitas.</p>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0">
                            <img src="{{ asset('Wisuda.jpg') }}" alt="Suasana Wisuda" class="w-full h-full object-cover" style="object-position: center 30%; transform: scale(1.05);">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 right-8 text-white">
                                <span class="bg-[#166534] px-3 py-1 rounded text-xs font-bold mb-3 inline-block shadow-sm">Jalur SNBT</span>
                                <h3 class="text-2xl font-bold mb-2">Dukungan Penuh Untuk Mahasiswa Aktif</h3>
                                <p class="text-sm text-gray-200">Alokasi pagu bantuan pendidikan hingga Rp 7.000.000 per semester.</p>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0">
                            <img src="{{ asset('Mahasiswa Pace.jpg') }}" alt="Belajar Bersama" class="w-full h-full object-cover" style="object-position: center 25%; transform: scale(1.05);">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 right-8 text-white">
                                <span class="bg-[#166534] px-3 py-1 rounded text-xs font-bold mb-3 inline-block shadow-sm">Hinterland & Pesisir</span>
                                <h3 class="text-2xl font-bold mb-2">Pemerataan Pendidikan Hingga ke Pelosok</h3>
                                <p class="text-sm text-gray-200">Afirmasi khusus bagi masyarakat kepulauan dan pulau penyangga Batam.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <button onclick="heroCarouselPrev()" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/30 hover:bg-black/50 backdrop-blur-md text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all cursor-pointer z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button onclick="heroCarouselNext()" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/30 hover:bg-black/50 backdrop-blur-md text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all cursor-pointer z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>

                    <!-- Dot Indicators -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10" id="heroDots">
                        <button onclick="heroCarouselGoTo(0)" class="hero-dot w-2 h-2 rounded-full bg-white transition-all"></button>
                        <button onclick="heroCarouselGoTo(1)" class="hero-dot w-2 h-2 rounded-full bg-white/40 transition-all"></button>
                        <button onclick="heroCarouselGoTo(2)" class="hero-dot w-2 h-2 rounded-full bg-white/40 transition-all"></button>
                    </div>

                    <script>
                        var _heroIdx = 0;
                        var _heroSlides = null;
                        var _heroDots = null;
                        function _heroInit() {
                            _heroSlides = document.querySelectorAll('.hero-slide');
                            _heroDots = document.querySelectorAll('.hero-dot');
                        }
                        function heroCarouselGoTo(idx) {
                            if (!_heroSlides) _heroInit();
                            _heroSlides[_heroIdx].classList.remove('opacity-100');
                            _heroSlides[_heroIdx].classList.add('opacity-0');
                            _heroDots[_heroIdx].classList.remove('bg-white');
                            _heroDots[_heroIdx].classList.add('bg-white/40');
                            _heroIdx = idx;
                            _heroSlides[_heroIdx].classList.remove('opacity-0');
                            _heroSlides[_heroIdx].classList.add('opacity-100');
                            _heroDots[_heroIdx].classList.remove('bg-white/40');
                            _heroDots[_heroIdx].classList.add('bg-white');
                        }
                        function heroCarouselNext() {
                            if (!_heroSlides) _heroInit();
                            heroCarouselGoTo((_heroIdx + 1) % _heroSlides.length);
                        }
                        function heroCarouselPrev() {
                            if (!_heroSlides) _heroInit();
                            heroCarouselGoTo((_heroIdx - 1 + _heroSlides.length) % _heroSlides.length);
                        }
                        // Auto-play every 5 seconds
                        setInterval(heroCarouselNext, 5000);
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 grid grid-cols-2 lg:grid-cols-4 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Alokasi APBD</p>
                </div>
                <p class="text-2xl font-extrabold text-gray-900 mb-1">Rp 14.8 Miliar</p>
                <p class="text-xs text-gray-500">Tahun Anggaran Berjalan 2025</p>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Target Penerima</p>
                </div>
                <p class="text-2xl font-extrabold text-gray-900 mb-1">3.420 Kuota</p>
                <p class="text-xs text-gray-500">Mahasiswa D3, D4 & S1 Aktif</p>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Sebaran Wilayah</p>
                </div>
                <p class="text-2xl font-extrabold text-gray-900 mb-1">12 Kecamatan</p>
                <p class="text-xs text-gray-500">Termasuk 3 Kecamatan Kepulauan</p>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-xs font-bold text-green-600 uppercase tracking-wider">Integritas Audit</p>
                </div>
                <p class="text-2xl font-extrabold text-[#166534] mb-1">100% Terbuka</p>
                <p class="text-xs text-green-700">Akuntabel & Bebas Pungutan</p>
            </div>
        </div>
    </div>

    <!-- Process Flow (Arsitektur Jalur Pemrosesan Berkas) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 lg:p-8 relative">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        Arsitektur Jalur Pemrosesan Berkas
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">Transparansi setiap tahapan dari input warga hingga terbit SK Walikota</p>
                </div>
                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded border border-green-200 hidden sm:inline-block">Sync Inreal-time Database</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 relative">
                <!-- Connecting Line -->
                <div class="hidden md:block absolute top-6 left-10 right-10 h-0.5 bg-gray-200 z-0"></div>
                
                <!-- Step 1 -->
                <div class="relative z-10 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-[#166534] text-white flex items-center justify-center text-sm font-bold mb-3 shadow-md">1</div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Warga Batam</h4>
                    <p class="text-xs text-gray-500 leading-tight">Validasi NIK e-KTP langsung di database SIAK Disdukcapil.</p>
                </div>
                <!-- Step 2 -->
                <div class="relative z-10 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-300 text-gray-700 flex items-center justify-center text-sm font-bold mb-3">2</div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Upload Digital</h4>
                    <p class="text-xs text-gray-500 leading-tight">Unggah berkas KTP, KK, Rekening & Surat Keterangan Kampus.</p>
                </div>
                <!-- Step 3 -->
                <div class="relative z-10 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-300 text-gray-700 flex items-center justify-center text-sm font-bold mb-3">3</div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Verifikasi Sistem</h4>
                    <p class="text-xs text-gray-500 leading-tight">Pencocokan data otomatis, kelengkapan format, & keabsahan berkas.</p>
                </div>
                <!-- Step 4 -->
                <div class="relative z-10 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-300 text-gray-700 flex items-center justify-center text-sm font-bold mb-3">4</div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Verifikasi Petugas</h4>
                    <p class="text-xs text-gray-500 leading-tight">Audit manual substantif oleh Tim Disdik Kota Batam.</p>
                </div>
                <!-- Step 5 -->
                <div class="relative z-10 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-300 text-gray-700 flex items-center justify-center text-sm font-bold mb-3">5</div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">SK Walikota</h4>
                    <p class="text-xs text-gray-500 leading-tight">Penerbitan SK elektronik penyaluran dana via Bank Riau Kepri Syariah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gray-50 mt-20 pb-20 pt-16 border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <span class="text-xs font-bold text-[#166534] tracking-wider uppercase">Pilihan Jalur Beasiswa</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">Kategori Bantuan Pendidikan Tinggi 2025</h2>
                <p class="text-gray-600 max-w-2xl">Pemerintah Kota Batam membuka tiga jalur seleksi terbuka untuk memastikan pemerataan akses perkuliahan bagi seluruh putra-putri daerah.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: SNBP -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                        </div>
                        <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2 py-1 rounded uppercase">PRESTASI</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Jalur SNBP</h3>
                    <p class="text-sm text-gray-500 mb-4 h-16">Dikhususkan bagi mahasiswa yang lulus dan diterima di PTN melalui jalur Seleksi Nasional Berdasarkan Prestasi (SNBP).</p>
                    
                    <div class="bg-gray-50 rounded-lg p-3 mb-6 border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Pagu Dukungan Finansial:</p>
                        <p class="font-bold text-gray-900">Rp 6.000.000 / Semester</p>
                    </div>

                    <ul class="text-sm text-gray-600 space-y-3 mb-8">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Lulus SNBP tahun berjalan dan terdaftar resmi di PTN</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Surat Keterangan Aktif Kuliah / Bukti Registrasi</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Tidak sedang menerima beasiswa instansi lain</span>
                        </li>
                    </ul>

                    <div class="flex justify-between items-center text-xs mb-4">
                        <span class="text-gray-500">Batas Akhir:</span>
                        <span class="font-bold text-gray-900">28 Februari 2025</span>
                    </div>
                    <a href="#" class="block w-full py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center rounded-lg font-semibold text-sm transition-colors">Pilih Jalur SNBP</a>
                </div>

                <!-- Card 2: SNBT -->
                <div class="bg-white rounded-2xl p-8 border-2 border-[#166534] shadow-md relative">
                    <div class="absolute top-0 right-0 left-0 bg-[#166534] text-white text-xs font-bold text-center py-1 rounded-t-xl -mt-0.5">TERBANYAK DIMINATI</div>
                    <div class="flex justify-between items-start mb-6 mt-4">
                        <div class="w-12 h-12 bg-green-50 text-[#166534] rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded uppercase">TES TERTULIS</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Jalur SNBT</h3>
                    <p class="text-sm text-gray-500 mb-4 h-16">Dikhususkan bagi mahasiswa yang lulus dan diterima di PTN melalui jalur Seleksi Nasional Berdasarkan Tes (SNBT).</p>
                    
                    <div class="bg-gray-50 rounded-lg p-3 mb-6 border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Pagu Dukungan Finansial:</p>
                        <p class="font-bold text-[#166534]">Rp 7.000.000 / Semester</p>
                    </div>

                    <ul class="text-sm text-gray-600 space-y-3 mb-8">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Lulus SNBT tahun berjalan dan melampirkan skor UTBK</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Terdaftar resmi sebagai mahasiswa aktif di PTN</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Tidak sedang menerima beasiswa KIP-Kuliah</span>
                        </li>
                    </ul>

                    <div class="flex justify-between items-center text-xs mb-4">
                        <span class="text-gray-500">Batas Akhir:</span>
                        <span class="font-bold text-gray-900">28 Februari 2025</span>
                    </div>
                    <a href="#" class="block w-full py-3 px-4 bg-[#166534] hover:bg-green-800 text-white text-center rounded-lg font-semibold text-sm transition-colors shadow-sm">Pilih Jalur SNBT</a>
                </div>

                <!-- Card 3: Hinterland -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2 py-1 rounded uppercase">Hinterland & Pesisir</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Jalur Khusus Hinterland</h3>
                    <p class="text-sm text-gray-500 mb-4 h-16">Afirmasi putra-putri kepulauan (Belakang Padang, Bulang, Galang, dan pulau penyangga Batam).</p>
                    
                    <div class="bg-gray-50 rounded-lg p-3 mb-6 border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Pagu Dukungan Finansial:</p>
                        <p class="font-bold text-gray-900">Rp 6.000.000 / Semester</p>
                    </div>

                    <ul class="text-sm text-gray-600 space-y-3 mb-8">
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>KTP & KK domisili tetap di kecamatan hinterland min. 5 th</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Lulusan SMA/SMK di wilayah pulau pesisir Batam</span>
                        </li>
                        <li class="flex gap-2">
                            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Terdaftar pada PTN/PTS dan tidak menerima beasiswa lain</span>
                        </li>
                    </ul>

                    <div class="flex justify-between items-center text-xs mb-4">
                        <span class="text-gray-500">Batas Akhir:</span>
                        <span class="font-bold text-gray-900">05 Maret 2025</span>
                    </div>
                    <a href="#" class="block w-full py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center rounded-lg font-semibold text-sm transition-colors">Pilih Jalur Hinterland</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 5 Tahap Alur Pelayanan -->
    <div class="bg-white border-y border-gray-200 mt-20 pt-16 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <span class="text-xs font-bold text-gray-500 tracking-wider uppercase">Tata Cara Pendaftaran</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">5 Tahap Alur Pelayanan Bantuan Pendidikan</h2>
                <div class="flex justify-between items-end">
                    <p class="text-gray-600 max-w-lg">Dari pendaftaran mandiri hingga dana masuk ke rekening aktif mahasiswa secara tepat sasaran.</p>
                    <span class="text-xs font-medium text-gray-500 hidden md:flex items-center gap-2"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Waktu penyelesaian standar: 7 - 10 hari kerja</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left: Timeline Steps -->
                <div class="space-y-4">
                    <!-- Step 1 (Active) -->
                    <div class="bg-gray-50 border-l-4 border-[#166534] rounded-r-xl p-5 shadow-sm flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-[#166534] text-white flex shrink-0 items-center justify-center text-sm font-bold shadow-sm mt-1">1</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Registrasi & Verifikasi NIK</h4>
                            <p class="text-xs text-gray-500 mt-1">Pencocokan data NIK Kependudukan Kota Batam.</p>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-start gap-4 hover:bg-gray-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex shrink-0 items-center justify-center text-sm font-bold mt-1">2</div>
                        <div>
                            <h4 class="font-bold text-gray-600">Unggah Dokumen Digital</h4>
                            <p class="text-xs text-gray-400 mt-1">KTP, KK, KHS & Rekening Bank.</p>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-start gap-4 hover:bg-gray-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex shrink-0 items-center justify-center text-sm font-bold mt-1">3</div>
                        <div>
                            <h4 class="font-bold text-gray-600">Pemeriksaan Sistem Terpadu</h4>
                            <p class="text-xs text-gray-400 mt-1">Validasi Data Otomatis & Sinkronisasi PDDIKTI.</p>
                        </div>
                    </div>
                    <!-- Step 4 -->
                    <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-start gap-4 hover:bg-gray-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex shrink-0 items-center justify-center text-sm font-bold mt-1">4</div>
                        <div>
                            <h4 class="font-bold text-gray-600">Pemeriksaan Verifikator Disdik</h4>
                            <p class="text-xs text-gray-400 mt-1">Pemberian rekomendasi oleh aparatur pemerintah.</p>
                        </div>
                    </div>
                    <!-- Step 5 -->
                    <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-start gap-4 hover:bg-gray-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex shrink-0 items-center justify-center text-sm font-bold mt-1">5</div>
                        <div>
                            <h4 class="font-bold text-gray-600">Penetapan SK Walikota & Penyaluran</h4>
                            <p class="text-xs text-gray-400 mt-1">Penerbitan SK elektronik & transfer rekening.</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Detailed Content for Step 1 -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-lg p-8 h-full">
                        <div class="flex justify-between items-center mb-6">
                            <span class="bg-[#166534] text-white text-xs font-bold px-3 py-1 rounded-md">Tahap Aktif: 1</span>
                            <span class="text-xs font-semibold text-green-600 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> Terhubung e-Kependudukan</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Registrasi Akun Menggunakan NIK e-KTP Batam</h3>
                        <p class="text-gray-600 mb-8 text-sm leading-relaxed">
                            Calon pendaftar memasukkan 16 digit Nomor Induk Kependudukan (NIK) dan Nomor Kartu Keluarga (KK). Mesin integrasi memvalidasi domisili aktif di 12 kecamatan Kota Batam dengan masa tinggal minimal 3 tahun berturut-turut.
                        </p>

                        <!-- Mockup Form inside Card -->
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 mb-8">
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-xs font-bold text-gray-500">SIMULASI INPUT NIK</label>
                                <span class="text-[10px] text-green-600 font-bold">Status: Data Valid (Read only)</span>
                            </div>
                            <div class="flex gap-2">
                                <input type="text" value="2171050809020004 - MUKTI HARKEL" disabled class="flex-1 bg-white border border-gray-300 text-gray-800 text-sm rounded-lg block p-2.5 focus:ring-green-500 focus:border-green-500 font-medium cursor-not-allowed">
                                <button type="button" disabled class="text-white bg-green-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-sm opacity-80 cursor-not-allowed">Batam Kota</button>
                            </div>
                            <p class="mt-2 text-xs text-green-600 font-medium flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Terverifikasi aktif berdomisili di Kelurahan Belian, Kec. Batam Kota.</p>
                        </div>

                        <div class="grid grid-cols-2 gap-6 text-sm text-gray-600">
                            <div>
                                <h5 class="font-bold text-gray-900 mb-2">Dokumen yang Perlu Disiapkan:</h5>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> e-KTP Asli / Suket Batam</li>
                                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Nomor WhatsApp Aktif</li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-900 mb-2 invisible">Dokumen yang Perlu Disiapkan:</h5>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Kartu Keluarga (KK) Resmi</li>
                                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Alamat Email Mahasiswa</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center text-sm">
                            <span class="text-gray-500">Butuh panduan lengkap format berkas?</span>
                            <a href="#" class="font-bold text-gray-900 hover:text-[#166534] flex items-center gap-1">Pusat Informasi & Bantuan <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fondasi Teknologi Terpercaya -->
    <div class="bg-[#F8F9FA] pt-20 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-xs font-bold text-[#166534] tracking-wider uppercase">Keamanan & Akuntabilitas</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">Fondasi Teknologi Terpercaya untuk Generasi Batam</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-16">Mengombinasikan ketelitian AI dalam pengolahan data dengan integritas aparatur negara sebagai pengambil keputusan akhir.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Transparansi & Akuntabilitas Publik</h3>
                    <p class="text-sm text-gray-500 mb-6 h-16">Setiap tahapan administrasi dicatat secara digital dan terbuka. Pemohon dapat memantau status secara langsung melalui portal.</p>
                    <div class="bg-gray-50 rounded p-2 text-xs font-medium text-gray-600 flex items-center gap-2 border border-gray-100">
                        <svg class="w-4 h-4 text-[#166534]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Riwayat Pemeriksaan Tercatat Resmi
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Validasi Data Terpusat</h3>
                    <p class="text-sm text-gray-500 mb-6 h-16">Sinkronisasi dokumen dengan basis data SIAK Kependudukan serta pangkalan data perguruan tinggi Kemendikbudristek.</p>
                    <div class="bg-gray-50 rounded p-2 text-xs font-medium text-gray-600 flex items-center gap-2 border border-gray-100">
                        <svg class="w-4 h-4 text-[#166534]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Sinkronisasi SIAK & PDDIKTI
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 text-gray-700 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Pengambilan Keputusan Bertingkat</h3>
                    <p class="text-sm text-gray-500 mb-6 h-16">Pemeriksaan substantif dan ketetapan penerima sepenuhnya ditelaah dan diputuskan oleh Tim Verifikator Dinas Pendidikan Kota Batam.</p>
                    <div class="bg-gray-50 rounded p-2 text-xs font-medium text-gray-600 flex items-center gap-2 border border-gray-100">
                        <svg class="w-4 h-4 text-[#166534]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Otoritas Resmi Aparatur Pemerintah
                    </div>
                </div>
            </div>
            
            <!-- Standard Audit Integritas Bar -->
            <div class="mt-12 bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col md:flex-row justify-between items-center text-left gap-6">
                <div class="w-full md:w-1/4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-1">Parameter Audit Berkas Terpadu</span>
                    <h4 class="font-bold text-gray-900">Standar Pengujian Integritas Dokumen Pemohon</h4>
                </div>
                <div class="w-full md:w-3/4 grid grid-cols-1 md:grid-cols-3 gap-4 border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6">
                    <div>
                        <p class="text-[10px] font-bold text-gray-500 uppercase">Data Kependudukan</p>
                        <p class="font-bold text-gray-900 flex items-center gap-1 mt-1"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> SIAK Terverifikasi</p>
                        <p class="text-xs text-gray-400 mt-0.5">Disdukcapil Kota Batam</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-500 uppercase">Data Akademik Mahasiswa</p>
                        <p class="font-bold text-gray-900 flex items-center gap-1 mt-1"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> PDDIKTI Sinkron</p>
                        <p class="text-xs text-gray-400 mt-0.5">Kementerian Pendidikan Tinggi</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-500 uppercase">Kelengkapan Berkas</p>
                        <p class="font-bold text-gray-900 flex items-center gap-1 mt-1"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Format Standar</p>
                        <p class="text-xs text-gray-400 mt-0.5">Sesuai Perwako No. 18/2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lacak Progres Section -->
    <div class="border-y border-gray-200 bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-50 rounded-3xl p-8 lg:p-12 border border-gray-100 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-1/2">
                    <span class="text-xs font-bold text-[#166534] tracking-wider uppercase">Cek Status Pengajuan</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">Lacak Progres Verifikasi Berkas Anda</h2>
                    <p class="text-gray-600 mb-8 text-sm">Masukkan 16 digit NIK atau Nomor Registrasi Berkas (Contoh: BTM-EDU-2025-0819) untuk memantau status secara langsung tanpa login akun.</p>
                    
                    <form class="flex flex-col sm:flex-row gap-3">
                        <input type="text" placeholder="Masukkan Nomor Registrasi / NIK..." class="flex-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#166534] focus:border-[#166534] block w-full p-4 shadow-sm" required>
                        <button type="submit" class="text-white bg-[#166534] hover:bg-green-800 font-bold rounded-lg text-sm px-8 py-4 text-center transition-colors shadow-sm whitespace-nowrap">Lacak Berkas</button>
                    </form>
                </div>
                
                <!-- Info Box -->
                <div class="lg:w-1/3 w-full">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-5">
                            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Posko Layanan Bantuan
                        </h4>
                        <p class="text-xs text-gray-600 mb-4">Ada kendala dalam pendaftaran atau nomor registrasi tidak ditemukan?</p>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-[10px] font-bold text-gray-500 uppercase">Dinas Pendidikan Kota Batam</p>
                                <p class="text-xs text-gray-900 mt-0.5">Gedung Bersama Lt. 4, Engku Putri No. 1, Batam Centre.</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-500 uppercase">Hotline WhatsApp (Chat Only)</p>
                                <p class="text-xs font-bold text-green-700 mt-0.5">+62 811-7700-0025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Final Scripts / Footer placeholder for now, just to close HTML properly -->
    <footer class="bg-white pt-10 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
             <div class="flex items-center gap-3">
                  <img class="h-8 md:h-10 w-auto" src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo Footer">
                  <p class="text-xs text-gray-500">&copy; 2025 Dinas Pendidikan Kota Batam. Hak Cipta Dilindungi.</p>
             </div>
             <div class="flex gap-4 text-xs text-gray-500 font-medium">
                  <a href="#" class="hover:text-gray-900">Kebijakan Privasi</a>
                  <a href="#" class="hover:text-gray-900">Standar Audit AI</a>
                  <a href="#" class="hover:text-gray-900">Kontak Darurat</a>
             </div>
        </div>
    </footer>
</body>
</html>
