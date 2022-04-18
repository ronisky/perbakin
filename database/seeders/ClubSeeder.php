<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert([
            [
                'club_id'           => '1',
                'club_name'         => 'jingga Shooting CLub',
                'club_description'  => 'Club berada dibawah Perbakin Kab. Bandung',
                'club_phone'        => '085123456789',
                'club_email'        => 'jingga@jingga.com',
                'club_website'      => null,
                'club_whatsapp'     => '+6285123456789',
                'club_instagram'    => '@jingga',
                'club_facebook'     => 'Jingga Shooting CLub',
                'club_twitter'      => '@jingga',
                'club_youtube'      => 'Jingga Shooting CLub',
                'club_logo_path'    => null,
                'club_status'       => 1,
                'created_at'        => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
