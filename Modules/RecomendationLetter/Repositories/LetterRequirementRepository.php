<?php

namespace Modules\LetterRequirement\Repositories;

use App\Implementations\QueryBuilderImplementation;

class LetterRequirementRepository extends QueryBuilderImplementation
{
    public $fillable = ['buku_pas_senpi ', 'kta', 'ktp', 'surat_pernyataan_hibah_senpi', 'foto_senjata', 'sertifikat_lulus_pentaran_berburu_reaksi', 'skck', 'surat_keterangan_sehat', 'hasil_lulus_psikotes', 'kartu_keluarga', 'si_impor_senjata_api', 'surat_berita_acara_penitipan_senpi', 'izin_penggunaan_lapangan', 'surat_rekomendasi_pengcab', 'nama_anggota_rombongan', 'undangan_berburu', 'ad_art_klub', 'struktur_organisasi', 'daftar_nama_pengurus', 'data_anggota_klub', 'suket_domisili_sekretariat', 'biaya_administrasi', 'pas_poto_2x3', 'pas_poto_3x4', 'pas_poto_4x6', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'letter_requirements';
        $this->pk = 'letter_requirement_id';
    }
}
