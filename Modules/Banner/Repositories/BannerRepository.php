<?php

namespace Modules\Banner\Repositories;

use App\Implementations\QueryBuilderImplementation;

class BannerRepository extends QueryBuilderImplementation
{

    public $fillable = ['banner_title', 'banner_description', 'banner_image_path', 'banner_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'banners';
        $this->pk = 'banner_id';
    }
}
