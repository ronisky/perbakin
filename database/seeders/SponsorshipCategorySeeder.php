<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorshipCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sponsorship_categories')->insert([
            [
                'sponsorship_category_id'    => '1',
                'sponsorship_category_name'  => 'Platinum',
                'day_show'        => 14,
                'sponsorship_category_description' => "Iklan akan ditampilkan dalam 14 hari",
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'sponsorship_category_id'    => '2',
                'sponsorship_category_name'  => 'Bronze',
                'day_show'        => 7,
                'sponsorship_category_description' => "Iklan akan ditampilkan dalam 7 hari",
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],

        ]);
    }
}
