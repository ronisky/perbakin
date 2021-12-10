<?php

namespace Modules\RecomendationLetter\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class RecomendationLetterRepository extends QueryBuilderImplementation
{

    public $fillable = ['letter_id', 'letter_category_id ', 'name', 'place_of_birth', 'date_of_birth', 'occupation', 'address', 'club', 'no_kta', 'membership', 'letter_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

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
                ->latest()
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
