<?php

namespace Modules\Club\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class ClubRepository extends QueryBuilderImplementation
{

    public $fillable = ['club_name', 'club_description', 'club_phone', 'club_email', 'club_website', 'club_whatsapp', 'club_instagram', 'club_facebook', 'club_twitter', 'club_youtube', 'club_logo_path', 'club_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'clubs';
        $this->pk = 'club_id';
    }

    public function getAllByParamsLimit(array $params, $limit)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->where($params)
                ->limit($limit)
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
