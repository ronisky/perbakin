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
            $table->string('buku_pas_senpi')->nullable();
            $table->string('kta')->nullable();
            $table->string('ktp')->nullable();
            $table->string('surat_pernyataan_hibah_senpi')->nullable();
            $table->string('foto_senjata')->nullable();
            $table->string('sertifikat_lulus_pentaran_berburu_reaksi')->nullable();
            $table->string('skck')->nullable();
            $table->string('surat_keterangan_sehat')->nullable();
            $table->string('hasil_lulus_psikotes')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('si_impor_senjata_api')->nullable();
            $table->string('surat_berita_acara_penitipan_senpi')->nullable();
            $table->string('izin_penggunaan_lapangan')->nullable();
            $table->string('surat_rekomendasi_pengcab')->nullable();
            $table->string('nama_anggota_rombongan')->nullable();
            $table->string('undangan_berburu')->nullable();
            $table->string('ad_art_klub')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('daftar_nama_pengurus')->nullable();
            $table->string('data_anggota_klub')->nullable();
            $table->string('suket_domisili_sekretariat')->nullable();
            $table->string('biaya_administrasi')->nullable();
            $table->string('pas_poto_2x3')->nullable();
            $table->string('pas_poto_3x4')->nullable();
            $table->string('pas_poto_4x6')->nullable();
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
