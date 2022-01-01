<?php

namespace Modules\ApprovalStatus\Repositories;

use App\Implementations\QueryBuilderImplementation;

class ApprovalStatusRepository extends QueryBuilderImplementation
{

    public $fillable = ['approval_status_name', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'approval_statuses';
        $this->pk = 'approval_status_id';
    }
}
