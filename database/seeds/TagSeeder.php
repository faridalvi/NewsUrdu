<?php

use App\Admin\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['Imran Khan','imran-khan',1,1,1]
        ];
        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag[0],
                'slug' => $tag[1],
                'trending' => $tag[2],
                'created_by' => $tag[3],
                'updated_by' => $tag[4],
            ]);
        }
    }
}
