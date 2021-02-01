<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProgramDetails extends Model
{
    protected $table = 'program_details';
    protected $dates = ['published_at'];
    protected $fillable = [
        'title', 'slug', 'description','status','meta_description','meta_title',
        'program_id','featured_image','full_image','view_count',
        'created_by','updated_by','published_at','created_at','updated_at'
    ];
    public function programs(){
        return $this->belongsTo(Program::class,'program_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function focusKeyWords(){
        return $this->belongsToMany(FocusKeyword::class,'focus_program_keywords');
    }
}
