<?php

namespace Modules\Sponsorship\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class SponsorshipRepository extends QueryBuilderImplementation
{

    public $fillable = ['sponsorship_category_id', 'sponsorship_name', 'sponsorship_type', 'sponsorship_description', 'sponsorship_duration', 'sponsorship_start_date', 'sponsorship_end_date', 'sponsorship_resource_path', 'sponsorship_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'sponsorships';
        $this->pk = 'sponsorship_id';
    }

    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('sponsorship_categories', 'sponsorship_categories.sponsorship_category_id', 'sponsorships.sponsorship_category_id')
                ->select('sponsorships.*', 'sponsorship_categories.sponsorship_category_id', 'sponsorship_categories.sponsorship_category_name')
                ->latest()
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
