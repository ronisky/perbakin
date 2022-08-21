<?php

namespace Modules\RecomendationLetter\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class FirearmRepository extends QueryBuilderImplementation
{
    public $fillable = [
        'firearm_category_id', 'merek', 'kaliber', 'no_pabrik', 'no_buku_pas_senpi', 'nama_pemilik', 'jumlah', 'penyimpanan', 'no_si_impor', 'pelaksana_impor', 'bap_senpi', 'tanggal_dikeluarkan', 'created_at', 'created_by', 'updated_at', 'updated_by'
    ];

    public function __construct()
    {
        $this->table = 'firearms';
        $this->pk = 'firearm_id';
    }

    public function getById($id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('firearm_categories', 'firearm_categories.firearm_category_id', 'firearms.firearm_category_id')
                ->select(
                    'firearms.*',
                    'firearm_categories.firearm_category_name'
                )
                ->where('firearms.firearm_id', '=', $id)
                ->latest()
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
