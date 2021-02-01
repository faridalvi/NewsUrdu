<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class FocusKeyword extends Model
{
    protected $table = 'focus_keywords';
    protected $fillable = [
        'name','created_at','updated_at'
    ];

    public function posts(){
        return $this->belongsToMany(Post::class,'focus_post_keywords');
    }

    public function details(){
        return $this->belongsToMany(FocusProgramKeyword::class,'focus_program_keywords');
    }
}
