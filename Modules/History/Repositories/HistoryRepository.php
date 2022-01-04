<?php

namespace Modules\History\Repositories;

use App\Implementations\QueryBuilderImplementation;

class HistoryRepository extends QueryBuilderImplementation
{

    public $fillable = ['description', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'histories';
        $this->pk = 'history_id';
    }
}
