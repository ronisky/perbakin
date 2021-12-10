<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_users')->insert([
            'user_id'           => '1',
            'user_name'         => 'Super Admin',
            'user_email'         => 'dev@perbakin.go.id',
            'user_password'     => Hash::make('qwerty'),
            'group_id'            => '1',
            'created_at'        => date('Y-m-d H:i:s'),
            'user_status'       => '1'
        ]);
    }
}
