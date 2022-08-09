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
            $table->string('file_buku_pas_senpi')->nullable();
            $table->string('file_kta')->nullable();
            $table->string('file_kta_club')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_surat_hibah_senpi')->nullable();
            $table->string('file_foto_senjata')->nullable();
            $table->string('file_sertif_menembak')->nullable();
            $table->string('file_skck')->nullable();
            $table->string('file_surat_sehat')->nullable();
            $table->string('file_tes_psikotes')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('file_si_impor_senjata')->nullable();
            $table->string('file_sba_penitipan_senpi')->nullable();
            $table->string('izin_penggunaan_lapangan')->nullable();
            $table->string('surat_rekomendasi_pengcab')->nullable();
            $table->string('surat_rekomendasi_club')->nullable();
            $table->string('nama_anggota_rombongan')->nullable();
            $table->string('undangan_berburu')->nullable();
            $table->string('ad_art_klub')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('daftar_nama_pengurus')->nullable();
            $table->string('data_anggota_klub')->nullable();
            $table->string('suket_domisili_sekretariat')->nullable();
            $table->string('biaya_administrasi')->nullable();
            $table->string('file_foto_2x3')->nullable();
            $table->string('file_foto_3x4')->nullable();
            $table->string('file_foto_4x6')->nullable();
            $table->string('l5_lampiran1')->nullable();
            $table->string('l6_undangan_berburu')->nullable();
            $table->string('file_nama_anggota_senjata_digunakan')->nullable();
            $table->string('l8_kta_anggota_baru')->nullable();
            $table->string('l8_adart')->nullable();
            $table->string('l8_struktur_organisasi')->nullable();
            $table->string('l8_nama_para_pengurus')->nullable();
            $table->string('l8_pas_foto_pengurus')->nullable();
            $table->string('l8_data_anggota_club')->nullable();
            $table->string('l8_surat_keterangan_domisili')->nullable();
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
