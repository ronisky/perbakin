<?php

namespace Modules\LetterCategory\Repositories;

use App\Implementations\QueryBuilderImplementation;

class LetterCategoryRepository extends QueryBuilderImplementation
{

    public $fillable = ['letter_category_id', 'letter_category_name', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'letter_categories';
        $this->pk = 'letter_category_id';
    }
}
