<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserGroupSeeder::class,
            UserSeeder::class,
            ModuleSeeder::class,
            TaskSeeder::class,
            RoleSeeder::class,
            MenuSeeder::class,
            ApprovalStatusSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
            LetterCategorySeeder::class,
            SponsorshipCategorySeeder::class,
            SponsorshipSeeder::class,
        ]);
    }
}
