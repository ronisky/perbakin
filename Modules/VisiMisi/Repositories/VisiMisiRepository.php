<?php

namespace Modules\VisiMisi\Repositories;

use App\Implementations\QueryBuilderImplementation;

class VisiMisiRepository extends QueryBuilderImplementation
{

    public $fillable = ['title', 'description', 'image_path', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'visi_misi_tables';
        $this->pk = 'visi_misi_id';
    }
}
