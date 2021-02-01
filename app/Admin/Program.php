<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    protected $fillable = [
        'name', 'slug','image','created_by','updated_by','created_at','updated_at'
    ];
    public function details(){
        return $this->hasMany(ProgramDetails::class,'program_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
