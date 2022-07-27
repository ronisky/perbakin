<?php

namespace Modules\RecomendationLetter\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class RecomendationLetterRepository extends QueryBuilderImplementation
{

    public $fillable = ['letter_id', 'letter_category_id ', 'firearm_id', 'letter_requirement_id', 'letter_no', 'letter_place', 'letter_date', 'letter_purpose_name', 'letter_purpose_place', 'name', 'place_of_birth', 'date_of_birth', 'occupation', 'address', 'club', 'no_kta', 'no_ktp', 'membership', 'pemohon', 'name2', 'place_of_birth2', 'date_of_birth2', 'occupation2', 'address2', 'no_ktp2', 'pemohon_pihak_2', 'l5_waktu_latihan_mulai', 'l5_waktu_latihan_selesai', 'dalam_event', 'lokasi1', 'lokasi2', 'lokasi3', 'lokasi4', 'jumlah_anggota', 'l6_waktu_latihan_selesai', 'l7_masa_bakti', 'l7_alasan_pengunduran', 'tembusan1', 'tembusan2', 'tembusan3', 'dasar_adart', 'mutasi_dari', 'mutasi_menuju', 'mutasi_alasan', 'l9_cabang', 'admin_status', 'admin_status_by', 'sekum_status', 'sekum_status_by', 'ketua_status', 'ketua_status_by', 'admin_note', 'sekum_note', 'ketua_note', 'letter_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'letters';
        $this->pk = 'letter_id';
    }

    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('letter_categories', 'letter_categories.letter_category_id', 'letters.letter_category_id')
                ->join('approval_statuses', 'approval_statuses.approval_status_id', 'letters.letter_status')
                ->join('sys_users', 'sys_users.user_id', 'letters.created_by')
                ->join('clubs', 'sys_users.club_id', 'clubs.club_id')
                ->select(
                    'letters.*',
                    'letter_categories.letter_category_name',
                    'approval_statuses.approval_status',
                    'approval_statuses.style_class',
                    'sys_users.user_name',
                    'clubs.club_name'
                )
                ->latest()
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllByParams(array $params)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('letter_categories', 'letter_categories.letter_category_id', 'letters.letter_category_id')
                ->join('approval_statuses', 'approval_statuses.approval_status_id', 'letters.letter_status')
                ->join('sys_users', 'sys_users.user_id', 'letters.created_by')
                ->join('clubs', 'sys_users.club_id', 'clubs.club_id')
                ->select(
                    'letters.*',
                    'letter_categories.letter_category_name',
                    'approval_statuses.approval_status',
                    'approval_statuses.style_class',
                    'sys_users.user_name',
                    'clubs.club_name'
                )
                ->where($params)
                ->latest()
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getByIdLetter($id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('letter_categories', 'letter_categories.letter_category_id', 'letters.letter_category_id')
                ->join('approval_statuses', 'approval_statuses.approval_status_id', 'letters.letter_status')
                ->leftJoin('firearms', 'firearms.firearm_id', 'letters.firearm_id')
                ->leftJoin('firearm_categories', 'firearm_categories.firearm_category_id', 'firearms.firearm_category_id')
                ->select(
                    'letters.*',
                    'letter_categories.letter_category_name',
                    'approval_statuses.approval_status',
                    'approval_statuses.style_class',
                    'firearms.firearm_category_id',
                    'firearms.merek',
                    'firearms.kaliber',
                    'firearms.no_pabrik',
                    'firearms.no_buku_pas_senpi',
                    'firearms.nama_pemilik',
                    'firearms.jumlah',
                    'firearms.penyimpanan',
                    'firearms.no_si_impor',
                    'firearms.pelaksana_impor',
                    'firearms.bap_senpi',
                    'firearms.tanggal_dikeluarkan',
                    'firearm_categories.firearm_category_name',
                )
                ->where($this->pk, '=', $id)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert(array $data)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->insert($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertGetIdFirearm(array $data)
    {
        try {
            return DB::connection($this->db)
                ->table('firearms')
                ->insertGetId($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertGetIdLetter(array $data)
    {
        try {
            return DB::connection($this->db)
                ->table('letters')
                ->insertGetId($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getById($id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('letter_categories', 'letter_categories.letter_category_id', 'letters.letter_category_id')
                ->select(
                    'letters.*',
                    'letter_categories.letter_category_name',
                )
                ->where($this->pk, '=', $id)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
