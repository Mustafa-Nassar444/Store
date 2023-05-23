<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['store_id','category_id','name','slug','description','image','price','compare_price','rating','feature','status'];
    protected $hidden=['created_at','deleted_at','updated_at','image'];
    protected $appends=['image_url'];
    protected static function booted(){
        static::addGlobalScope('store',new StoreScope());
        static::creating(function (Product $product){
            $user=Auth::user();
            $product->slug=Str::slug($product->name);
            //$product->store->id=$user->store_id;
        });
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id','id','id');
    }

    public function scopeActive(Builder $builder){
        $builder->where('status','active');
    }
    public function getImageUrlAttribute(){
        if(!$this->image)
        {
            return 'https://apollobattery.com.au/wp-content/uploads/2022/08/default-product-image.png';
        }
        if(Str::startsWith($this->image,['http://','https://'])){
            return $this->image;
        }
        return asset('uploads/'.$this->image);
    }
    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }
        return number_format(100-(100*$this->price/$this->compare_price),0);

    }

    public function scopeFilter(Builder $builder,$filters){
        $options=array_merge([
            'store_id'=>null,
            'category_id'=>null,
            'tag_id'=>null,
        ],$filters);
        $builder->when($options['tag_id'],function ($builder,$value){
            $builder->whereExists(function ($query) use ($value){
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id',$value);
            });
        });
        $builder->when($options['store_id'], function ($builder, $value)  {
            $builder->where('store_id', $value);
        });
        $builder->when($options['category_id'], function ($builder, $value)  {
            $builder->where('category_id', $value);
        });

    }
}
