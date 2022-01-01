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
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'sponsorship_category_id'    => '2',
                'sponsorship_category_name'  => 'Bronze',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],

        ]);
    }
}
