<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - BATAM EDU-GOV AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .input-animated { transition: all 0.3s ease; }
        .input-animated:focus-within { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01); }
        .blob {
            position: absolute; filter: blur(60px); z-index: 0; opacity: 0.6; animation: float 10s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 min-h-screen flex selection:bg-green-200">

    <div class="flex w-full min-h-screen">
        
        <!-- Left Side: Branding & Visuals (Hidden on small screens) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#0B1120] overflow-hidden flex-col justify-between p-12">
            <!-- Animated Blobs for background -->
            <div class="blob bg-green-500 w-96 h-96 rounded-full top-[-10%] left-[-10%]"></div>
            <div class="blob bg-emerald-800 w-80 h-80 rounded-full bottom-[10%] right-[-10%]" style="animation-delay: 2s;"></div>
            <div class="blob bg-blue-900 w-64 h-64 rounded-full top-[40%] left-[20%]" style="animation-delay: 4s;"></div>

            <!-- Content -->
            <div class="relative z-10">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-white/70 hover:text-white transition-colors text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="relative z-10 max-w-md">
                <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo" class="h-16 w-auto mb-8 drop-shadow-2xl">
                <h1 class="text-4xl font-bold text-white mb-4 leading-tight">
                    Langkah Awal Menuju <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">Masa Depan</span>.
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Daftar sekarang untuk mengakses layanan beasiswa terpadu dengan verifikasi AI real-time, transparan, dan efisien.
                </p>
            </div>

            <div class="relative z-10 glass-panel rounded-2xl p-6">
                <div class="flex items-center gap-4">
                    <div class="bg-green-500/20 p-3 rounded-full border border-green-500/30">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold text-sm">Privasi & Keamanan Data</h4>
                        <p class="text-gray-400 text-xs mt-1">Data Anda dienkripsi penuh dengan protokol AES-256.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 md:px-24 xl:px-32 bg-white relative py-12">
            
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-12 flex justify-center">
                <img src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo" class="h-12 w-auto">
            </div>

            <!-- Header -->
            <div class="mb-10">
                <div class="inline-flex items-center gap-2 bg-green-50 px-3 py-1 rounded-full border border-green-100 mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-green-700 tracking-wider uppercase">Pendaftaran Akun Baru</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Buat Akun Anda</h2>
                <p class="text-gray-500 mt-2 text-sm">Isi data di bawah ini untuk mendaftar ke portal beasiswa.</p>
            </div>

            <!-- Form -->
            <form action="#" method="POST" class="space-y-6">
                <!-- NIK -->
                <div class="input-animated group">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Nomor Induk Kependudukan (NIK)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#166534] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <input type="text" class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534]/20 focus:border-[#166534] transition-all outline-none" placeholder="Masukkan 16 digit NIK" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-animated group">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#166534] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" class="w-full pl-12 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534]/20 focus:border-[#166534] transition-all outline-none" placeholder="Minimal 8 karakter" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="input-animated group">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#166534] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" class="w-full pl-12 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534]/20 focus:border-[#166534] transition-all outline-none" placeholder="Ketik ulang sandi Anda" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" type="checkbox" class="w-4 h-4 text-[#166534] bg-gray-100 border-gray-300 rounded focus:ring-[#166534]" required>
                    </div>
                    <label for="terms" class="ml-2 text-xs font-medium text-gray-500 leading-relaxed">
                        Saya menyetujui <a href="#" class="text-[#166534] hover:underline font-bold">Syarat Ketentuan</a> & <a href="#" class="text-[#166534] hover:underline font-bold">Kebijakan Privasi</a> Platform Beasiswa.
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-[#166534] hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#166534] transition-all overflow-hidden shadow-lg shadow-green-900/20">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span class="relative flex items-center gap-2">
                        Daftar Akun Sekarang
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-100 flex flex-col items-center">
                <p class="text-sm text-gray-500">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="font-semibold text-[#166534] hover:text-green-800 transition-colors">Masuk di sini</a>
                </p>
                <a href="{{ url('/') }}" class="mt-6 lg:hidden text-xs text-gray-400 hover:text-gray-600 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</body>
</html>
