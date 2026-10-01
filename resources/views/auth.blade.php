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
    </style>
</head>
<body class="antialiased bg-white text-gray-800 h-screen w-full selection:bg-gray-200">

    <div class="relative w-full h-screen overflow-hidden flex flex-col lg:flex-row" id="main-container">
        
        <!-- ================= REGISTER FORM (LEFT) ================= -->
        <div class="w-full lg:w-1/2 h-full flex flex-col justify-center px-8 sm:px-16 md:px-24 xl:px-32 relative transition-opacity duration-500 z-10 bg-white" id="register-container" style="display: {{ $mode === 'register' ? 'flex' : 'none' }};">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-8 flex justify-center mt-10">
                <img src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo" class="h-10 w-auto">
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Buat Akun Anda</h2>
                <p class="text-gray-500 mt-2 text-sm">Isi data di bawah ini untuk mendaftar ke portal beasiswa.</p>
            </div>

            <form action="#" method="POST" class="space-y-5">
                <!-- NIK -->
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Induk Kependudukan</label>
                    <div class="relative">
                        <input type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none" placeholder="Masukkan 16 digit NIK" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input type="password" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none" placeholder="Ketik ulang sandi" required>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-[#166534] text-white text-sm font-bold rounded-xl hover:bg-green-800 transition-colors shadow-lg shadow-[#166534]/20">
                    Daftar Akun Sekarang
                </button>
            </form>

            <div class="mt-8 text-center lg:hidden">
                <p class="text-sm text-gray-500">Sudah memiliki akun? <a href="#" onclick="toggleMode('login'); return false;" class="font-bold text-black hover:underline">Masuk di sini</a></p>
                <a href="{{ url('/') }}" class="mt-6 text-xs text-gray-400 hover:text-black inline-block">Kembali ke Beranda</a>
            </div>
        </div>

        <!-- ================= LOGIN FORM (RIGHT) ================= -->
        <div class="w-full lg:w-1/2 h-full flex flex-col justify-center px-8 sm:px-16 md:px-24 xl:px-32 relative transition-opacity duration-500 z-10 bg-white" id="login-container" style="display: {{ $mode === 'login' ? 'flex' : 'none' }};">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-8 flex justify-center mt-10">
                <img src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo" class="h-10 w-auto">
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang</h2>
                <p class="text-gray-500 mt-2 text-sm">Masuk ke sistem beasiswa terpadu.</p>
            </div>

            <form action="#" method="POST" class="space-y-6">
                <!-- NIK -->
                <div class="input-animated group">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Induk Kependudukan</label>
                    <div class="relative">
                        <input type="text" class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none" placeholder="Masukkan 16 digit NIK" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-animated group">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                        <a href="#" class="text-xs text-black font-semibold hover:underline">Lupa sandi?</a>
                    </div>
                    <div class="relative">
                        <input type="password" class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:bg-white focus:ring-2 focus:ring-[#166534] focus:border-[#166534] transition-all outline-none" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember" type="checkbox" class="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-black" checked>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-700">Ingat perangkat ini</label>
                </div>

                <button type="submit" class="w-full py-4 px-4 bg-[#166534] text-white text-sm font-bold rounded-xl hover:bg-green-800 transition-colors shadow-lg shadow-[#166534]/20">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-8 text-center lg:hidden">
                <p class="text-sm text-gray-500">Belum memiliki akun? <a href="#" onclick="toggleMode('register'); return false;" class="font-bold text-black hover:underline">Daftar sekarang</a></p>
                <a href="{{ url('/') }}" class="mt-6 text-xs text-gray-400 hover:text-black inline-block pb-10">Kembali ke Beranda</a>
            </div>
        </div>

        <!-- ================= OVERLAY PANEL (SLIDES LEFT/RIGHT) ================= -->
        <div id="overlay-panel" class="hidden lg:block absolute top-0 left-0 w-1/2 h-full bg-black text-white z-50 transition-transform duration-[800ms] ease-[cubic-bezier(0.77,0,0.175,1)] {{ $mode === 'register' ? 'translate-x-full' : 'translate-x-0' }}">
            
            <a href="{{ url('/') }}" class="absolute top-8 left-12 text-white/60 hover:text-white text-sm font-medium flex items-center gap-2 z-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            <!-- Content for Login Mode (Shown when Overlay is on the Left) -->
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

            <!-- Content for Register Mode (Shown when Overlay is on the Right) -->
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
        // Ensure both containers are visible on desktop for sliding layout
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
                // On mobile, show only the active one
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
