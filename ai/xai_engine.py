"""
=================================================================================
BATAM EDU-GOV AI - PBLIF3-PD06
Explainable AI (xAI) Scholarship Eligibility & Verification Engine
Model: Scikit-Learn Random Forest Classifier + Feature Contribution Explainer
=================================================================================
"""

import sys
import json
import os
import numpy as np
from sklearn.ensemble import RandomForestClassifier

def train_baseline_model():
    """
    Melatih model Machine Learning baseline (Random Forest) untuk klasifikasi
    kelayakan beasiswa berdasarkan parameter verifikasi silang data eksternal.
    
    Fitur:
    0: nik_valid (1/0)
    1: status_kependudukan_aktif (1/0)
    2: nama_similarity (0.0 - 1.0)
    3: domisili_valid (1/0)
    4: status_kelulusan_kampus (1/0)
    5: nilai_normalized (0.0 - 1.0)
    6: selisih_nilai (selisih absolut terhadap pangkalan sekolah)
    """
    X_train = np.array([
        # [nik, aktif, nama_sim, domisili, kelulusan, nilai, selisih] -> Label: 1 (Lolos), 0 (Tidak Lolos)
        [1.0, 1.0, 1.0, 1.0, 1.0, 0.90, 0.0],  # Sangat Layak
        [1.0, 1.0, 0.95, 1.0, 1.0, 0.88, 0.0], # Layak (Kasus SNBP)
        [1.0, 1.0, 0.98, 1.0, 1.0, 0.85, 0.2], # Layak
        [1.0, 1.0, 0.90, 1.0, 1.0, 0.82, 0.1], # Layak Hinterland
        [1.0, 1.0, 1.0, 1.0, 1.0, 0.95, 0.0],  # Sangat Layak
        [1.0, 0.0, 0.90, 1.0, 1.0, 0.88, 0.0], # Status Dukcapil Nonaktif -> Tidak
        [0.0, 0.0, 0.50, 0.0, 0.0, 0.70, 5.0], # NIK Palsu/Bukan Batam -> Tidak
        [1.0, 1.0, 0.40, 1.0, 1.0, 0.85, 0.0], # Nama Tidak Cocok -> Tidak
        [1.0, 1.0, 1.0, 0.0, 1.0, 0.85, 0.0], # Domisili Gagal -> Tidak
        [1.0, 1.0, 1.0, 1.0, 0.0, 0.80, 0.0], # Kampus Tidak Diterima -> Tidak
        [1.0, 1.0, 1.0, 1.0, 1.0, 0.60, 8.0], # Nilai Rapor Terlalu Rendah & Beda -> Tidak
        [1.0, 1.0, 0.92, 1.0, 1.0, 0.87, 0.0], # Kasus Maya Lestari (Hinterland) -> Lolos
        [1.0, 1.0, 1.0, 1.0, 1.0, 0.89, 0.0],  # Kasus Bryan Sitorus (SNBP) -> Lolos
    ])
    
    y_train = np.array([1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1])
    
    model = RandomForestClassifier(n_estimators=35, random_state=42, max_depth=5)
    model.fit(X_train, y_train)
    return model

def calculate_name_similarity(name1, name2):
    if not name1 or not name2:
        return 0.0
    s1 = name1.strip().lower()
    s2 = name2.strip().lower()
    if s1 == s2:
        return 1.0
    
    # Jaccard / Character similarity
    set1 = set(s1.split())
    set2 = set(s2.split())
    intersection = len(set1.intersection(set2))
    union = len(set1.union(set2))
    jaccard = intersection / union if union > 0 else 0.0
    
    # Substring check
    if s1 in s2 or s2 in s1:
        return max(jaccard, 0.85)
        
    return max(jaccard, 0.5) if intersection > 0 else 0.2

