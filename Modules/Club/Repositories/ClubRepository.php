<?php

namespace Modules\Club\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class ClubRepository extends QueryBuilderImplementation
{

    public $fillable = ['club_id', 'club_name', 'club_description', 'club_website', 'club_whatsapp', 'club_instagram', 'club_phone', 'club_email', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'clubs';
        $this->pk = 'club_id';
    }
    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
