<?php

namespace App\Policies;

use App\Models\User;
use App\Traits\HasRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

class ModelPolicy
{
    use HandlesAuthorization,HasRole;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function before($user, $ability)
    {
        if ($user->super_admin) {
            return true;
        }
    }

    public function __call($name,$arguments){
        $class_name=Str::lower(str_replace('Policy','',class_basename($this)));
        if($name=='viewAny'){
            $name='view';
        }
        $ability=$class_name.'.'.Str::kebab($name);
        $user=$arguments[0];
        if(isset($arguments[1])){
            $model=$arguments[1];
            if($model->store_id !== $user->store_id){
                return false;
            }
        }
       return $user->userAbilities($ability);
    }
}
