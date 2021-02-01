<?php

use App\Admin\YoutubePlaylist;
use Illuminate\Database\Seeder;

class YoutubePlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playlists = [
            [
                'Videos',
                'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status',
                'AIzaSyDyuBcljnu1_BfsYRhx6iS_gIlSjXC-xcI',
                'UUAiq04b9vvKobdRiGNgugtA',
                10,
                'https://www.youtube.com/embed/',
                1
            ],
            [
                'Showbiz',
                'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status',
                'AIzaSyDyuBcljnu1_BfsYRhx6iS_gIlSjXC-xcI',
                'PLGZP1Oryg6VPUvq7EaM92CtAWIUvQwvYg',
                10,
                'https://www.youtube.com/embed/',
                2
            ],
            [
                'Sports',
                'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status',
                'AIzaSyDyuBcljnu1_BfsYRhx6iS_gIlSjXC-xcI',
                'PLGZP1Oryg6VM1YkbYz7MjbJhbzs4xQ27V',
                10,
                'https://www.youtube.com/embed/',
                3
            ],
            [
                'Interesting',
                'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status',
                'AIzaSyDyuBcljnu1_BfsYRhx6iS_gIlSjXC-xcI',
                'PLGZP1Oryg6VOtB5TmadRLoWP4d4B1hBid',
                10,
                'https://www.youtube.com/embed/',
                4
            ]
        ];
        foreach ($playlists as $playlist) {
            YoutubePlaylist::create([
                'name' => $playlist[0],
                'snippet' => $playlist[1],
                'api_key' => $playlist[2],
                'playlist_id' => $playlist[3],
                'max_results' => $playlist[4],
                'embed_url' => $playlist[5],
                'position' => $playlist[6],
            ]);
        }
    }
}
