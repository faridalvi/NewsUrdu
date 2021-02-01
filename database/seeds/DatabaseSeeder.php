<?php

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
        $this->call(PermissionTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(HomePageSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CategoryPostSeeder::class);
        $this->call(PostTagSeeder::class);
        $this->call(YoutubePlaylistSeeder::class);
        $this->call(FocusKeywordSeeder::class);
        $this->call(FocusPostSeeder::class);
    }
}
