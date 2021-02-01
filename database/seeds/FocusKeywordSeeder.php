<?php

use Illuminate\Database\Seeder;

class FocusKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $focusKeywords = [
            [1,'Pakistan'],
        ];
        foreach ($focusKeywords as $focusKeyword) {
            DB::table('focus_keywords')->insert([
                'id' => $focusKeyword[0],
                'name' => $focusKeyword[1]
            ]);
        }
    }
}
