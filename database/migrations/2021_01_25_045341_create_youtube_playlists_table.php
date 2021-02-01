<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoutubePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_playlists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('snippet')->nullable();
            $table->string('api_key')->nullable();
            $table->string('playlist_id')->nullable();
            $table->string('max_results')->nullable();
            $table->string('embed_url')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youtube_playlists');
    }
}
