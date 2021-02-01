<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'shows';
    protected $fillable = [
        'name', 'slug', 'description','home_page_section_id','image','created_by','updated_by','created_at','updated_at'
    ];
    public function homePageSection(){
        return $this->belongsTo(HomePageSection::class,'home_page_section_id');
    }
    public function details(){
        return $this->hasMany(ShowDetails::class,'show_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
