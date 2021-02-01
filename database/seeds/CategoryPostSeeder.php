<?php

use Illuminate\Database\Seeder;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catPosts = [
            [1,1],
        ];
        foreach ($catPosts as $catPost) {
            DB::table('category_posts')->insert([
                'category_id' => $catPost[0],
                'post_id' => $catPost[1]
            ]);
        }
    }
}
