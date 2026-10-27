<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbaikan Berkas Beasiswa - BATAM EDU-GOV AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased min-h-screen flex flex-col selection:bg-amber-200">

    <!-- Top Header -->
    <header class="bg-black text-white border-b border-neutral-800 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('BATAM EDU-GOV AI W RBG.png') }}" alt="Logo" class="h-9 w-auto">
        </a>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                Mode Perbaikan Berkas
            </span>
            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-xl border border-neutral-700 hover:bg-neutral-800 text-xs font-bold text-gray-300">
                Kembali ke Dashboard
            </a>
        </div>
    </header>

    <main class="flex-1 p-6 md:p-10 space-y-8 max-w-4xl w-full mx-auto">

        <!-- Banner Catatan Verifikator -->
        <div class="p-6 sm:p-8 bg-gradient-to-r from-amber-500 via-amber-600 to-orange-600 rounded-3xl text-white shadow-xl space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-black/25">
                <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                Instruksi Perbaikan dari Verifikator
            </div>
            <h1 class="text-2xl font-black">
                Permohonan #{{ $pengajuan->nomor_registrasi }} Memerlukan Perbaikan
            </h1>
            <div class="p-4 bg-black/25 rounded-2xl border border-white/20 text-xs text-amber-100 leading-relaxed font-medium">
                "{{ $pengajuan->catatan }}"
            </div>
            <p class="text-xs text-amber-100">
                Silakan perbaiki data atau unggah ulang dokumen yang diminta di bawah ini. Begitu dikirim, sistem xAI akan memvalidasi ulang dan meneruskannya kembali ke petugas verifikator.
            </p>
        </div>

        @if ($errors->any())
            <div class="p-5 bg-red-50 border border-red-200 rounded-2xl text-red-800 text-xs space-y-1 shadow-sm">
                <div class="font-bold">Terdapat data yang belum sesuai:</div>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengajuan.perbaikan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 1. Biodata -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-5 shadow-sm">
                <h3 class="text-base font-extrabold text-gray-900 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    1. Data Identitas Pribadi & Domisili
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Nama Lengkap *</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pengajuan->nama_lengkap) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">NIK e-KTP *</label>
                        <input type="text" name="nik" value="{{ old('nik', $pengajuan->nik) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm font-mono focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Tempat Lahir *</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pengajuan->tempat_lahir) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pengajuan->tanggal_lahir?->format('Y-m-d')) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                            <option value="Laki-laki" @selected(old('jenis_kelamin', $pengajuan->jenis_kelamin) === 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('jenis_kelamin', $pengajuan->jenis_kelamin) === 'Perempuan')>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Nomor WhatsApp *</label>
                        <input type="tel" name="no_hp" value="{{ old('no_hp', $pengajuan->no_hp) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Kecamatan *</label>
                        <select name="kecamatan" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                            @php
                                $kecamatans = ['Batam Kota', 'Batu Ampar', 'Bengkong', 'Nongsa', 'Sekupang', 'Lubuk Baja', 'Sagulung', 'Batu Aji', 'Belakang Padang', 'Bulang', 'Galang', 'Sei Beduk'];
                            @endphp
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec }}" @selected(old('kecamatan', $pengajuan->kecamatan) === $kec)>{{ $kec }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Kelurahan *</label>
                        <input type="text" name="kelurahan" value="{{ old('kelurahan', $pengajuan->kelurahan) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block font-bold text-gray-700 uppercase mb-1">Alamat Lengkap *</label>
                        <textarea name="alamat_lengkap" rows="2" required class="w-full bg-gray-50 border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">{{ old('alamat_lengkap', $pengajuan->alamat_lengkap) }}</textarea>
                    </div>

                    <input type="hidden" name="email" value="{{ $pengajuan->email }}">
                </div>
            </div>

            <!-- 2. Pendidikan & Nilai -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-5 shadow-sm">
                <h3 class="text-base font-extrabold text-gray-900 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    2. Data Akademik & Nilai
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Perguruan Tinggi *</label>
                        <input type="text" name="nama_kampus" value="{{ old('nama_kampus', $pengajuan->nama_kampus) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">Program Studi *</label>
                        <input type="text" name="program_studi" value="{{ old('program_studi', $pengajuan->program_studi) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 uppercase mb-1">NIM *</label>
                        <input type="text" name="nim" value="{{ old('nim', $pengajuan->nim) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm font-mono focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-gray-700 uppercase mb-1">Semester *</label>
                            <input type="number" name="semester" min="1" max="14" value="{{ old('semester', $pengajuan->semester) }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 uppercase mb-1">Nilai Rata-rata / IPK</label>
                            <input type="number" step="0.01" min="0" max="100.00" name="ipk_nilai" value="{{ old('ipk_nilai', $pengajuan->ipk_nilai) }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Unggah Ulang Berkas -->
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 space-y-5 shadow-sm">
                <h3 class="text-base font-extrabold text-gray-900 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    3. Unggah Ulang Dokumen (Hanya jika perlu diganti)
                </h3>

                <div class="space-y-4">
                    <!-- KTP -->
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-200 space-y-2">
                        <label class="block text-xs font-bold text-gray-800">Unggah Ulang e-KTP Kota Batam</label>
                        @if($pengajuan->file_ktp)
                            <p class="text-[11px] text-gray-500">File saat ini: <a href="{{ route('file.serve', ['path' => $pengajuan->file_ktp]) }}" target="_blank" class="text-emerald-700 font-bold underline">Lihat KTP Lama</a></p>
                        @endif
                        <input type="file" name="file_ktp" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-800 file:text-white hover:file:bg-black cursor-pointer">
                    </div>

                    <!-- Rapor -->
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-200 space-y-2">
                        <label class="block text-xs font-bold text-gray-800">Unggah Ulang Rapor SMA / Transkrip</label>
                        @if($pengajuan->file_raport)
                            <p class="text-[11px] text-gray-500">File saat ini: <a href="{{ route('file.serve', ['path' => $pengajuan->file_raport]) }}" target="_blank" class="text-emerald-700 font-bold underline">Lihat Rapor Lama</a></p>
                        @endif
                        <input type="file" name="file_raport" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-800 file:text-white hover:file:bg-black cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 text-xs font-bold transition-all">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-black shadow-md transition-all flex items-center gap-2">
                    <span>Kirimkan Ulang Perbaikan Berkas</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </form>

    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500 mt-10">
        <p>&copy; 2026 Pemerintah Kota Batam &bull; BATAM EDU-GOV AI</p>
    </footer>

</body>
</html>
