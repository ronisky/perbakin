<?php

namespace Modules\Article\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends QueryBuilderImplementation
{

    public $fillable = ['article_category_id', 'article_title', 'article_content', 'image_thumbnail_path', 'article_author', 'publish_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'articles';
        $this->pk = 'article_id';
    }

    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('article_categories', 'article_categories.article_category_id', 'articles.article_category_id')
                ->select('articles.*', 'article_categories.article_category_name')
                ->latest()
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function getAllByParamsLimit(array $params, $limit)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('article_categories', 'article_categories.article_category_id', 'articles.article_category_id')
                ->select('articles.*', 'article_categories.article_category_name')
                ->where($params)
                ->limit($limit)
                ->latest()
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
