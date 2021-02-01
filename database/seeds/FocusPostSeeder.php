<?php

use Illuminate\Database\Seeder;

class FocusPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $focusPosts = [
            [1,1],
        ];
        foreach ($focusPosts as $focusPost) {
            DB::table('focus_post_keywords')->insert([
                'post_id' => $focusPost[0],
                'focus_keyword_id' => $focusPost[1]
            ]);
        }
    }
}
