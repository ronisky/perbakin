<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetterRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_requirements', function (Blueprint $table) {
            $table->bigIncrements('letter_requirement_id');
            $table->string('surat_persyaratan_hibah_senpi');
            $table->string('buku_pas_senpi');
            $table->string('foto_senjata');
            $table->string('kta_perbakin');
            $table->string('ktp');
            $table->string('sertifikat_berburu_reaksi');
            $table->string('skck');
            $table->string('surat_keterangan_sehat_polda');
            $table->string('hasil_lulus_psikotes');
            $table->string('kartu_keluarga');
            $table->string('pas_poto_2x3');
            $table->string('pas_poto_3x4');
            $table->string('pas_poto_4x6');
            $table->dateTime('created_at');
            $table->bigInteger('created_by')->unsigned();
            $table->dateTime('updated_at')->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();

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
        Schema::dropIfExists('letter_requirements');
    }
}
