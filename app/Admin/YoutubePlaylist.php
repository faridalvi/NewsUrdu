<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class YoutubePlaylist extends Model
{
    protected $table = 'youtube_playlists';
    protected $fillable = [
        'name', 'snippet', 'api_key','playlist_id','max_results','embed_url','position'
    ];
}
