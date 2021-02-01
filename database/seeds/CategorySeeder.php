<?php

use App\Admin\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['Latest News','latest-news',null,1,1,1,1],
            ['Pakistan','pakistan',1,1,1,1,1],
        ];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category[0],
                'slug' => $category[1],
                'parent_id' => $category[2],
                'home_page_section_id' => $category[3],
                'show_in_top_nav' => $category[4],
                'created_by' => $category[5],
                'updated_by' => $category[6],
            ]);
        }
    }
}