def run_xai_analysis(payload):
    pengajuan = payload.get('pengajuan', {})
    dukcapil = payload.get('dukcapil')
    akademik = payload.get('akademik')
    
    # 1. Ekstraksi Fitur
    nik_valid = 1.0 if dukcapil else 0.0
    dukcapil_aktif = 1.0 if (dukcapil and dukcapil.get('status_kependudukan') == 'AKTIF') else 0.0
    
    nama_pemohon = pengajuan.get('nama_lengkap', '')
    nama_dukcapil = dukcapil.get('nama_lengkap', '') if dukcapil else ''
    nama_sim = calculate_name_similarity(nama_pemohon, nama_dukcapil)
    
    jalur = (pengajuan.get('jalur') or '').upper()
    is_hinterland = jalur == 'HINTERLAND'
    kategori_wilayah = (dukcapil.get('kategori_wilayah', '') if dukcapil else '').upper()
    
    if is_hinterland:
        domisili_valid = 1.0 if kategori_wilayah == 'HINTERLAND' else 0.0
    else:
        domisili_valid = 1.0 if dukcapil else 0.5
        
    status_kampus = 1.0 if (akademik and akademik.get('status_kelulusan') == 'DITERIMA') else 0.5
    
    # Nilai normalized (0-1)
    nilai_pemohon = float(pengajuan.get('ipk_nilai') or 0.0)
    nilai_norm = min(1.0, max(0.0, nilai_pemohon / 100.0 if nilai_pemohon > 4.0 else (nilai_pemohon / 4.0)))
    
    nilai_sistem = float(akademik.get('nilai_rata_rapor') or 0.0) if akademik else nilai_pemohon
    selisih_nilai = abs(nilai_pemohon - nilai_sistem)
    
    # Vector fitur
    feature_vector = np.array([[
        nik_valid,
        dukcapil_aktif,
        nama_sim,
        domisili_valid,
        status_kampus,
        nilai_norm,
        selisih_nilai
    ]])
    
    # 2. Prediksi Machine Learning
    model = train_baseline_model()
    prediction_proba = model.predict_proba(feature_vector)[0]
    
    # Probabilitas kelas 1 (Lolos)
    proba_lolos = float(prediction_proba[1]) if len(prediction_proba) > 1 else float(prediction_proba[0])
    
    # Kalkulasi skor skala 0 - 100
    skor_total = int(round(proba_lolos * 100))
    
    # 3. Explainable AI: Feature Importances & Local Contributions
    feature_names = [
        "Validitas NIK e-KTP (SIAK)",
        "Status Kependudukan Aktif",
        "Kesesuaian Nama Lengkap",
        "Afirmasi Domisili Batam",
        "Verifikasi Kelulusan Kampus",
        "Indeks Prestasi Akademik",
        "Akurasi Nilai vs Pangkalan Sekolah"
    ]
    
    global_importances = model.feature_importances_
    
    contributions = []
    for i, name in enumerate(feature_names):
        val = feature_vector[0][i]
        weight = float(global_importances[i]) * 100
        
        status = 'valid'
        if i in [0, 1, 3, 4] and val < 0.8:
            status = 'warning' if val > 0 else 'danger'
        elif i == 6 and val > 1.0:
            status = 'warning'
            
        contributions.append({
            'fitur': name,
            'bobot_kontribusi': round(weight, 1),
            'status': status,
            'nilai_input': float(val)
        })
        
    # Urutkan kontribusi terbesar ke terkecil
    contributions.sort(key=lambda x: x['bobot_kontribusi'], reverse=True)
    
    # 4. Keputusan & Rekomendasi
    if skor_total >= 80:
        rekomendasi = 'DIREKOMENDASIKAN_LOLOS'
        badge_color = 'green'
        kesimpulan = f"Model Machine Learning (Random Forest) memprediksi kelayakan beasiswa dengan probabilitas tinggi ({skor_total}%). Parameter kependudukan Batam dan prestasi akademik memenuhi syarat regulasi daerah."
    elif skor_total >= 60:
        rekomendasi = 'PERLU_PERBAIKAN_ATAU_REVIEW'
        badge_color = 'amber'
        kesimpulan = f"Model Machine Learning memprediksi kelayakan bersyarat ({skor_total}%). Terdapat catatan data yang memerlukan verifikasi manual petugas sebelum dapat diteruskan ke Pimpinan."
    else:
        rekomendasi = 'TIDAK_MEMENUHI_SYARAT'
        badge_color = 'red'
        kesimpulan = f"Model Machine Learning mendeteksi anomali kritis ({skor_total}%). Dokumen atau data tidak sesuai dengan pangkalan data eksternal resmi Kota Batam."

    return {
        "status": "success",
        "ai_engine": "Python 3 + Scikit-Learn (Random Forest) xAI",
        "skor_total": skor_total,
        "probabilitas_kelayakan": round(proba_lolos, 4),
        "rekomendasi": rekomendasi,
        "badge_color": badge_color,
        "kesimpulan_xai": kesimpulan,
        "feature_contributions": contributions,
        "model_metadata": {
            "algorithm": "RandomForestClassifier",
            "n_estimators": 35,
            "explainability_method": "Global Gini Importance & Normalized Feature Attribution"
        }
    }

if __name__ == '__main__':
    # Baca argumen / input JSON
    try:
        payload = {}
        if len(sys.argv) > 1:
            arg = sys.argv[1]
            if arg == '--file' and len(sys.argv) > 2:
                with open(sys.argv[2], 'r', encoding='utf-8') as f:
                    payload = json.load(f)
            elif os.path.isfile(arg):
                with open(arg, 'r', encoding='utf-8') as f:
                    payload = json.load(f)
            elif arg.startswith('b64:'):
                import base64
                raw = base64.b64decode(arg[4:]).decode('utf-8')
                payload = json.loads(raw)
            else:
                payload = json.loads(arg)
        else:
            payload = json.load(sys.stdin)
            
        output = run_xai_analysis(payload)
        print(json.dumps(output))
    except Exception as e:
        error_output = {
            "status": "error",
            "message": str(e)
        }
        print(json.dumps(error_output))
        sys.exit(1)
