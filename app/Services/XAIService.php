<?php

namespace App\Services;

use App\Models\DataAkademik;
use App\Models\DataDukcapil;
use App\Models\Pengajuan;

class XAIService
{
    /**
     * Jalankan analisis eXplainable AI (xAI) untuk pengajuan beasiswa
     */
    public static function analyze(Pengajuan $pengajuan): array
    {
        $nik = preg_replace('/[^0-9]/', '', $pengajuan->nik);

        // 1. Cari data di Dukcapil Batam
        $dukcapil = DataDukcapil::where('nik', $nik)->first();
        if (!$dukcapil) {
            // Coba pencarian berbasis nama jika NIK tidak langsung cocok
            $dukcapil = DataDukcapil::where('nama_lengkap', 'LIKE', '%' . $pengajuan->nama_lengkap . '%')->first();
        }

        // 2. Cari data di Pangkalan Akademik Kemdikbud
        $akademik = DataAkademik::where('nik', $nik)->first();
        if (!$akademik) {
            $akademik = DataAkademik::where('nama_lengkap', 'LIKE', '%' . $pengajuan->nama_lengkap . '%')->first();
        }

        $checks = [];
        $totalScore = 0;

        // ─── CHECK 1: Validitas Kependudukan (Bobot: 20%) ─────────────────────
        if ($dukcapil && $dukcapil->status_kependudukan === 'AKTIF') {
            $totalScore += 20;
            $checks[] = [
                'kategori'    => 'Kependudukan',
                'aspek'       => 'Validitas NIK e-KTP',
                'status'      => 'valid',
                'icon'        => 'check',
                'skor'        => 20,
                'skor_maks'   => 20,
                'data_pemohon'=> $pengajuan->nik,
                'data_sistem' => $dukcapil->nik . ' (' . $dukcapil->status_kependudukan . ')',
                'penjelasan'  => 'NIK terdaftar resmi di SIAK Disdukcapil Kota Batam dengan status kependudukan AKTIF.',
            ];
        } elseif ($dukcapil) {
            $totalScore += 5;
            $checks[] = [
                'kategori'    => 'Kependudukan',
                'aspek'       => 'Validitas NIK e-KTP',
                'status'      => 'warning',
                'icon'        => 'alert',
                'skor'        => 5,
                'skor_maks'   => 20,
                'data_pemohon'=> $pengajuan->nik,
                'data_sistem' => $dukcapil->status_kependudukan,
                'penjelasan'  => 'PERINGATAN: NIK ditemukan namun status kependudukan tercatat: ' . $dukcapil->status_kependudukan . '.',
            ];
        } else {
            $checks[] = [
                'kategori'    => 'Kependudukan',
                'aspek'       => 'Validitas NIK e-KTP',
                'status'      => 'danger',
                'icon'        => 'cross',
                'skor'        => 0,
                'skor_maks'   => 20,
                'data_pemohon'=> $pengajuan->nik,
                'data_sistem' => 'Tidak Ditemukan',
                'penjelasan'  => 'ANOMALI: NIK pemohon tidak ditemukan pada pangkalan data kependudukan Kota Batam.',
            ];
        }

        // ─── CHECK 2: Kesesuaian Nama Pemohon (Bobot: 15%) ───────────────────
        if ($dukcapil) {
            similar_text(strtolower($pengajuan->nama_lengkap), strtolower($dukcapil->nama_lengkap), $percentNama);
            $percentNama = round($percentNama, 1);

            if ($percentNama >= 90) {
                $totalScore += 15;
                $checks[] = [
                    'kategori'    => 'Identitas',
                    'aspek'       => 'Kesesuaian Nama Lengkap',
                    'status'      => 'valid',
                    'icon'        => 'check',
                    'skor'        => 15,
                    'skor_maks'   => 15,
                    'data_pemohon'=> $pengajuan->nama_lengkap,
                    'data_sistem' => $dukcapil->nama_lengkap,
                    'penjelasan'  => "Nama pemohon memiliki tingkat kecocokan tinggi ({$percentNama}%) dengan data kependudukan resmi.",
                ];
            } else {
                $scoreNama = round(($percentNama / 100) * 15);
                $totalScore += $scoreNama;
                $checks[] = [
                    'kategori'    => 'Identitas',
                    'aspek'       => 'Kesesuaian Nama Lengkap',
                    'status'      => 'warning',
                    'icon'        => 'alert',
                    'skor'        => $scoreNama,
                    'skor_maks'   => 15,
                    'data_pemohon'=> $pengajuan->nama_lengkap,
                    'data_sistem' => $dukcapil->nama_lengkap,
                    'penjelasan'  => "Terdapat selisih penulisan nama ({$percentNama}%). Disdukcapil mencatat '{$dukcapil->nama_lengkap}'.",
                ];
            }
        } else {
            $checks[] = [
                'kategori'    => 'Identitas',
                'aspek'       => 'Kesesuaian Nama Lengkap',
                'status'      => 'warning',
                'skor'        => 5,
                'skor_maks'   => 15,
                'data_pemohon'=> $pengajuan->nama_lengkap,
                'data_sistem' => '-',
                'penjelasan'  => 'Tidak dapat diverifikasi silang karena data kependudukan tidak ditemukan.',
            ];
            $totalScore += 5;
        }

        // ─── CHECK 3: Wilayah Domisili & Afirmasi Hinterland (Bobot: 15%) ────
        $isJalurHinterland = strtoupper($pengajuan->jalur) === 'HINTERLAND';
        if ($dukcapil) {
            $isDomisiliHinterland = strtoupper($dukcapil->kategori_wilayah) === 'HINTERLAND';

            if ($isJalurHinterland && $isDomisiliHinterland) {
                $totalScore += 15;
                $checks[] = [
                    'kategori'    => 'Domisili',
                    'aspek'       => 'Verifikasi Afirmasi Hinterland',
                    'status'      => 'valid',
                    'icon'        => 'check',
                    'skor'        => 15,
                    'skor_maks'   => 15,
                    'data_pemohon'=> 'Kec. ' . $pengajuan->kecamatan . ' (Jalur Hinterland)',
                    'data_sistem' => 'Kec. ' . $dukcapil->kecamatan . ' (Wilayah Hinterland)',
                    'penjelasan'  => 'VALIDASI AFIRMASI: Pemohon terkonfirmasi berdomisili di pulau/pesisir (' . $dukcapil->kecamatan . ') berkategori HINTERLAND.',
                ];
            } elseif ($isJalurHinterland && !$isDomisiliHinterland) {
                $checks[] = [
                    'kategori'    => 'Domisili',
                    'aspek'       => 'Verifikasi Afirmasi Hinterland',
                    'status'      => 'danger',
                    'icon'        => 'cross',
                    'skor'        => 0,
                    'skor_maks'   => 15,
                    'data_pemohon'=> 'Kec. ' . $pengajuan->kecamatan . ' (Jalur Hinterland)',
                    'data_sistem' => 'Kec. ' . $dukcapil->kecamatan . ' (MAINLAND)',
                    'penjelasan'  => 'KETIDAKSESUAIAN JALUR: Pemohon mendaftar jalur Hinterland namun domisili resmi tercatat di wilayah Mainland (' . $dukcapil->kecamatan . ').',
                ];
            } else {
                $totalScore += 15;
                $checks[] = [
                    'kategori'    => 'Domisili',
                    'aspek'       => 'Kesesuaian Domisili Batam',
                    'status'      => 'valid',
                    'icon'        => 'check',
                    'skor'        => 15,
                    'skor_maks'   => 15,
                    'data_pemohon'=> 'Kec. ' . $pengajuan->kecamatan,
                    'data_sistem' => 'Kec. ' . $dukcapil->kecamatan . ' (' . $dukcapil->kategori_wilayah . ')',
                    'penjelasan'  => 'Alamat domisili terverifikasi sah di Kota Batam (' . $dukcapil->kecamatan . ').',
                ];
            }
        } else {
            $totalScore += 5;
            $checks[] = [
                'kategori'    => 'Domisili',
                'aspek'       => 'Kesesuaian Domisili Batam',
                'status'      => 'warning',
                'skor'        => 5,
                'skor_maks'   => 15,
                'data_pemohon'=> 'Kec. ' . $pengajuan->kecamatan,
                'data_sistem' => '-',
                'penjelasan'  => 'Perlu verifikasi fisik manual oleh petugas karena domisili belum terindeks otomatis.',
            ];
        }

        // ─── CHECK 4: Status Kelulusan Kampus / SNPMB (Bobot: 25%) ───────────
        if ($akademik && $akademik->status_kelulusan === 'DITERIMA') {
            $totalScore += 25;
            $checks[] = [
                'kategori'    => 'Akademik',
                'aspek'       => 'Verifikasi Kelulusan PTN/PTS',
                'status'      => 'valid',
                'icon'        => 'check',
                'skor'        => 25,
                'skor_maks'   => 25,
                'data_pemohon'=> $pengajuan->nama_kampus . ' - ' . $pengajuan->program_studi,
                'data_sistem' => $akademik->nama_kampus_diterima . ' (' . $akademik->status_kelulusan . ')',
                'penjelasan'  => "Terverifikasi lulus seleksi pada {$akademik->nama_kampus_diterima} ({$akademik->program_studi_diterima}) jalur {$akademik->jalur_seleksi} dari {$akademik->asal_sekolah}.",
            ];
        } elseif ($akademik) {
            $checks[] = [
                'kategori'    => 'Akademik',
                'aspek'       => 'Verifikasi Kelulusan PTN/PTS',
                'status'      => 'danger',
                'icon'        => 'cross',
                'skor'        => 0,
                'skor_maks'   => 25,
                'data_pemohon'=> $pengajuan->nama_kampus,
                'data_sistem' => $akademik->status_kelulusan,
                'penjelasan'  => "STATUS TIDAK MEMENUHI: Pangkalan data mencatat status siswa '{$akademik->status_kelulusan}'.",
            ];
        } else {
            // Jika belum ada di pangkalan nasional, beri skor parsial jika berkas raport ada
            $skorParsial = $pengajuan->file_raport ? 15 : 0;
            $totalScore += $skorParsial;
            $checks[] = [
                'kategori'    => 'Akademik',
                'aspek'       => 'Verifikasi Kelulusan PTN/PTS',
                'status'      => 'warning',
                'icon'        => 'alert',
                'skor'        => $skorParsial,
                'skor_maks'   => 25,
                'data_pemohon'=> $pengajuan->nama_kampus . ' - ' . $pengajuan->program_studi,
                'data_sistem' => 'Belum Sinkron Pangkalan',
                'penjelasan'  => 'Data kelulusan belum terindeks di pangkalan data nasional SNPMB. Verifikator perlu memeriksa bukti berkas asli.',
            ];
        }

        // ─── CHECK 5: Komparasi Nilai Rapor / Skor UTBK (Bobot: 25%) ─────────
        $nilaiPemohon = (float) $pengajuan->ipk_nilai;
        if ($akademik && $akademik->nilai_rata_rapor) {
            $nilaiSistem = (float) $akademik->nilai_rata_rapor;
            $selisih = abs($nilaiPemohon - $nilaiSistem);

            if ($selisih <= 0.5) {
                $totalScore += 25;
                $checks[] = [
                    'kategori'    => 'Nilai',
                    'aspek'       => 'Validasi Nilai Akademik',
                    'status'      => 'valid',
                    'icon'        => 'check',
                    'skor'        => 25,
                    'skor_maks'   => 25,
                    'data_pemohon'=> number_format($nilaiPemohon, 2),
                    'data_sistem' => number_format($nilaiSistem, 2),
                    'penjelasan'  => "Nilai yang diajukan (" . number_format($nilaiPemohon, 2) . ") sinkron dengan pangkalan data sekolah (" . number_format($nilaiSistem, 2) . ").",
                ];
            } else {
                $skorNilai = max(5, round(25 - ($selisih * 3)));
                $totalScore += $skorNilai;
                $checks[] = [
                    'kategori'    => 'Nilai',
                    'aspek'       => 'Validasi Nilai Akademik',
                    'status'      => 'warning',
                    'icon'        => 'alert',
                    'skor'        => $skorNilai,
                    'skor_maks'   => 25,
                    'data_pemohon'=> number_format($nilaiPemohon, 2),
                    'data_sistem' => number_format($nilaiSistem, 2),
                    'penjelasan'  => "SELISIH NILAI: Nilai formulir (" . number_format($nilaiPemohon, 2) . ") berbeda dengan arsip rapor sekolah (" . number_format($nilaiSistem, 2) . "). Selisih: " . number_format($selisih, 2) . ".",
                ];
            }
        } else {
            $totalScore += 15;
            $checks[] = [
                'kategori'    => 'Nilai',
                'aspek'       => 'Validasi Nilai Akademik',
                'status'      => 'info',
                'icon'        => 'info',
                'skor'        => 15,
                'skor_maks'   => 25,
                'data_pemohon'=> number_format($nilaiPemohon, 2),
                'data_sistem' => 'Menunggu Review Berkas',
                'penjelasan'  => "Nilai pemohon " . number_format($nilaiPemohon, 2) . " akan dicocokkan dengan dokumen scan raport yang diunggah.",
            ];
        }

        // ─── KESIMPULAN & REKOMENDASI BASELINE ─────────────────────────────
        $totalScore = min(100, max(0, $totalScore));

        if ($totalScore >= 85) {
            $rekomendasi = 'DIREKOMENDASIKAN_LOLOS';
            $badgeColor = 'green';
            $kesimpulan = "Sistem xAI merekomendasikan pengajuan ini untuk DITERUSKAN ke Pengambil Keputusan. Seluruh parameter kependudukan, status domisili Batam, dan kualifikasi akademik terverifikasi sah dengan tingkat keyakinan tinggi ({$totalScore}%).";
        } elseif ($totalScore >= 60) {
            $rekomendasi = 'PERLU_PERBAIKAN_ATAU_REVIEW';
            $badgeColor = 'amber';
            $kesimpulan = "Sistem xAI mendeteksi beberapa parameter yang memerlukan perhatian khusus ({$totalScore}%). Disarankan verifikator memeriksa catatan ketidaksesuaian atau mengembalikan berkas kepada pemohon untuk perbaikan.";
        } else {
            $rekomendasi = 'TIDAK_MEMENUHI_SYARAT';
            $badgeColor = 'red';
            $kesimpulan = "Sistem xAI mendeteksi anomali kritis atau ketidaksesuaian data mendasar ({$totalScore}%). Berkas tidak memenuhi kriteria penerimaan beasiswa reguler Pemerintah Kota Batam.";
        }

        // ─── INTEGRASI PYTHON SCIKIT-LEARN XAI ENGINE ───────────────────────
        $pythonResult = self::runPythonEngine($pengajuan, $dukcapil, $akademik);

        if ($pythonResult && isset($pythonResult['status']) && $pythonResult['status'] === 'success') {
            return [
                'ai_engine'             => $pythonResult['ai_engine'] ?? 'Python 3 + Scikit-Learn xAI',
                'skor_total'            => $pythonResult['skor_total'] ?? $totalScore,
                'probabilitas_kelayakan'=> $pythonResult['probabilitas_kelayakan'] ?? ($totalScore / 100),
                'rekomendasi'           => $pythonResult['rekomendasi'] ?? $rekomendasi,
                'badge_color'           => $pythonResult['badge_color'] ?? $badgeColor,
                'kesimpulan_xai'        => $pythonResult['kesimpulan_xai'] ?? $kesimpulan,
                'feature_contributions' => $pythonResult['feature_contributions'] ?? [],
                'model_metadata'        => $pythonResult['model_metadata'] ?? [],
                'checks'                => $checks,
                'analyzed_at'           => now()->toIso8601String(),
            ];
        }

        // Fallback PHP jika Python tidak tersedia
        return [
            'ai_engine'      => 'PHP xAI Rule-Based Engine (Fallback)',
            'skor_total'     => $totalScore,
            'rekomendasi'    => $rekomendasi,
            'badge_color'    => $badgeColor,
            'kesimpulan_xai' => $kesimpulan,
            'checks'         => $checks,
            'analyzed_at'    => now()->toIso8601String(),
        ];
    }

