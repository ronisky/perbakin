<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_categories')->insert([
            [
                'article_category_id'    => '1',
                'article_category_name'  => 'Event',
                'article_category_description'  => 'Kategori artikel event',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'article_category_id'    => '2',
                'article_category_name'  => 'Berita',
                'article_category_description'  => 'Kategori artikel berita',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],

        ]);
    }
}
