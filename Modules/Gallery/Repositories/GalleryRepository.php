<?php

namespace Modules\Gallery\Repositories;

use App\Implementations\QueryBuilderImplementation;

class GalleryRepository extends QueryBuilderImplementation
{

    public $fillable = ['gallery_title', 'gallery_description', 'gallery_image_path', 'gallery_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'galleries';
        $this->pk = 'gallery_id';
    }
}
