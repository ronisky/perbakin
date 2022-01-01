<?php

namespace Modules\ArticleCategory\Repositories;

use App\Implementations\QueryBuilderImplementation;

class ArticleCategoryRepository extends QueryBuilderImplementation
{

    public $fillable = ['article_category_name', 'article_category_description', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'article_categories';
        $this->pk = 'article_category_id';
    }
}
