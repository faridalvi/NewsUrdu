<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class HomePageSection extends Model
{
    protected $table = 'home_page_sections';
    protected $fillable = [
        'name', 'post_count','position', 'created_at','updated_at'
    ];
    public function posts(){
        return $this->hasMany(Post::class,'home_page_section_id');
    }
    public function categories(){
        return $this->hasMany(Category::class,'home_page_section_id');
    }
    public function shows(){
        return $this->hasMany(Show::class,'home_page_section_id');
    }
}
