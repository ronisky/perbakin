<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirearms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firearms', function (Blueprint $table) {
            $table->bigIncrements('firearm_id');
            $table->unsignedBigInteger('firearm_category_id')->nullable();
            $table->string('merek', 100);
            $table->string('kaliber', 100);
            $table->string('no_pabrik', 100);
            $table->string('no_buku_pas_senpi', 100);
            $table->string('nama_pemilik', 100);
            $table->integer('jumlah');
            $table->string('penyimpanan', 100);
            $table->dateTime('created_at');
            $table->bigInteger('created_by')->unsigned();
            $table->dateTime('updated_at')->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            $table->foreign('firearm_category_id')
                ->references('firearm_category_id')
                ->on('firearm_categories');

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
        Schema::dropIfExists('firearms');
    }
}
