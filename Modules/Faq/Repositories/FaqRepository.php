<?php

namespace Modules\Faq\Repositories;

use App\Implementations\QueryBuilderImplementation;

class FaqRepository extends QueryBuilderImplementation
{

    public $fillable = ['faq_name', 'faq_email', 'faq_phone', 'faq_nik', 'faq_question', 'faq_description', 'faq_status', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'faqs';
        $this->pk = 'faq_id';
    }
}
