<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ShowDetails extends Model
{
    protected $table = 'show_details';
    protected $fillable = [
        'name', 'slug', 'url','home_page_section_id','show_id','created_by','updated_by','created_at','updated_at'
    ];
    public function homePageSection(){
        return $this->belongsTo(HomePageSection::class,'home_page_section_id');
    }
    public function shows(){
        return $this->belongsTo(Show::class,'show_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
