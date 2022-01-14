<?php

namespace Modules\SponsorshipCategory\Repositories;

use App\Implementations\QueryBuilderImplementation;

class SponsorshipCategoryRepository extends QueryBuilderImplementation
{

    public $fillable = ['sponsorship_category_name', 'sponsorship_category_description', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'sponsorship_categories';
        $this->pk = 'sponsorship_category_id';
    }
}
