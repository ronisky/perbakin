<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_username', 10)->unique();
            $table->string('user_name', 100);
            $table->string('user_kta', 20);
            $table->string('user_email', 100)->unique();
            $table->string('user_phone', 100)->unique();
            $table->string('place_of_birth', 100);
            $table->date('date_of_birth');
            $table->string('occupation', 100);
            $table->text('user_address')->nullable();
            $table->unsignedBigInteger('club_id')->nullable();
            $table->string('user_club_gen')->nullable();
            $table->string('user_club_cab')->nullable();
            $table->string('user_password');
            $table->string('user_image')->nullable();
            $table->date('user_active_date');
            $table->smallInteger('user_status')->default(0);
            $table->bigInteger('group_id')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->foreign('club_id')
                ->references('club_id')
                ->on('clubs');

            $table->foreign('group_id')
                ->references('group_id')
                ->on('sys_user_groups');

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
        Schema::dropIfExists('sys_users');
    }
}
