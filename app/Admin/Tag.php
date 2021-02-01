<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'name', 'slug', 'trending','created_by','updated_by','created_at','updated_at'
    ];

    public function posts(){
        return $this->belongsToMany(Post::class,'post_tags');
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
