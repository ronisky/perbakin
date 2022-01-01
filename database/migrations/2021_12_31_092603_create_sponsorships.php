<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
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

            $table->foreign('sponsorship_category_id')
                ->references('sponsorship_category_id')
                ->on('sponsorship_categories');

            $table->foreign('created_by')
                ->references('user_id')
                ->on('sys_users')
                ->onDelete('cascade');

            $table->foreign('updated_by')
                ->references('user_id')
                ->on('sys_users')
                ->onDelete('cascade');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
}
