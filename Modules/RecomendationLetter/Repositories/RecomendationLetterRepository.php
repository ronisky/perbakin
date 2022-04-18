<?php

namespace Modules\RecomendationLetter\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class RecomendationLetterRepository extends QueryBuilderImplementation
{

    public $fillable = ['letter_id', 'letter_category_id ', 'letter_no', 'letter_place', 'letter_date', 'letter_purpose_name', 'letter_purpose_place', 'name', 'place_of_birth', 'date_of_birth', 'occupation', 'address', 'club', 'no_kta', 'membership', 'pemohon', 'admin_status', 'admin_status_by', 'sekum_status', 'sekum_status_by', 'ketua_status', 'ketua_status_by', 'admin_note', 'sekum_note', 'ketua_note', 'letter_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

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
                ->select(
                    'letters.*',
                    'letter_categories.letter_category_name'
                )
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
                ->leftJoin('firearms', 'firearms.firearm_id', 'letters.firearm_id')
                ->leftJoin('firearm_categories', 'firearm_categories.firearm_category_id', 'firearms.firearm_category_id')
                ->select(
                    'letters.*',
                    'letter_categories.letter_category_name',
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

    public function deleteFirearm($id)
    {
        try {
            return DB::connection($this->db)
                ->table('firearms')
                ->where('firearm_id', '=', $id)
                ->delete();
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
