<?php

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PostTags = [
            [1,1]
        ];
        foreach ($PostTags as $PostTag) {
            DB::table('post_tags')->insert([
                'post_id' => $PostTag[0],
                'tag_id' => $PostTag[1]
            ]);
        }
    }
}
