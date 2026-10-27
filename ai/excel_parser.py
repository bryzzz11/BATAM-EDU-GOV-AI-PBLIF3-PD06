"""
=================================================================================
BATAM EDU-GOV AI - PBLIF3-PD06
External Data Excel & CSV Parser Engine (.xlsx, .xls, .csv)
Powered by Python openpyxl & csv
=================================================================================
"""

import sys
import json
import os
import csv
import re
from datetime import datetime, date

def normalize_header(name):
    if not name:
        return ''
    # Lowercase, hapus karakter aneh, strip
    s = str(name).strip().lower()
    s = re.sub(r'[\s\-_]+', '_', s)
    return s

def parse_date(val):
    if not val:
        return None
    if isinstance(val, (datetime, date)):
        return val.strftime('%Y-%m-%d')
    s = str(val).strip()
    # Format YYYY-MM-DD
    m1 = re.match(r'^(\d{4})[-/.](\d{1,2})[-/.](\d{1,2})$', s)
    if m1:
        y, m, d = m1.groups()
        return f"{int(y):04d}-{int(m):02d}-{int(d):02d}"
    # Format DD-MM-YYYY or DD/MM/YYYY
    m2 = re.match(r'^(\d{1,2})[-/.](\d{1,2})[-/.](\d{4})$', s)
    if m2:
        d, m, y = m2.groups()
        return f"{int(y):04d}-{int(m):02d}-{int(d):02d}"
    return s[:10]

