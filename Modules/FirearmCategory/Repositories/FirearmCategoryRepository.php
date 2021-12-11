<?php

namespace Modules\FirearmCategory\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class FirearmCategoryRepository extends QueryBuilderImplementation
{

    public $fillable = ['firearm_category_id', 'firearm_category_name', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'firearm_categories';
        $this->pk = 'firearm_category_id';
    }
}
