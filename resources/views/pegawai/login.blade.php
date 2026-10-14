<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pegawai Pemko - BATAM EDU-GOV AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
        .role-indicator {
            left: 4px;
            top: 4px;
            bottom: 4px;
            width: calc((100% - 8px) / 3);
            transform: translateX(0);
            transition: transform 250ms ease;
        }
        .role-selector:has(label:nth-of-type(2) input:checked) .role-indicator { transform: translateX(100%); }
        .role-selector:has(label:nth-of-type(3) input:checked) .role-indicator { transform: translateX(200%); }
        @media (prefers-reduced-motion: reduce) {
            .role-indicator { transition: none; }
        }
    </style>
</head>
<body class="min-h-screen bg-white text-gray-900 antialiased">
    <main class="min-h-screen md:grid md:grid-cols-2">
        <section class="relative hidden min-h-screen flex-col justify-between overflow-hidden bg-black p-6 text-white md:flex lg:p-8 xl:p-12">
            <div class="relative z-10 flex items-center justify-between gap-4">
                <a href="{{ route('login') }}" class="text-sm font-medium text-white/70 transition hover:text-white">
                    <span aria-hidden="true">←</span> Kembali ke Laman Publik
                </a>
                <div class="flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-white/80">
                    <img src="{{ asset('Lambang_Kota_Batam.png') }}" alt="" class="h-5 w-5 object-contain">
                    PEMERINTAH KOTA BATAM
                </div>
            </div>

            <div class="relative z-10 max-w-xl">
                <div class="mb-7 inline-flex items-center gap-3">
                    <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="BATAM EDU-GOV AI" class="h-10 w-auto">
                    <span class="rounded-full bg-green-700 px-2 py-1 text-[10px] font-bold text-white">PEGAWAI</span>
                </div>
                <h1 class="mb-5 text-3xl font-extrabold leading-tight tracking-tight lg:text-4xl xl:text-5xl">
                    Pintu Akses Beasiswa Daerah Masa Depan.
                </h1>
                <p class="max-w-lg text-base leading-relaxed text-gray-300">
                    Portal pegawai untuk mendukung pengelolaan, verifikasi, dan pemantauan beasiswa Kota Batam.
                </p>

                <div class="mt-10 rounded-2xl border border-white/10 bg-white/[0.04] p-6">
                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-sm font-bold text-green-400">AKSES PEGAWAI PEMKO</p>
                        <span class="text-lg text-green-400" aria-hidden="true">◆</span>
                    </div>
                    <h2 class="text-lg font-bold">Gunakan akun dinas Anda</h2>
                    <p class="mt-2 text-sm leading-relaxed text-gray-400">
                        Pilih peran yang sesuai dengan akun yang telah didaftarkan oleh administrator sistem.
                    </p>
                </div>
            </div>

            <div class="relative z-10 flex flex-wrap gap-x-8 gap-y-2 text-xs text-gray-400">
                <span><span class="mr-2 text-green-400">●</span>Enkripsi koneksi</span>
                <span>Portal resmi Pemko Batam</span>
                <span>Akses tercatat dan terotorisasi</span>
            </div>
        </section>

        <section class="flex min-h-screen items-center justify-center px-6 py-10 sm:px-10 md:px-6 lg:px-12 xl:px-20">
            <div class="w-full max-w-lg">
                <div class="mb-8 flex items-center gap-3 md:hidden">
                    <img src="{{ asset('Lambang_Kota_Batam.png') }}" alt="Lambang Kota Batam" class="h-10 w-10 object-contain">
                    <div>
                        <p class="text-xs font-bold tracking-wide text-gray-500">PEMERINTAH KOTA BATAM</p>
                        <p class="text-sm font-bold text-gray-900">Akses Pegawai</p>
                    </div>
                </div>

                <div class="mb-7">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-wider text-gray-500">Akses peran dinas</p>
                    <fieldset>
                        <legend class="sr-only">Pilih peran pegawai</legend>
                        <div class="role-selector relative grid grid-cols-3 rounded-xl bg-blue-50 p-1">
                            <span class="role-indicator absolute rounded-lg bg-white shadow-sm" aria-hidden="true"></span>
                            @foreach (['admin' => 'Admin', 'verifikator' => 'Verifikator', 'decisionmaker' => 'Pengambil Keputusan'] as $role => $label)
                                <label class="relative z-10 cursor-pointer">
                                    <input type="radio" name="role" value="{{ $role }}" form="pegawai-login-form" class="peer sr-only" @checked(old('role', 'admin') === $role)>
                                    <span class="block rounded-lg px-2 py-3 text-center text-xs font-semibold text-gray-600 transition-colors peer-checked:text-[#166534] sm:text-sm">
                                        {{ $label }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                </div>

                <div class="mb-6">
                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wide text-[#166534]">
                        Portal akses: pegawai Pemko Batam
                    </span>
                    <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-gray-900">Selamat Datang</h1>
                    <p class="mt-2 text-sm leading-relaxed text-gray-500">
                        Masuk menggunakan kredensial akun pegawai Pemko Batam yang terdaftar.
                    </p>
                </div>

                @if ($errors->any())
                    <div role="alert" class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div role="status" class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="pegawai-login-form" action="{{ route('pegawai.login.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="identifier" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-gray-600">
                            Alamat email dinas / ID ASN
                        </label>
                        <input id="identifier" name="identifier" type="text" value="{{ old('identifier') }}" required autocomplete="username"
                            placeholder="nama@batam.go.id atau ID ASN"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#166534] focus:bg-white focus:ring-2 focus:ring-[#166534]/15">
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wide text-gray-600">Kata sandi</label>
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="Masukkan kata sandi"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#166534] focus:bg-white focus:ring-2 focus:ring-[#166534]/15">
                    </div>

                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input name="remember" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-[#166534] focus:ring-[#166534]" @checked(old('remember'))>
                        Ingat perangkat ini
                    </label>

                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#166534] px-4 py-4 text-sm font-bold text-white shadow-lg shadow-[#166534]/15 transition hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-[#166534] focus:ring-offset-2">
                        Masuk Panel Pegawai
                        <span aria-hidden="true">→</span>
                    </button>
                </form>

                <div class="mt-7 rounded-xl border border-blue-100 bg-blue-50 p-4 text-xs leading-relaxed text-blue-900">
                    <p class="font-bold">Bantuan teknis aparatur sipil</p>
                    <p class="mt-1 text-blue-800">Kendala akses atau lupa kata sandi? Hubungi administrator sistem Pemko Batam.</p>
                </div>

                <a href="{{ route('login') }}" class="mt-6 block text-center text-sm font-medium text-gray-500 transition hover:text-[#166534]">
                    Kembali ke login pemohon
                </a>
            </div>
        </section>
    </main>
</body>
</html>