def parse_excel_or_csv(file_path, target_type='dukcapil'):
    ext = os.path.splitext(file_path)[1].lower()
    rows = []

    if ext in ['.xlsx', '.xlsm', '.xltx', '.xltm']:
        import openpyxl
        wb = openpyxl.load_workbook(file_path, data_only=True)
        sheet = wb.active
        for row in sheet.iter_rows(values_only=True):
            if any(cell is not None and str(cell).strip() != '' for cell in row):
                rows.append([cell for cell in row])
    else:
        # Default CSV / Text
        encodings = ['utf-8', 'latin-1', 'cp1252']
        parsed_ok = False
        for enc in encodings:
            try:
                with open(file_path, 'r', encoding=enc) as f:
                    # Detect delimiter
                    sample = f.read(4096)
                    f.seek(0)
                    delimiter = ';' if ';' in sample and sample.count(';') > sample.count(',') else ','
                    reader = csv.reader(f, delimiter=delimiter)
                    for r in reader:
                        if any(c.strip() != '' for c in r):
                            rows.append([c.strip() for c in r])
                    parsed_ok = True
                    break
            except Exception:
                continue
        if not parsed_ok:
            raise ValueError(f"Gagal membaca berkas CSV: {file_path}")

    if not rows:
        return []

    # Baris pertama sebagai header
    raw_headers = [normalize_header(c) for c in rows[0]]
    data_rows = rows[1:]

    parsed_records = []

    # Alias mapping untuk Dukcapil
    dukcapil_alias = {
        'nik': ['nik', 'no_ktp', 'nomor_induk_kependudukan', 'ktp'],
        'nama_lengkap': ['nama_lengkap', 'nama', 'nama_pemohon', 'nama_warga', 'nama_penduduk'],
        'tempat_lahir': ['tempat_lahir', 'tempat', 'kota_lahir'],
        'tanggal_lahir': ['tanggal_lahir', 'tgl_lahir', 'lahir', 'tgllahir', 'dob'],
        'jenis_kelamin': ['jenis_kelamin', 'kelamin', 'jk', 'gender'],
        'kecamatan': ['kecamatan', 'kec'],
        'kelurahan': ['kelurahan', 'kel', 'desa'],
        'alamat_lengkap': ['alamat_lengkap', 'alamat', 'alamat_domisili', 'domisili'],
        'status_kependudukan': ['status_kependudukan', 'status', 'status_penduduk', 'status_ktp'],
        'kategori_wilayah': ['kategori_wilayah', 'kategori', 'wilayah', 'zona'],
    }

    # Alias mapping untuk Akademik
    akademik_alias = {
        'nik': ['nik', 'no_ktp', 'nomor_induk_kependudukan'],
        'nisn': ['nisn', 'no_nisn', 'nomor_induk_siswa_nasional'],
        'nama_lengkap': ['nama_lengkap', 'nama', 'nama_siswa', 'nama_mahasiswa'],
        'asal_sekolah': ['asal_sekolah', 'sekolah', 'sma', 'smk', 'man'],
        'jurusan_sekolah': ['jurusan_sekolah', 'jurusan', 'peminatan', 'program'],
        'tahun_lulus': ['tahun_lulus', 'lulus', 'tahun', 'angkatan'],
        'jalur_seleksi': ['jalur_seleksi', 'jalur', 'jalur_masuk'],
        'nama_kampus_diterima': ['nama_kampus_diterima', 'nama_kampus', 'kampus', 'ptn', 'universitas', 'perguruan_tinggi'],
        'program_studi_diterima': ['program_studi_diterima', 'program_studi', 'prodi', 'jurusan_kampus'],
        'nilai_rata_rapor': ['nilai_rata_rapor', 'nilai_rapor', 'rata_rapor', 'rapor', 'nilai', 'nilai_rata_rata'],
        'skor_utbk': ['skor_utbk', 'nilai_utbk', 'utbk', 'skor'],
        'status_kelulusan': ['status_kelulusan', 'status', 'kelulusan', 'keterangan'],
    }

    aliases = dukcapil_alias if target_type == 'dukcapil' else akademik_alias

    # Buat indeks mapping header -> field
    col_mapping = {}
    for col_idx, h in enumerate(raw_headers):
        for field, alt_names in aliases.items():
            if h in alt_names and field not in col_mapping:
                col_mapping[field] = col_idx
                break

    for row in data_rows:
        record = {}
        for field in aliases.keys():
            if field in col_mapping and col_mapping[field] < len(row):
                val = row[col_mapping[field]]
                record[field] = val if val is not None else ''
            else:
                record[field] = ''

        # Normalisasi data
        nik_clean = re.sub(r'[^0-9]', '', str(record.get('nik', '')))
        if not nik_clean:
            continue
        record['nik'] = nik_clean

        if target_type == 'dukcapil':
            record['tanggal_lahir'] = parse_date(record.get('tanggal_lahir'))
            # Format jenis kelamin
            jk_str = str(record.get('jenis_kelamin', '')).strip().lower()
            if 'perempuan' in jk_str or 'wanita' in jk_str or jk_str == 'p':
                record['jenis_kelamin'] = 'Perempuan'
            else:
                record['jenis_kelamin'] = 'Laki-laki'
            
            # Status kependudukan
            status_k = str(record.get('status_kependudukan', 'AKTIF')).strip().upper()
            record['status_kependudukan'] = status_k if status_k else 'AKTIF'

            # Kategori wilayah
            kat = str(record.get('kategori_wilayah', '')).strip().upper()
            kec = str(record.get('kecamatan', '')).strip().lower()
            if 'hinterland' in kat or any(h in kec for h in ['belakang padang', 'galang', 'bulang']):
                record['kategori_wilayah'] = 'HINTERLAND'
            else:
                record['kategori_wilayah'] = 'MAINLAND' if kat != 'HINTERLAND' else 'HINTERLAND'

        else: # akademik
            # Nilai rapor
            try:
                raw_val = str(record.get('nilai_rata_rapor', '0')).replace(',', '.')
                record['nilai_rata_rapor'] = float(raw_val) if raw_val else None
            except:
                record['nilai_rata_rapor'] = None

            # Skor UTBK
            try:
                raw_utbk = str(record.get('skor_utbk', '0')).replace(',', '.')
                record['skor_utbk'] = float(raw_utbk) if raw_utbk else None
            except:
                record['skor_utbk'] = None

            # Tahun lulus
            try:
                record['tahun_lulus'] = int(record.get('tahun_lulus', 2025))
            except:
                record['tahun_lulus'] = 2025

            # Jalur
            j = str(record.get('jalur_seleksi', 'SNBP')).strip().upper()
            record['jalur_seleksi'] = j if j in ['SNBP', 'SNBT', 'HINTERLAND'] else 'SNBP'

            # Status kelulusan
            st = str(record.get('status_kelulusan', 'DITERIMA')).strip().upper()
            record['status_kelulusan'] = 'DITERIMA' if 'DITERIMA' in st or 'LOLOS' in st else 'TIDAK_LOLOS'

        parsed_records.append(record)

    return parsed_records

if __name__ == '__main__':
    try:
        import argparse
        parser = argparse.ArgumentParser(description="Excel/CSV External Data Parser")
        parser.add_argument("--file", required=True, help="Path ke berkas Excel (.xlsx) atau CSV (.csv)")
        parser.add_argument("--type", default="dukcapil", choices=["dukcapil", "akademik"], help="Tipe data eksternal")
        args = parser.parse_args()

        records = parse_excel_or_csv(args.file, args.type)
        print(json.dumps({
            "status": "success",
            "total_records": len(records),
            "records": records
        }))
    except Exception as e:
        print(json.dumps({
            "status": "error",
            "message": str(e)
        }))
        sys.exit(1)
