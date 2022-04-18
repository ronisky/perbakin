<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id('club_id');
            $table->string('club_name');
            $table->text('club_description')->nullable();
            $table->string('club_phone')->nullable();
            $table->string('club_email')->nullable();
            $table->string('club_website')->nullable();
            $table->string('club_whatsapp')->nullable();
            $table->string('club_instagram')->nullable();
            $table->string('club_facebook')->nullable();
            $table->string('club_twitter')->nullable();
            $table->string('club_youtube')->nullable();
            $table->string('club_logo_path')->nullable();
            $table->smallInteger('club_status')->default(0);;
            $table->dateTime('created_at');
            $table->bigInteger('created_by')->unsigned();
            $table->dateTime('updated_at')->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();

            // $table->foreign('created_by')
            //     ->references('user_id')
            //     ->on('sys_users')
            //     ->onDelete('cascade');

            // $table->foreign('updated_by')
            //     ->references('user_id')
            //     ->on('sys_users')
            //     ->onDelete('cascade');

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
        Schema::dropIfExists('clubs');
    }
}
