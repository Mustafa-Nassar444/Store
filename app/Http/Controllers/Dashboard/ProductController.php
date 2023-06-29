<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Tag;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use UploadImageTrait;
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with(['category','store'])->paginate();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
       // $product=Product::findOrFail($id);
        $tags=implode(',',$product->tags()->pluck('name')->toArray());
       // $tags=$product->tags()->pluck('name');
        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
       // $product->update($request->except('tags'));
        $old_img=$product->image;
        $data=$request->except(['image','tags']);

        if($request->hasFile('image')) {
            $img= $this->uploadImage($request,'uploads');
            $data['image']=$img;
        }

        $tags=explode(",",$request->tags);
        $tags_id=[];

        $saved_tags=Tag::all();
        foreach ($tags as $t_name){
            $slug=Str::slug($t_name);
            $tag=$saved_tags->where('slug',$slug)->first();
            if(!$tag){
                $tag=Tag::create(['name'=>$t_name,'slug'=>$slug]);
            }
            $tags_id[]=$tag->id;
        }
        $product->update($data);

        $product->tags()->sync($tags_id);
        if ($old_img && isset($data['image'])) {
            unlink(public_path("uploads/".$old_img));
        }

        return redirect()->route('products.index')->with(['success'=>'Product Updated!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
