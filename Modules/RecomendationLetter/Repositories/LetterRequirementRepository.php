<?php

namespace Modules\RecomendationLetter\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class LetterRequirementRepository extends QueryBuilderImplementation
{
    public $fillable = ['file_buku_pas_senpi ', 'file_kta', 'file_kta_club', 'file_ktp', 'surat_pernyataan_hibah_senpi', 'file_foto_senjata', 'sertifikat_lulus_pentaran_berburu_reaksi', 'skck', 'file_surat_sehat', 'file_tes_psikotes', 'file_kk', 'file_si_impor_senjata', 'file_sba_penitipan_senpi', 'izin_penggunaan_lapangan', 'surat_rekomendasi_pengcab', 'surat_rekomendasi_club', 'nama_anggota_rombongan', 'undangan_berburu', 'ad_art_klub', 'struktur_organisasi', 'daftar_nama_pengurus', 'data_anggota_klub', 'suket_domisili_sekretariat', 'biaya_administrasi', 'file_foto_2x3', 'file_foto_3x4', 'file_foto_4x6', 'l5_lampiran1', 'l6_undangan_berburu', 'nama_anggota_senjata_digunakan', 'l8_kta_anggota_baru', 'l8_adart', 'l8_struktur_organisasi', 'l8_nama_para_pengurus', 'l8_pas_foto_pengurus', 'l8_data_anggota_club', 'l8_surat_keterangan_domisili', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'letter_requirements';
        $this->pk = 'letter_requirement_id';
    }

    public function insertGetId(array $data)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->insertGetId($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
