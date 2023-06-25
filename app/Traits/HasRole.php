<?php

namespace App\Traits;

use App\Models\Role;

trait HasRole
{
 public function roles(){
     return $this->morphToMany(Role::class,'user','role_user');
 }
 public function userAbilities($ability){
     $denied= $this->roles()->whereHas('abilities',function ($query) use($ability){
         $query->where('ability',$ability)
             ->where('type','deny');
     })->exists();
     if($denied)
         return false;
    return $this->roles()->whereHas('abilities',function ($query) use($ability){
         $query->where('ability',$ability)
             ->where('type','allow');
     })->exists();
 }
}
