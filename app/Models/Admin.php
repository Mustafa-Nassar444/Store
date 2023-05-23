<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable=['name','username','email','password','phone_number','super_admin','status'];

}
