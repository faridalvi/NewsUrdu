<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
        'name', 'email', 'subject','message'
    ];
}
