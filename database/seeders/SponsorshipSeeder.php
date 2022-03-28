<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sponsorships')->insert([
            [
                'sponsorship_id'    => '1',
                'sponsorship_category_id'  => '2',
                'day_show'        => 14,
                'sponsorship_name' => "Eiger",
                'sponsorship_type' => "photo",
                'sponsorship_description' => "Deskripsi",
                'sponsorship_duration'        => '7',
                'sponsorship_start_date'        => '2022-03-07',
                'sponsorship_end_date'        => '2022-03-14',
                'sponsorship_resource_path'          => 'data_eyJpdiI6ImR2VldyOWRBN3gxRzBia2NybVdEYlE9PSIsInZhbHVlIjoiOTRKMGgxUHlEN0hycGpOQnN0ekhwdz09IiwibWFjIjoiODNmMzc5MDdlYzM2NzJhZGZmZTNlNzRlY2JmNDAzYTRmY2Q2ZTgyY2M2ZWZlZTk2OGRlZmVhOGQwZGE0YjJlOCIsInRhZyI6IiJ9_1647088524.jpg',
                'sponsorship_status'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'sponsorship_id'    => '2',
                'sponsorship_category_id'  => '1',
                'day_show'        => 7,
                'sponsorship_name' => "Eiger",
                'sponsorship_type' => "video",
                'sponsorship_description' => "Deskripsi",
                'sponsorship_duration'        => '14',
                'sponsorship_start_date'        => '2022-03-07',
                'sponsorship_end_date'        => '2022-03-21',
                'sponsorship_resource_path'          => 'https://www.youtube.com/embed/BN2C3xWvcbQ',
                'sponsorship_status'        => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],

        ]);
    }
}
