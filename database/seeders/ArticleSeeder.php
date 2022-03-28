<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'article_id'    => '1',
                'article_category_id'         => '1',
                'article_title'        => 'Coding Interview',
                'article_content'         => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'image_thumbnail_path'        => 'data_eyJpdiI6Im9Tci83dDhVLzBTOWNjZVZlSmUxN1E9PSIsInZhbHVlIjoiZ0labmIxSHVEakY0TzhIdmtMRzRsdz09IiwibWFjIjoiOWFkNTg3NTcwMjMzOWFjYzQ1OTQ0ZTU4N2RkNzIwMTM0MGRjOTViOGM1MDdjNjk0YmIxODk1Mzk0NjcyMGFmMCIsInRhZyI6IiJ9_1646627757.jpg',
                'article_author'        => 'Super Admin',
                'publish_status'         => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
        ]);
    }
}
