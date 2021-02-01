<?php

use App\Admin\HomePageSection;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homepage = [
            ['Important News',1,5],
            ['Latest News',2,5],
            ['Editor Choice',3,8],
            ['Most Read News',4,3],
            ['Must Read',5,3],
            ['Podcast',6,8],
        ];
        foreach ($homepage as $home) {
            HomePageSection::create([
                'name' => $home[0],
                'position' => $home[1],
                'post_count' => $home[2]
            ]);
        }
    }
}
