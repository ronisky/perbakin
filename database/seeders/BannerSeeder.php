<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'banner_id'             => 1,
                'banner_title'          => 'Lapangan Tembak',
                'banner_description'    => 'Latihan tembak di lapangan tembak',
                'banner_image_path'     => 'data_eyJpdiI6ImFHenRyT2w1OFViRGJON1lqUjRvNXc9PSIsInZhbHVlIjoiNDJvK0lGc29ZUjZmTTN2SHFHcDVsUT09IiwibWFjIjoiNWVmZGUwM2JkNDJiOTBhZmM3ZDUyYjEzMDUwMzZhZmRhZDk3MzZmY2M1ZWVjMTg3OGIxM2ZkZTk2Y2EwZDAyMyIsInRhZyI6IiJ9_1647083517.jpg',
                'banner_status'         => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'created_by'            => 1
            ]
        ]);
    }
}
