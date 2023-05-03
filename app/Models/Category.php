<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','parent_id','description','image','status','slug'];
    public $timestamps=true;

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function parents(){
        return $this->belongsTo(Category::class,'parent_id','id')->withDefault(['name'=>'Main Category']);
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function scopeFilter(Builder $builder,$filters){
        $builder->when($filters['name']?? false,function ($builder,$value){
            $builder->where('name','LIKE',"%{$value}%");
        });
        $builder->when($filters['status']?? false,function ($builder,$value){
            $builder->where('status',$value);
        });
    }


}
