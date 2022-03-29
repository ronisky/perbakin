<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetters extends Migration
{
    /**
     * Run the migrations.
     *letter_category_id
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->bigIncrements('letter_id');
            $table->unsignedBigInteger('letter_category_id')->nullable();
            $table->unsignedBigInteger('firearm_id')->nullable();
            $table->string('letter_no', 30);
            $table->string('letter_place', 30);
            $table->date('letter_date');
            $table->string('letter_purpose_name', 100);
            $table->string('letter_purpose_place', 20);
            $table->string('name');
            $table->string('place_of_birth', 20);
            $table->date('date_of_birth');
            $table->string('occupation');
            $table->string('address');
            $table->string('club', 100);
            $table->string('no_kta', 30);
            $table->string('membership', 100);
            $table->string('pemohon', 100);
            $table->smallInteger('admin_status')->default(0);
            $table->unsignedBigInteger('admin_status_by')->nullable();
            $table->smallInteger('sekum_status')->default(0);
            $table->unsignedBigInteger('sekum_status_by')->nullable();
            $table->smallInteger('ketua_status')->default(0);
            $table->unsignedBigInteger('ketua_status_by')->nullable();
            $table->string('admin_note')->nullable();
            $table->string('sekum_note')->nullable();
            $table->string('ketua_note')->nullable();
            $table->smallInteger('letter_status');
            $table->dateTime('created_at');
            $table->bigInteger('created_by')->unsigned();
            $table->dateTime('updated_at')->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('letter_category_id')
                ->references('letter_category_id')
                ->on('letter_categories');

            $table->foreign('firearm_id')
                ->references('firearm_id')
                ->on('firearms');

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
        Schema::dropIfExists('letters');
    }
}
