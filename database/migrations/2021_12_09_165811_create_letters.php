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
            $table->unsignedBigInteger('letter_requirement_id')->nullable();
            $table->string('letter_no', 30);
            $table->string('letter_place', 30);
            $table->date('letter_date');
            $table->string('letter_purpose_name', 100);
            $table->string('letter_purpose_place', 20);
            $table->string('name', 50);
            $table->string('place_of_birth', 30);
            $table->date('date_of_birth');
            $table->string('occupation');
            $table->string('address');
            $table->string('club', 100);
            $table->string('no_kta', 30);
            $table->string('no_ktp', 30);
            $table->string('membership', 100);
            $table->string('pemohon', 50);
            $table->string('name2', 50)->nullable();
            $table->string('place_of_birth2', 30)->nullable();
            $table->date('date_of_birth2')->nullable();
            $table->string('occupation2')->nullable();
            $table->string('address2')->nullable();
            $table->string('no_kta2', 30)->nullable();
            $table->string('pemohon_pihak_2', 50)->nullable();
            $table->date('waktu_mulai');
            $table->date('waktu_selesai');
            $table->string('dalam_event')->nullable();
            $table->string('lokasi1')->nullable();
            $table->string('lokasi2')->nullable();
            $table->string('lokasi3')->nullable();
            $table->string('lokasi4')->nullable();
            $table->integer('jumlah_anggota')->nullable();
            $table->integer('l7_masa_bakti')->nullable();
            $table->text('l7_alasan_pengunduran')->nullable();
            $table->string('tembusan1')->nullable();
            $table->string('tembusan2')->nullable();
            $table->string('tembusan3')->nullable();
            $table->text('dasar_adart', 500)->nullable();
            $table->string('mutasi_dari', 50)->nullable();
            $table->string('mutasi_menuju', 50)->nullable();
            $table->text('mutasi_alasan', 500)->nullable();
            $table->string('l9_cabang', 50)->nullable();
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

            $table->foreign('letter_requirement_id')
                ->references('letter_requirement_id')
                ->on('letter_requirements');

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
