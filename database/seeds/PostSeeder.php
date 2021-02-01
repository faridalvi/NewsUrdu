<?php

use App\Admin\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            ['First Post','first-post','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries',1,'Dummy Meta Description','Dummy Title',1,100,1,1]
        ];
        foreach ($posts as $post) {
            Post::create([
                'title' => $post[0],
                'slug' => $post[1],
                'sub_content' => $post[2],
                'description' => $post[3],
                'status' => $post[4],
                'meta_description' => $post[5],
                'meta_title' => $post[6],
                'home_page_section_id' => $post[7],
                'view_count' => $post[8],
                'created_by' => $post[9],
                'updated_by' => $post[10],
            ]);
        }
    }
}
