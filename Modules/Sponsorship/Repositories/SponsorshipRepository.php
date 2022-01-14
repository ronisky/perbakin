<?php

namespace Modules\Sponsorship\Repositories;

use App\Implementations\QueryBuilderImplementation;

class SponsorshipRepository extends QueryBuilderImplementation
{

    public $fillable = ['sponsorship_category_name', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    public function __construct()
    {
        $this->table = 'sponsorships';
        $this->pk = 'sponsorship_category_id';
    }
}

Schema::create('', function (Blueprint $table) {
    $table->id('sponsorship_id');
    $table->unsignedBigInteger('sponsorship_category_id');
    $table->string('sponsorship_name', 20);
    $table->enum('sponsorship_level', ['bronze', 'platinum']);
    $table->text('sponsorship_description');
    $table->string('sponsorship_duration', 10);
    $table->date('sponsorship_start_date');
    $table->date('sponsorship_end_date');
    $table->string('sponsorship_resource_path');
    $table->smallInteger('sponsorship_status')->default(0);;
    $table->dateTime('created_at');
    $table->bigInteger('created_by')->unsigned();
    $table->dateTime('updated_at')->nullable();
    $table->bigInteger('updated_by')->unsigned()->nullable();