<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug', 'parent','home_page_section_id','show_in_top_nav','position','level',
        'created_by','updated_by','created_at','updated_at'
    ];
    //Parent Has Children
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function posts(){
        return $this->belongsToMany(Post::class,'category_posts');
    }
    public function homePageSection(){
        return $this->belongsTo(HomePageSection::class,'home_page_section_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
