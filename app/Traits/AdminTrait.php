<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait AdminTrait
{
    public function isAdmin() {
        foreach (Auth::user()->roles as $role){
            if($role->name =='Super Admin' || $role->name =='admin'){
                return redirect()->route('dashboard');
            }
        }
    }
}
