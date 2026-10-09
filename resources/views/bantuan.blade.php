<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan & Kontak - BATAM EDU-GOV AI</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased selection:bg-green-200">

    <!-- Navigation -->
    <nav class="bg-black border-b border-gray-900 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Left Logo -->
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center hover:opacity-90 transition-opacity">
                    <img class="h-12 md:h-14 w-auto object-contain" src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo">
                </a>
                <!-- Nav Links -->
                <div class="hidden md:flex space-x-2 items-center bg-neutral-900 p-1 rounded-full border border-neutral-800">
                    <a href="{{ url('/') }}" class="text-gray-300 hover:text-white px-5 py-2 rounded-full text-sm font-medium transition-colors">Beranda/Publik</a>
                    <a href="{{ url('/#section-alur') }}" class="text-gray-300 hover:text-white px-5 py-2 rounded-full text-sm font-medium transition-colors">Alur & Persyaratan</a>
                    <a href="{{ url('/#section-lacak') }}" class="text-gray-300 hover:text-white px-5 py-2 rounded-full text-sm font-medium transition-colors">Lacak Berkas</a>
                    <a href="{{ route('bantuan') }}" class="bg-[#166534] text-white px-5 py-2 rounded-full text-sm font-semibold shadow-sm">Pusat Bantuan</a>
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

    <!-- Header Section -->
    <div class="bg-gradient-to-b from-neutral-900 to-black text-white py-16 px-4 sm:px-6 lg:px-8 border-b border-neutral-800">
        <div class="max-w-5xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-600/30 text-emerald-300 text-xs font-semibold mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Pusat Pelayanan & Pengaduan Resmi Pemko Batam
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">
                Pusat Bantuan & Layanan Informasi
            </h1>
            <p class="text-gray-400 text-base sm:text-lg max-w-2xl mx-auto mb-8">
                Butuh bantuan seputar pendaftaran, verifikasi berkas, atau kendala teknis sistem? Tim Dinas Pendidikan Kota Batam siap membantu Anda.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 text-sm">
                <a href="#kontak" class="bg-[#166534] hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl transition-all shadow-lg hover:shadow-emerald-900/30">
                    Hubungi Kami
                </a>
                <a href="#faq" class="bg-neutral-800 hover:bg-neutral-700 text-gray-200 font-semibold px-6 py-2.5 rounded-xl border border-neutral-700 transition-all">
                    Lihat FAQ (Tanya Jawab)
                </a>
                <a href="#tiket" class="bg-white text-black hover:bg-gray-100 font-semibold px-6 py-2.5 rounded-xl transition-all shadow-sm">
                    Kirim Pesan / Tiket
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">

        <!-- Kontak Langsung Section -->
        <div id="kontak" class="scroll-mt-24">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-[#166534] tracking-wider uppercase">Saluran Komunikasi Resmi</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1 mb-3">Kontak & Posko Pelayanan</h2>
                <p class="text-gray-600 text-sm">Pilih saluran yang paling nyaman untuk Anda. Layanan beroperasi sesuai jam kerja dinas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- WhatsApp Hotline -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-6 group-hover:scale-105 transition-transform">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.353.101.173.449.742.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.043.101-.116.433-.506.549-.679.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.044.072.044.419-.1 1.025zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.662 1.435 5.178L2 22l4.957-1.399C8.38 21.498 10.134 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-green-700 bg-green-100 px-2.5 py-1 rounded-full uppercase">Fast Response</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">WhatsApp Hotline</h3>
                    <p class="text-xs text-gray-500 mb-4">Layanan interaktif chat kendala berkas & konfirmasi status pendaftaran.</p>
                    <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 mb-6">
                        <p class="text-xs text-gray-400">Nomor WhatsApp Resmi:</p>
                        <p class="text-base font-extrabold text-gray-900 mt-0.5">+62 811-7700-0025</p>
                        <p class="text-[11px] text-green-600 mt-1">● Chat Only (Senin-Jumat 08.00-16.00 WIB)</p>
                    </div>
                    <a href="https://wa.me/6281177000025?text=Halo%20Admin%20Batam%20Edu-Gov%20AI,%20saya%20ingin%20bertanya%20terkait%20bantuan%20pendidikan." target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center gap-2 bg-[#166534] hover:bg-green-800 text-white font-semibold py-3 px-4 rounded-xl text-sm transition-colors shadow-sm">
                        <span>Kirim Pesan WhatsApp</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Email Resmi -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6 group-hover:scale-105 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-blue-700 bg-blue-100 px-2.5 py-1 rounded-full uppercase">Surat Resmi</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">Email Disdik Batam</h3>
                    <p class="text-xs text-gray-500 mb-4">Pengiriman aduan formal, perbaikan data administrasi, dan dokumen revisi.</p>
                    <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 mb-6 space-y-1.5">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase">Layanan Beasiswa:</p>
                            <p class="text-sm font-bold text-gray-900">bantuan@disdik.batam.go.id</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase">Dukungan Teknis AI:</p>
                            <p class="text-sm font-bold text-gray-900">edugov@batam.go.id</p>
                        </div>
                    </div>
                    <a href="mailto:bantuan@disdik.batam.go.id?subject=Pertanyaan%20Beasiswa%20Batam%20Edu-Gov" class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white font-semibold py-3 px-4 rounded-xl text-sm transition-colors shadow-sm">
                        <span>Kirim Surel Email</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Posko Layanan Fisik -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-6 group-hover:scale-105 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-amber-800 bg-amber-100 px-2.5 py-1 rounded-full uppercase">Tatap Muka</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-3 mb-2">Posko Layanan Fisik</h3>
                    <p class="text-xs text-gray-500 mb-4">Konsultasi tatap muka dan verifikasi berkas langsung dengan petugas.</p>
                    <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 mb-6">
                        <p class="text-[10px] text-gray-400 uppercase">Alamat Kantor:</p>
                        <p class="text-xs font-bold text-gray-900 mt-0.5 leading-snug">
                            Gedung Bersama Pemko Batam Lt. 4, Jl. Engku Putri No. 1, Batam Centre, Kota Batam
                        </p>
                        <p class="text-[11px] text-gray-600 mt-2">
                            ⏰ Senin – Jumat : 08:00 – 16:00 WIB<br>
                            (Istirahat 12.00 - 13.00 WIB)
                        </p>
                    </div>
                    <a href="https://maps.google.com/?q=Dinas+Pendidikan+Kota+Batam+Engku+Putri" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-xl text-sm transition-colors shadow-sm">
                        <span>Petunjuk Arah Google Maps</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div id="faq" class="scroll-mt-24 pt-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-[#166534] tracking-wider uppercase">Pertanyaan Sering Diajukan</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-1 mb-3">FAQ Seputar Bantuan Pendidikan</h2>
                <p class="text-gray-600 text-sm">Temukan jawaban cepat atas pertanyaan-pertanyaan umum seputar program beasiswa Batam 2025.</p>
            </div>

            <div class="max-w-4xl mx-auto space-y-4" id="faq-accordion">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                    <button type="button" class="faq-btn w-full px-6 py-5 text-left font-bold text-gray-900 flex justify-between items-center hover:bg-gray-50 focus:outline-none" onclick="toggleFaq(1)">
                        <span class="text-base">1. Siapa saja yang berhak mendaftar beasiswa Pemerintah Kota Batam 2025?</span>
                        <svg id="faq-icon-1" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"></path></svg>
                    </button>
                    <div id="faq-content-1" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                        Seluruh mahasiswa jenjang Diploma (D3/D4) dan Sarjana (S1) yang memiliki Nomor Induk Kependudukan (NIK) serta Kartu Keluarga (KK) Kota Batam dengan masa domisili minimal 3 tahun berturut-turut, sedang berkuliah aktif di Perguruan Tinggi Negeri (PTN) atau PTS terakreditasi, dan tidak sedang menerima bantuan beasiswa biaya hidup dari sumber APBN/APBD lainnya.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                    <button type="button" class="faq-btn w-full px-6 py-5 text-left font-bold text-gray-900 flex justify-between items-center hover:bg-gray-50 focus:outline-none" onclick="toggleFaq(2)">
                        <span class="text-base">2. Dokumen apa saja yang wajib disiapkan sebelum mendaftar di portal?</span>
                        <svg id="faq-icon-2" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"></path></svg>
                    </button>
                    <div id="faq-content-2" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                        Dokumen yang harus disiapkan dalam format digital (PDF/JPG maksimal 2 MB):
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>Scan e-KTP Kota Batam asli atau Surat Keterangan domisili resmi.</li>
                            <li>Scan Kartu Keluarga (KK) Kota Batam terbaru.</li>
                            <li>Surat Keterangan Aktif Kuliah dari Dekan/Rektorat semester berjalan.</li>
                            <li>Transkrip Nilai/KHS (atau sertifikat skor UTBK/SNBP bagi mahasiswa baru).</li>
                            <li>Buku Tabungan Bank Riau Kepri Syariah atas nama mahasiswa bersangkutan.</li>
                            <li>Surat Pernyataan Bebas Beasiswa Lain bermaterai Rp 10.000.</li>
                        </ul>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                    <button type="button" class="faq-btn w-full px-6 py-5 text-left font-bold text-gray-900 flex justify-between items-center hover:bg-gray-50 focus:outline-none" onclick="toggleFaq(3)">
                        <span class="text-base">3. Mengapa NIK saya muncul keterangan tidak valid atau tidak ditemukan?</span>
                        <svg id="faq-icon-3" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"></path></svg>
                    </button>
                    <div id="faq-content-3" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                        Hal ini biasanya terjadi karena:
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>Data KTP belum tercatat mutasi ke Kota Batam (kode wilayah KTP bukan 2171).</li>
                            <li>Masa domisili di sistem SIAK Disdukcapil belum genap memenuhi ketentuan minimal 3 tahun.</li>
                            <li>Adanya pembaruan data e-KTP yang belum sinkron dengan database pusat.</li>
                        </ul>
                        Jika Anda yakin data sudah benar, silakan hubungi hotline WhatsApp kami dengan menyertakan foto e-KTP dan KK untuk verifikasi manual oleh petugas.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                    <button type="button" class="faq-btn w-full px-6 py-5 text-left font-bold text-gray-900 flex justify-between items-center hover:bg-gray-50 focus:outline-none" onclick="toggleFaq(4)">
                        <span class="text-base">4. Berapa nominal besaran bantuan yang disalurkan?</span>
                        <svg id="faq-icon-4" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"></path></svg>
                    </button>
                    <div id="faq-content-4" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                        Besaran pagu dana bantuan pendidikan berdasarkan Peraturan Walikota Batam:
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li><strong>Jalur SNBP:</strong> Rp 6.000.000 per semester.</li>
                            <li><strong>Jalur SNBT (Tes Tertulis):</strong> Rp 7.000.000 per semester.</li>
                            <li><strong>Jalur Afirmasi Hinterland & Pesisir:</strong> Rp 6.000.000 per semester.</li>
                        </ul>
                        Dana langsung dikirim ke rekening Bank Riau Kepri Syariah penerima tanpa potongan biaya perantara apapun.
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-all">
                    <button type="button" class="faq-btn w-full px-6 py-5 text-left font-bold text-gray-900 flex justify-between items-center hover:bg-gray-50 focus:outline-none" onclick="toggleFaq(5)">
                        <span class="text-base">5. Bagaimana cara melacak progres verifikasi berkas saya?</span>
                        <svg id="faq-icon-5" class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7"></path></svg>
                    </button>
                    <div id="faq-content-5" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                        Anda dapat memeriksa progres berkas secara real-time melalui halaman utama di bagian <strong>Lacak Progres</strong>. Cukup masukkan 16 digit NIK Anda atau Nomor Registrasi Berkas (misal: <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-800">BTM-EDU-2025-0819</code>) tanpa harus masuk atau login ke akun.
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Kirim Tiket Pengaduan / Pertanyaan -->
        <div id="tiket" class="scroll-mt-24 pt-8">
            <div class="bg-white rounded-3xl border border-gray-200 p-8 sm:p-12 shadow-lg max-w-4xl mx-auto">
                <div class="max-w-xl mx-auto text-center mb-8">
                    <span class="text-xs font-bold text-[#166534] tracking-wider uppercase">Layanan Tiket Pengaduan</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-1 mb-2">Kirim Pertanyaan / Pengaduan Kendala</h2>
                    <p class="text-xs sm:text-sm text-gray-500">Isi formulir di bawah ini. Tim teknis dan helpdesk kami akan membalas melalui email atau WhatsApp dalam 1x24 jam kerja.</p>
                </div>

                <form id="help-ticket-form" onsubmit="handleTicketSubmit(event)" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nama Lengkap Pemohon</label>
                            <input type="text" id="ticket-name" required placeholder="Contoh: Mukti Harkel" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">NIK e-KTP Batam (16 Digit)</label>
                            <input type="text" id="ticket-nik" required maxlength="16" placeholder="Contoh: 2171050809020004" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nomor WhatsApp Aktif</label>
                            <input type="tel" id="ticket-wa" required placeholder="Contoh: 081234567890" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Alamat Email Aktif</label>
                            <input type="email" id="ticket-email" required placeholder="Contoh: mukti@example.com" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Kategori Kendala</label>
                            <select id="ticket-category" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                                <option value="Validasi NIK / SIAK">Kendala Validasi NIK / Domisili</option>
                                <option value="Unggah Dokumen">Gagal Unggah Dokumen / Format Berkas</option>
                                <option value="Sinkronisasi PDDIKTI">Data PDDIKTI Kampus Tidak Cocok</option>
                                <option value="Status Verifikasi">Pertanyaan Progres Verifikasi Berkas</option>
                                <option value="Rekening Bank">Kendala Rekening Bank Riau Kepri Syariah</option>
                                <option value="Lainnya">Pertanyaan Umum Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nomor Registrasi (Opsional)</label>
                            <input type="text" id="ticket-reg" placeholder="Contoh: BTM-EDU-2025-0819" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Rincian Pertanyaan / Kendala</label>
                        <textarea id="ticket-message" required rows="4" placeholder="Jelaskan secara rinci kendala yang Anda alami saat proses pendaftaran beasiswa..." class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#166534] focus:border-[#166534] focus:bg-white outline-none transition-all"></textarea>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <p class="text-xs text-gray-500">Layanan ini gratis & diawasi langsung oleh Disdik Kota Batam.</p>
                        <button type="submit" class="bg-[#166534] hover:bg-green-800 text-white font-bold py-3 px-8 rounded-xl text-sm transition-all shadow-md hover:shadow-lg">
                            Kirim Tiket Aduan
                        </button>
                    </div>
                </form>

                <!-- Feedback Modal / Success Card (Initially Hidden) -->
                <div id="ticket-success" class="hidden mt-8 p-6 bg-emerald-50 border border-emerald-200 rounded-2xl text-center">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-emerald-900 mb-1">Tiket Aduan Berhasil Terkirim!</h3>
                    <p class="text-sm text-emerald-800 mb-3">Nomor Tiket Anda: <span id="ticket-generated-id" class="font-mono font-bold bg-white px-2.5 py-1 rounded border border-emerald-300 text-emerald-900">TKT-BTM-8942</span></p>
                    <p class="text-xs text-emerald-700 max-w-md mx-auto">Pemberitahuan balasan telah dijadwalkan ke email & WhatsApp Anda. Harap simpan nomor tiket ini untuk pengecekan berkala.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 pt-10 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
             <div class="flex items-center gap-3">
                  <a href="{{ url('/') }}">
                      <img class="h-8 md:h-10 w-auto" src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo Footer">
                  </a>
                  <p class="text-xs text-gray-500">&copy; 2025 Dinas Pendidikan Kota Batam. Hak Cipta Dilindungi.</p>
             </div>
             <div class="flex gap-4 text-xs text-gray-500 font-medium">
                  <a href="{{ url('/') }}" class="hover:text-gray-900">Kembali ke Beranda</a>
                  <a href="{{ url('/#section-alur') }}" class="hover:text-gray-900">Alur & Persyaratan</a>
                  <a href="{{ url('/#section-lacak') }}" class="hover:text-gray-900">Lacak Berkas</a>
                  <a href="{{ route('bantuan') }}" class="hover:text-gray-900 font-bold text-[#166534]">Pusat Bantuan</a>
             </div>
        </div>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        function toggleFaq(index) {
            const content = document.getElementById(`faq-content-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        function handleTicketSubmit(event) {
            event.preventDefault();
            const randomCode = Math.floor(1000 + Math.random() * 9000);
            const ticketId = `TKT-BTM-${randomCode}`;
            document.getElementById('ticket-generated-id').innerText = ticketId;
            document.getElementById('ticket-success').classList.remove('hidden');
            document.getElementById('help-ticket-form').reset();
            document.getElementById('ticket-success').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>
