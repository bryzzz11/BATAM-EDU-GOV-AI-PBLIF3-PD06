<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun - BATAM EDU-GOV AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .input-animated { transition: all 0.3s ease; }
        .input-animated:focus-within { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); }

        .fade-out { opacity: 0; pointer-events: none; transform: translateY(10px); }
        .fade-in { opacity: 1; pointer-events: auto; transform: translateY(0); transition-delay: 0.3s; }
        .overlay-content { transition: all 0.5s ease-in-out; position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; padding: 4rem; }

        .google-btn {
            transition: all 0.2s ease;
            border: 1.5px solid #e5e7eb;
        }
        .google-btn:hover {
            background-color: #f9fafb;
            border-color: #d1d5db;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .google-btn:active { transform: translateY(0); }

        .divider-text {
            position: relative;
            text-align: center;
        }
        .divider-text::before, .divider-text::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 42%;
            height: 1px;
            background: #e5e7eb;
        }
        .divider-text::before { left: 0; }
        .divider-text::after { right: 0; }
    </style>
</head>
<body class="antialiased bg-white text-gray-800 h-screen w-full selection:bg-gray-200">

    <div class="relative w-full h-screen overflow-hidden flex flex-col lg:flex-row" id="main-container">

        {{-- ================= REGISTER FORM (LEFT) ================= --}}
        <div class="w-full lg:w-1/2 h-full flex flex-col justify-center px-8 sm:px-16 md:px-24 xl:px-32 relative transition-opacity duration-500 z-10 bg-white overflow-y-auto" id="register-container" style="display: {{ $mode === 'register' ? 'flex' : 'none' }};">
            {{-- Mobile Logo --}}
            <div class="lg:hidden mb-6 flex justify-center mt-10">
                <img src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo" class="h-10 w-auto">
            </div>

            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Buat Akun Anda</h2>
                <p class="text-gray-500 mt-2 text-sm">Isi data di bawah ini untuk mendaftar ke portal beasiswa.</p>
            </div>

            {{-- Error Messages --}}
            @if ($errors->any() && $mode === 'register')
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Google OAuth Button --}}
            <a href="{{ route('auth.google') }}" class="google-btn w-full flex items-center justify-center gap-3 py-3 px-4 bg-white rounded-xl text-sm font-semibold text-gray-700 mb-5">
                <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Daftar dengan Google
            </a>

            {{-- Divider --}}
            <div class="divider-text mb-5">
                <span class="text-xs text-gray-400 font-medium px-3 bg-white relative z-10">atau daftar dengan email</span>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                {{-- Email --}}
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none"
                        placeholder="contoh@email.com" required>
                </div>

                {{-- Password --}}
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none"
                        placeholder="Minimal 8 karakter" required>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none"
                        placeholder="Ketik ulang sandi" required>
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-[#166534] text-white text-sm font-bold rounded-xl hover:bg-green-800 transition-colors shadow-lg shadow-[#166534]/20">
                    Daftar Akun Sekarang
                </button>
            </form>

            <div class="mt-6 text-center lg:hidden pb-10">
                <p class="text-sm text-gray-500">Sudah memiliki akun? <a href="#" onclick="toggleMode('login'); return false;" class="font-bold text-black hover:underline">Masuk di sini</a></p>
                <a href="{{ url('/') }}" class="mt-4 text-xs text-gray-400 hover:text-black inline-block">Kembali ke Beranda</a>
            </div>
        </div>

        {{-- ================= LOGIN FORM (RIGHT) ================= --}}
        <div class="w-full lg:w-1/2 h-full flex flex-col justify-center px-8 sm:px-16 md:px-24 xl:px-32 relative transition-opacity duration-500 z-10 bg-white overflow-y-auto" id="login-container" style="display: {{ $mode === 'login' ? 'flex' : 'none' }};">
            {{-- Mobile Logo --}}
            <div class="lg:hidden mb-6 flex justify-center mt-10">
                <img src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo" class="h-10 w-auto">
            </div>

            <div class="mb-6">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang</h2>
                <p class="text-gray-500 mt-2 text-sm">Masuk ke sistem beasiswa terpadu.</p>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any() && $mode === 'login')
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Google OAuth Button --}}
            <a href="{{ route('auth.google') }}" class="google-btn w-full flex items-center justify-center gap-3 py-3 px-4 bg-white rounded-xl text-sm font-semibold text-gray-700 mb-5">
                <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Masuk dengan Google
            </a>

            {{-- Divider --}}
            <div class="divider-text mb-5">
                <span class="text-xs text-gray-400 font-medium px-3 bg-white relative z-10">atau masuk dengan email</span>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none"
                        placeholder="contoh@email.com" required autocomplete="email">
                </div>

                {{-- Password --}}
                <div class="input-animated group">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                        <a href="#" class="text-xs text-black font-semibold hover:underline">Lupa sandi?</a>
                    </div>
                    <input type="password" name="password"
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none"
                        placeholder="••••••••" required autocomplete="current-password">
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-black" checked>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-700">Ingat perangkat ini</label>
                </div>

                <button type="submit" class="w-full py-4 px-4 bg-[#166534] text-white text-sm font-bold rounded-xl hover:bg-green-800 transition-colors shadow-lg shadow-[#166534]/20">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-6 text-center lg:hidden pb-10">
                <p class="text-sm text-gray-500">Belum memiliki akun? <a href="#" onclick="toggleMode('register'); return false;" class="font-bold text-black hover:underline">Daftar sekarang</a></p>
                <a href="{{ url('/') }}" class="mt-4 text-xs text-gray-400 hover:text-black inline-block">Kembali ke Beranda</a>
            </div>
        </div>

        {{-- ================= OVERLAY PANEL (SLIDES LEFT/RIGHT) ================= --}}
        <div id="overlay-panel" class="hidden lg:block absolute top-0 left-0 w-1/2 h-full bg-black text-white z-50 transition-transform duration-[800ms] ease-[cubic-bezier(0.77,0,0.175,1)] {{ $mode === 'register' ? 'translate-x-full' : 'translate-x-0' }}">

            <a href="{{ url('/') }}" class="absolute top-8 left-12 text-white/60 hover:text-white text-sm font-medium flex items-center gap-2 z-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            {{-- Content for Login Mode --}}
            <div id="overlay-login" class="overlay-content {{ $mode === 'login' ? 'fade-in' : 'fade-out' }}">
                <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo" class="h-12 md:h-14 w-auto object-contain object-left mb-10">
                <h1 class="text-4xl font-bold mb-4 leading-tight">Baru di sini?</h1>
                <p class="text-gray-400 text-base mb-10 leading-relaxed max-w-sm">
                    Daftarkan diri Anda sekarang dan nikmati kemudahan mengurus beasiswa Batam secara digital dan terpadu.
                </p>
                <button onclick="toggleMode('register')" class="px-8 py-3.5 rounded-full bg-white text-black font-bold hover:bg-gray-200 hover:scale-105 transition-all w-max active:scale-95">
                    Buat Akun Baru
                </button>
            </div>

            {{-- Content for Register Mode --}}
            <div id="overlay-register" class="overlay-content {{ $mode === 'register' ? 'fade-in' : 'fade-out' }}">
                <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo" class="h-12 md:h-14 w-auto object-contain object-left mb-10">
                <h1 class="text-4xl font-bold mb-4 leading-tight">Sudah Punya Akun?</h1>
                <p class="text-gray-400 text-base mb-10 leading-relaxed max-w-sm">
                    Silakan masuk dengan akun yang sudah terdaftar untuk melanjutkan proses pengajuan beasiswa Anda.
                </p>
                <button onclick="toggleMode('login')" class="px-8 py-3.5 rounded-full bg-white text-black font-bold hover:bg-gray-200 hover:scale-105 transition-all w-max active:scale-95">
                    Masuk Sekarang
                </button>
            </div>

        </div>
    </div>

    <script>
        function setDesktopLayout() {
            if (window.innerWidth >= 1024) {
                document.getElementById('register-container').style.display = 'flex';
                document.getElementById('login-container').style.display = 'flex';
            }
        }

        window.addEventListener('load', setDesktopLayout);

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                setDesktopLayout();
            } else {
                const isLogin = !document.getElementById('overlay-panel').classList.contains('translate-x-full');
                document.getElementById('login-container').style.display = isLogin ? 'flex' : 'none';
                document.getElementById('register-container').style.display = isLogin ? 'none' : 'flex';
            }
        });

        function toggleMode(targetMode) {
            const overlay = document.getElementById('overlay-panel');
            const loginContent = document.getElementById('overlay-login');
            const registerContent = document.getElementById('overlay-register');
            const isDesktop = window.innerWidth >= 1024;

            if (targetMode === 'register') {
                if (isDesktop) {
                    overlay.classList.add('translate-x-full');
                    loginContent.classList.replace('fade-in', 'fade-out');
                    registerContent.classList.replace('fade-out', 'fade-in');
                    window.history.pushState({}, '', '/register');
                } else {
                    document.getElementById('login-container').style.display = 'none';
                    document.getElementById('register-container').style.display = 'flex';
                    window.history.pushState({}, '', '/register');
                }
            } else {
                if (isDesktop) {
                    overlay.classList.remove('translate-x-full');
                    registerContent.classList.replace('fade-in', 'fade-out');
                    loginContent.classList.replace('fade-out', 'fade-in');
                    window.history.pushState({}, '', '/login');
                } else {
                    document.getElementById('register-container').style.display = 'none';
                    document.getElementById('login-container').style.display = 'flex';
                    window.history.pushState({}, '', '/login');
                }
            }
        }
    </script>
</body>
</html>