    /**
     * Panggil script Python Scikit-Learn xAI Engine via CLI
     */
    protected static function runPythonEngine(Pengajuan $pengajuan, $dukcapil, $akademik): ?array
    {
        try {
            $payload = [
                'pengajuan' => [
                    'nama_lengkap' => $pengajuan->nama_lengkap,
                    'nik'          => $pengajuan->nik,
                    'jalur'        => $pengajuan->jalur,
                    'ipk_nilai'    => (float) $pengajuan->ipk_nilai,
                    'kecamatan'    => $pengajuan->kecamatan,
                ],
                'dukcapil' => $dukcapil ? [
                    'nik'                 => $dukcapil->nik,
                    'nama_lengkap'        => $dukcapil->nama_lengkap,
                    'status_kependudukan' => $dukcapil->status_kependudukan,
                    'kategori_wilayah'    => $dukcapil->kategori_wilayah,
                    'kecamatan'           => $dukcapil->kecamatan,
                ] : null,
                'akademik' => $akademik ? [
                    'status_kelulusan' => $akademik->status_kelulusan,
                    'nilai_rata_rapor' => (float) $akademik->nilai_rata_rapor,
                    'asal_sekolah'     => $akademik->asal_sekolah,
                ] : null,
            ];

            $storageDir = storage_path('app');
            if (!file_exists($storageDir)) {
                @mkdir($storageDir, 0755, true);
            }

            $tempFile = $storageDir . DIRECTORY_SEPARATOR . 'xai_' . uniqid() . '.json';
            file_put_contents($tempFile, json_encode($payload));

            $scriptPath = base_path('ai/xai_engine.py');
            $command = "python \"{$scriptPath}\" --file \"{$tempFile}\"";

            $output = shell_exec($command);

            if (file_exists($tempFile)) {
                @unlink($tempFile);
            }

            if ($output) {
                $decoded = json_decode(trim($output), true);
                if (is_array($decoded) && isset($decoded['status']) && $decoded['status'] === 'success') {
                    return $decoded;
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('Python xAI Engine error: ' . $e->getMessage());
        }

        return null;
    }
}
