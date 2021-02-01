<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $dates = ['published_at'];
    protected $fillable = [
        'title', 'slug', 'description','status','meta_description','meta_title',
        'home_page_section_id','featured_image','full_image','view_count',
        'created_by','updated_by','published_at','created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'category_posts');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'post_tags');
    }
    public function focusKeyWords(){
        return $this->belongsToMany(FocusKeyword::class,'focus_post_keywords');
    }
    public function homePageSection(){
        return $this->belongsTo(HomePageSection::class,'home_page_section_id');
    }
}
