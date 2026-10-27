<?php

namespace App\Http\Controllers;

use App\Models\DataAkademik;
use App\Models\DataDukcapil;
use App\Models\Pengajuan;
use App\Services\XAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    /**
     * Dashboard Utama Pegawai (Admin, Verifikator, Pimpinan)
     */
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;

        // Query pengajuan
        $query = Pengajuan::query()->with('user')->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter pencarian nama / NIK / no registrasi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('nik', 'LIKE', "%{$search}%")
                  ->orWhere('nomor_registrasi', 'LIKE', "%{$search}%");
            });
        }

        // Filter jalur
        if ($request->filled('jalur')) {
            $query->where('jalur', strtoupper($request->jalur));
        }

        $pengajuans = $query->paginate(10)->withQueryString();

        // Pastikan setiap pengajuan memiliki xai_data
        foreach ($pengajuans as $p) {
            if (!$p->xai_data) {
                $p->xai_data = XAIService::analyze($p);
                $p->save();
            }
        }

        // Statistik Ringkasan
        $stats = [
            'total'               => Pengajuan::count(),
            'menunggu_verifikasi' => Pengajuan::where('status', 'menunggu_verifikasi')->count(),
            'perlu_perbaikan'     => Pengajuan::where('status', 'perlu_perbaikan')->count(),
            'menunggu_keputusan'  => Pengajuan::where('status', 'menunggu_keputusan')->count(),
            'disetujui'           => Pengajuan::where('status', 'disetujui')->count(),
            'ditolak'             => Pengajuan::where('status', 'ditolak')->count(),
            'dukcapil_count'      => DataDukcapil::count(),
            'akademik_count'      => DataAkademik::count(),
        ];

        return view('pegawai.dashboard', compact('user', 'role', 'pengajuans', 'stats'));
    }

    /**
     * Detail Berkas Pengajuan & Hasil Analisis xAI
     */
    public function show(int $id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);

        // Jika belum memiliki hasil xAI, jalankan analisis
        if (!$pengajuan->xai_data) {
            $pengajuan->xai_data = XAIService::analyze($pengajuan);
            $pengajuan->save();
        }

        return view('pegawai.pengajuan-detail', compact('pengajuan'));
    }

    /**
     * Aksi Verifikator: Loloskan & Teruskan ke Pengambil Keputusan (Pimpinan)
     */
    public function teruskan(Request $request, int $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        $catatanVerifikator = $request->filled('catatan')
            ? $request->catatan
            : 'Berkas dan analisis xAI telah diperiksa oleh Verifikator. Memenuhi syarat untuk diteruskan ke Pengambil Keputusan.';

        $pengajuan->update([
            'status'  => 'menunggu_keputusan',
            'catatan' => $catatanVerifikator,
        ]);

        return redirect()->route('pegawai.dashboard')
            ->with('success', "Pengajuan {$pengajuan->nomor_registrasi} ({$pengajuan->nama_lengkap}) berhasil disetujui dan diteruskan ke Pengambil Keputusan!");
    }

    /**
     * Aksi Verifikator: Kembalikan Berkas ke Calon Penerima (Perlu Perbaikan)
     */
    public function kembalikan(Request $request, int $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $validated = $request->validate([
            'catatan_perbaikan' => 'required|string|min:5|max:1000',
        ]);

        $pengajuan->update([
            'status'  => 'perlu_perbaikan',
            'catatan' => $validated['catatan_perbaikan'],
        ]);

        return redirect()->route('pegawai.dashboard')
            ->with('warning', "Pengajuan {$pengajuan->nomor_registrasi} telah dikembalikan kepada calon penerima dengan catatan perbaikan.");
    }

    /**
     * Aksi Verifikator: Tolak Pengajuan
     */
    public function tolak(Request $request, int $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $validated = $request->validate([
            'alasan_penolakan' => 'required|string|min:5|max:1000',
        ]);

        $pengajuan->update([
            'status'  => 'ditolak',
            'catatan' => $validated['alasan_penolakan'],
        ]);

        return redirect()->route('pegawai.dashboard')
            ->with('error', "Pengajuan {$pengajuan->nomor_registrasi} ditolak.");
    }

    /**
     * Aksi Pimpinan: Putuskan Penerimaan Beasiswa (Final Approval / Reject)
     */
    public function putuskan(Request $request, int $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $validated = $request->validate([
            'keputusan' => 'required|in:disetujui,ditolak',
            'catatan'   => 'nullable|string|max:1000',
        ]);

        $status = $validated['keputusan'];
        $catatan = $validated['catatan'] ?? ($status === 'disetujui'
            ? 'Selamat! Permohonan beasiswa Anda telah disetujui secara resmi oleh Pimpinan Pemko Batam.'
            : 'Mohon maaf, permohonan beasiswa belum dapat disetujui.');

        $pengajuan->update([
            'status'  => $status,
            'catatan' => $catatan,
        ]);

        $label = $status === 'disetujui' ? 'Diterima sebagai Penerima Beasiswa' : 'Ditolak';
        return redirect()->route('pegawai.dashboard')
            ->with('success', "Keputusan final berhasil disimpan: Pengajuan {$pengajuan->nomor_registrasi} dinyatakan {$label}!");
    }

    /**
     * Halaman Manajemen Pangkalan Data Eksternal (Admin, Verifikator, Pimpinan)
     */
    public function dataEksternal(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;
        $activeTab = $request->query('tab', 'dukcapil');
        $search = $request->query('search');

        // Query Dukcapil
        $dukcapilQuery = DataDukcapil::query()->latest();
        if ($search && $activeTab === 'dukcapil') {
            $dukcapilQuery->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('nik', 'LIKE', "%{$search}%")
                  ->orWhere('kecamatan', 'LIKE', "%{$search}%")
                  ->orWhere('kelurahan', 'LIKE', "%{$search}%");
            });
        }
        $dukcapils = $dukcapilQuery->paginate(15, ['*'], 'dukcapil_page')->withQueryString();

        // Query Akademik
        $akademikQuery = DataAkademik::query()->latest();
        if ($search && $activeTab === 'akademik') {
            $akademikQuery->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('nik', 'LIKE', "%{$search}%")
                  ->orWhere('nisn', 'LIKE', "%{$search}%")
                  ->orWhere('asal_sekolah', 'LIKE', "%{$search}%")
                  ->orWhere('nama_kampus_diterima', 'LIKE', "%{$search}%");
            });
        }
        $akademiks = $akademikQuery->paginate(15, ['*'], 'akademik_page')->withQueryString();

        $stats = [
            'dukcapil_count' => DataDukcapil::count(),
            'akademik_count' => DataAkademik::count(),
        ];

        return view('pegawai.data-eksternal', compact('user', 'role', 'activeTab', 'dukcapils', 'akademiks', 'stats', 'search'));
    }

    /**
     * Impor Data Eksternal dari Berkas Excel (.xlsx, .xls) atau CSV
     */
    public function importDataEksternal(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Hanya akun Admin yang memiliki akses impor pangkalan data eksternal.');
        }

        $request->validate([
            'tipe_data'  => 'required|in:dukcapil,akademik',
            'file_excel' => 'required|file|max:10240',
            'mode'       => 'required|in:upsert,truncate',
        ]);

        $file = $request->file('file_excel');
        $ext = strtolower($file->getClientOriginalExtension());
        $allowed = ['xlsx', 'xls', 'csv', 'txt'];
        if (!in_array($ext, $allowed)) {
            return redirect()->back()->with('error', 'Format berkas tidak didukung. Harap unggah berkas Excel (.xlsx) atau CSV (.csv).');
        }

        $storageDir = storage_path('app/temp_imports');
        if (!file_exists($storageDir)) {
            @mkdir($storageDir, 0755, true);
        }

        $tempFileName = 'import_' . uniqid() . '.' . $ext;
        $tempPath = $storageDir . DIRECTORY_SEPARATOR . $tempFileName;
        $file->move($storageDir, $tempFileName);

        $targetType = $request->tipe_data;
        $scriptPath = base_path('ai/excel_parser.py');
        $command = "python \"{$scriptPath}\" --file \"{$tempPath}\" --type \"{$targetType}\"";

        $output = shell_exec($command);

        if (file_exists($tempPath)) {
            @unlink($tempPath);
        }

        if (!$output) {
            return redirect()->back()->with('error', 'Gagal memproses berkas Excel. Pastikan format tabel sesuai kolom.');
        }

        $decoded = json_decode(trim($output), true);
        if (!$decoded || !isset($decoded['status']) || $decoded['status'] !== 'success') {
            $msg = $decoded['message'] ?? 'Terjadi kesalahan saat membaca isi tabel Excel.';
            return redirect()->back()->with('error', 'Gagal parsing berkas: ' . $msg);
        }

        $records = $decoded['records'] ?? [];
        if (empty($records)) {
            return redirect()->back()->with('warning', 'Berkas terbaca namun tidak ada baris data yang valid.');
        }

        if ($request->mode === 'truncate') {
            if ($targetType === 'dukcapil') {
                DataDukcapil::truncate();
            } else {
                DataAkademik::truncate();
            }
        }

        $inserted = 0;
        $updated = 0;

        foreach ($records as $r) {
            if (empty($r['nik'])) continue;

            if ($targetType === 'dukcapil') {
                $existing = DataDukcapil::where('nik', $r['nik'])->first();
                if ($existing) {
                    $existing->update($r);
                    $updated++;
                } else {
                    DataDukcapil::create($r);
                    $inserted++;
                }
            } else {
                $existing = DataAkademik::where('nik', $r['nik'])->first();
                if ($existing) {
                    $existing->update($r);
                    $updated++;
                } else {
                    DataAkademik::create($r);
                    $inserted++;
                }
            }
        }

        $label = $targetType === 'dukcapil' ? 'Disdukcapil Kota Batam' : 'Pangkalan Akademik Kemdikbud';
        return redirect()->route('pegawai.data-eksternal', ['tab' => $targetType])
            ->with('success', "Berhasil memproses {$decoded['total_records']} baris data {$label} ({$inserted} baru ditambahkan, {$updated} diperbarui)!");
    }

    /**
     * Hapus satu data referensi eksternal
     */
    public function deleteDataEksternal(Request $request, string $type, int $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Hanya akun Admin yang berhak menghapus data.');
        }

        if ($type === 'dukcapil') {
            DataDukcapil::findOrFail($id)->delete();
        } elseif ($type === 'akademik') {
            DataAkademik::findOrFail($id)->delete();
        }

        return redirect()->back()->with('success', 'Data referensi berhasil dihapus.');
    }

    /**
     * Unduh Template CSV / Excel
     */
    public function downloadTemplate(string $type)
    {
        if ($type === 'dukcapil') {
            $headers = ['nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'kecamatan', 'kelurahan', 'alamat_lengkap', 'status_kependudukan', 'kategori_wilayah'];
            $sample = ['2171010101010001', 'Fulan bin Fulan', 'Batam', '2005-01-01', 'Laki-laki', 'Batam Kota', 'Belian', 'Perumahan Graha Batam Blok A No. 1', 'AKTIF', 'MAINLAND'];
            $filename = 'template_data_dukcapil_batam.csv';
        } else {
            $headers = ['nik', 'nisn', 'nama_lengkap', 'asal_sekolah', 'jurusan_sekolah', 'tahun_lulus', 'jalur_seleksi', 'nama_kampus_diterima', 'program_studi_diterima', 'nilai_rata_rapor', 'skor_utbk', 'status_kelulusan'];
            $sample = ['2171010101010001', '0061234567', 'Fulan bin Fulan', 'SMA Negeri 1 Batam', 'MIPA', '2025', 'SNBP', 'Politeknik Negeri Batam', 'Teknik Informatika', '88.50', '', 'DITERIMA'];
            $filename = 'template_data_akademik_kemdikbud.csv';
        }

        $callback = function() use ($headers, $sample) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            fputcsv($file, $sample);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
