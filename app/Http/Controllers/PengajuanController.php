<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengajuanController extends Controller
{
    /**
     * Halaman Pilih Jalur Beasiswa (3 Card Jalur)
     */
    public function index()
    {
        $user = Auth::user();
        $latestPengajuan = $user->latestPengajuan;

        return view('pengajuan.index', compact('latestPengajuan'));
    }

    /**
     * Halaman Form Pengajuan (Biodata -> Upload Dokumen)
     */
    public function form(string $jalur)
    {
        $validJalur = ['snbp', 'snbt', 'hinterland'];
        $jalurKey = strtolower($jalur);

        if (!in_array($jalurKey, $validJalur)) {
            return redirect()->route('pengajuan.index')->with('error', 'Jalur beasiswa tidak valid.');
        }

        $jalurMeta = [
            'snbp' => [
                'code' => 'SNBP-01',
                'title' => 'Jalur SNBP',
                'subtitle' => 'Seleksi Nasional Berdasarkan Prestasi',
                'nominal' => 'Rp 6.000.000 / semester',
                'color' => 'green',
                'required_docs' => [
                    [
                        'name' => 'file_ktp',
                        'label' => 'Scan e-KTP Kota Batam',
                        'desc' => 'File KTP asli Kota Batam (format JPG, PNG, atau PDF maks 5MB). Pastikan NIK dan foto terbaca jelas.',
                        'required' => true,
                    ],
                    [
                        'name' => 'file_raport',
                        'label' => 'Scan Rapor SMA / Transkrip Nilai',
                        'desc' => 'Scan rapor semester akhir SMA/SMK atau transkrip nilai resmi (format JPG, PNG, atau PDF maks 5MB).',
                        'required' => true,
                    ],
                ],
            ],
            'snbt' => [
                'code' => 'SNBT-02',
                'title' => 'Jalur SNBT',
                'subtitle' => 'Seleksi Nasional Berdasarkan Tes UTBK',
                'nominal' => 'Rp 7.000.000 / semester',
                'color' => 'blue',
                'required_docs' => [
                    [
                        'name' => 'file_ktp',
                        'label' => 'Scan e-KTP Kota Batam',
                        'desc' => 'File KTP asli Kota Batam (format JPG, PNG, atau PDF maks 5MB). Pastikan NIK terbaca jelas.',
                        'required' => true,
                    ],
                    [
                        'name' => 'file_utbk',
                        'label' => 'Sertifikat Nilai UTBK Resmi',
                        'desc' => 'Sertifikat resmi hasil skor tes UTBK-SNBT dari Balai Pengelolaan Pengujian Pendidikan (maks 5MB).',
                        'required' => true,
                    ],
                ],
            ],
            'hinterland' => [
                'code' => 'HTL-03',
                'title' => 'Jalur Hinterland',
                'subtitle' => 'Afirmasi Wilayah Kepulauan & Pesisir Batam',
                'nominal' => 'Rp 6.000.000 / semester',
                'color' => 'amber',
                'required_docs' => [
                    [
                        'name' => 'file_ktp',
                        'label' => 'Scan e-KTP Domisili Hinterland Batam',
                        'desc' => 'Scan e-KTP asli yang menunjukkan domisili di wilayah kepulauan (Belakang Padang, Galang, Bulang, dll. maks 5MB).',
                        'required' => true,
                    ],
                ],
            ],
        ];

        $currentJalur = $jalurMeta[$jalurKey];
        $user = Auth::user();

        return view('pengajuan.form', compact('jalurKey', 'currentJalur', 'user'));
    }

    /**
     * Proses Simpan Data Biodata & Upload Dokumen
     */
    public function store(Request $request, string $jalur)
    {
        $validJalur = ['snbp', 'snbt', 'hinterland'];
        $jalurKey = strtolower($jalur);

        if (!in_array($jalurKey, $validJalur)) {
            return redirect()->route('pengajuan.index')->with('error', 'Jalur beasiswa tidak valid.');
        }

        // Rules Validasi
        $rules = [
            'nama_lengkap'   => 'required|string|max:255',
            'nik'            => 'required|numeric|digits_between:12,16',
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'no_hp'          => 'required|string|max:20',
            'email'          => 'required|email|max:255',
            'kecamatan'      => 'required|string|max:100',
            'kelurahan'      => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'nama_kampus'    => 'required|string|max:255',
            'program_studi'  => 'required|string|max:255',
            'nim'            => 'required|string|max:50',
            'semester'       => 'required|integer|min:1|max:14',
            'ipk_nilai'      => 'nullable|numeric|min:0|max:100.00',
            'file_ktp'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ocr_data'       => 'nullable|string',
        ];

        if ($jalurKey === 'snbp') {
            $rules['file_raport'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        } elseif ($jalurKey === 'snbt') {
            $rules['file_utbk'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        $validated = $request->validate($rules);

        // Upload folder
        $destinationPath = public_path('uploads/pengajuan');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fileKtpPath = null;
        if ($request->hasFile('file_ktp')) {
            $ktpFile = $request->file('file_ktp');
            $ktpFileName = 'ktp_' . time() . '_' . Str::random(6) . '.' . $ktpFile->getClientOriginalExtension();
            $ktpFile->move($destinationPath, $ktpFileName);
            $fileKtpPath = 'uploads/pengajuan/' . $ktpFileName;
        }

        $fileRaportPath = null;
        if ($request->hasFile('file_raport')) {
            $raportFile = $request->file('file_raport');
            $raportFileName = 'raport_' . time() . '_' . Str::random(6) . '.' . $raportFile->getClientOriginalExtension();
            $raportFile->move($destinationPath, $raportFileName);
            $fileRaportPath = 'uploads/pengajuan/' . $raportFileName;
        }

        $fileUtbkPath = null;
        if ($request->hasFile('file_utbk')) {
            $utbkFile = $request->file('file_utbk');
            $utbkFileName = 'utbk_' . time() . '_' . Str::random(6) . '.' . $utbkFile->getClientOriginalExtension();
            $utbkFile->move($destinationPath, $utbkFileName);
            $fileUtbkPath = 'uploads/pengajuan/' . $utbkFileName;
        }

        // Generate No. Registrasi Unik
        $prefix = strtoupper($jalurKey);
        $nomorRegistrasi = 'BTM-' . $prefix . '-' . date('Y') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Parse OCR Data jika dikirim dari frontend Tesseract
        $parsedOcrData = null;
        if ($request->filled('ocr_data')) {
            $decoded = json_decode($request->input('ocr_data'), true);
            if (is_array($decoded)) {
                $parsedOcrData = $decoded;
            }
        }

        // Simpan Record Pengajuan
        $pengajuan = Pengajuan::create([
            'user_id'          => Auth::id(),
            'nomor_registrasi' => $nomorRegistrasi,
            'jalur'            => $prefix,
            'nama_lengkap'     => $validated['nama_lengkap'],
            'nik'              => $validated['nik'],
            'tempat_lahir'     => $validated['tempat_lahir'],
            'tanggal_lahir'    => $validated['tanggal_lahir'],
            'jenis_kelamin'    => $validated['jenis_kelamin'],
            'no_hp'            => $validated['no_hp'],
            'email'            => $validated['email'],
            'kecamatan'        => $validated['kecamatan'],
            'kelurahan'        => $validated['kelurahan'],
            'alamat_lengkap'   => $validated['alamat_lengkap'],
            'nama_kampus'      => $validated['nama_kampus'],
            'program_studi'    => $validated['program_studi'],
            'nim'              => $validated['nim'],
            'semester'         => $validated['semester'],
            'ipk_nilai'        => $validated['ipk_nilai'] ?? null,
            'file_ktp'         => $fileKtpPath,
            'file_raport'      => $fileRaportPath,
            'file_utbk'        => $fileUtbkPath,
            'status'           => 'menunggu_verifikasi',
            'catatan'          => 'Berkas berhasil diajukan dan siap diverifikasi.',
            'ocr_data'         => $parsedOcrData,
        ]);

        // Jalankan Analisis xAI secara otomatis terhadap data eksternal
        try {
            $xaiAnalysis = \App\Services\XAIService::analyze($pengajuan);
            $pengajuan->update(['xai_data' => $xaiAnalysis]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('xAI analysis error: ' . $e->getMessage());
        }

        return redirect()->route('pengajuan.sukses', $pengajuan->id);
    }

    /**
     * Halaman Sukses Pengajuan
     */
    public function sukses($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        return view('pengajuan.sukses', compact('pengajuan'));
    }

    /**
     * Halaman Perbaikan Berkas jika diminta oleh Verifikator
     */
    public function editPerbaikan($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        if ($pengajuan->status !== 'perlu_perbaikan') {
            return redirect()->route('dashboard')->with('info', 'Status pengajuan Anda saat ini tidak memerlukan perbaikan.');
        }

        $jalurKey = strtolower($pengajuan->jalur);
        return view('pengajuan.perbaikan', compact('pengajuan', 'jalurKey'));
    }

    /**
     * Simpan Pembaruan Berkas Perbaikan
     */
    public function updatePerbaikan(Request $request, $id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        if ($pengajuan->status !== 'perlu_perbaikan') {
            return redirect()->route('dashboard')->with('error', 'Status pengajuan tidak valid untuk perbaikan.');
        }

        $rules = [
            'nama_lengkap'   => 'required|string|max:255',
            'nik'            => 'required|numeric|digits_between:12,16',
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'no_hp'          => 'required|string|max:20',
            'email'          => 'required|email|max:255',
            'kecamatan'      => 'required|string|max:100',
            'kelurahan'      => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'nama_kampus'    => 'required|string|max:255',
            'program_studi'  => 'required|string|max:255',
            'nim'            => 'required|string|max:50',
            'semester'       => 'required|integer|min:1|max:14',
            'ipk_nilai'      => 'nullable|numeric|min:0|max:100.00',
            'file_ktp'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_raport'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_utbk'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];

        $validated = $request->validate($rules);

        $destinationPath = public_path('uploads/pengajuan');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if ($request->hasFile('file_ktp')) {
            $ktpFile = $request->file('file_ktp');
            $ktpFileName = 'ktp_' . time() . '_' . Str::random(6) . '.' . $ktpFile->getClientOriginalExtension();
            $ktpFile->move($destinationPath, $ktpFileName);
            $validated['file_ktp'] = 'uploads/pengajuan/' . $ktpFileName;
        }

        if ($request->hasFile('file_raport')) {
            $raportFile = $request->file('file_raport');
            $raportFileName = 'raport_' . time() . '_' . Str::random(6) . '.' . $raportFile->getClientOriginalExtension();
            $raportFile->move($destinationPath, $raportFileName);
            $validated['file_raport'] = 'uploads/pengajuan/' . $raportFileName;
        }

        if ($request->hasFile('file_utbk')) {
            $utbkFile = $request->file('file_utbk');
            $utbkFileName = 'utbk_' . time() . '_' . Str::random(6) . '.' . $utbkFile->getClientOriginalExtension();
            $utbkFile->move($destinationPath, $utbkFileName);
            $validated['file_utbk'] = 'uploads/pengajuan/' . $utbkFileName;
        }

        $validated['status'] = 'menunggu_verifikasi';
        $validated['catatan'] = 'Pemohon telah memperbarui dan mengirimkan ulang perbaikan berkas.';

        $pengajuan->update($validated);

        // Re-analyze xAI
        try {
            $xaiAnalysis = \App\Services\XAIService::analyze($pengajuan);
            $pengajuan->update(['xai_data' => $xaiAnalysis]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('xAI re-analysis error: ' . $e->getMessage());
        }

        return redirect()->route('dashboard')->with('success', 'Perbaikan berkas Anda telah berhasil dikirimkan kembali ke Verifikator!');
    }
}
