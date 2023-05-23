<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $products=Product::filter($request->query())
            ->with('category:id,name','store:id,name','tags:id,name')
            ->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $user=$request->user();
        if(!$user->tokenCan('products.create')){
            return response([
                'message'=>'Not Allowed'
            ],'403');
        }
        $product=Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ProductResource
     */
    public function show(Product $product)
    {
        //
        return new ProductResource($product);
        /*$product=Product::findOrFail($id);
        $product->load('category:id,name','store:id,name','tags:id,name');
        return $product;*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $user=$request->user();
        if(!$user->tokenCan('products.update')){
            return response([
                'message'=>'Not Allowed'
            ],'403');
        }
        $product=Product::findOrFail($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=Auth::guard('sanctum')->user();
        if(!$user->tokenCan('products.create')){
            return response([
                'message'=>'Not Allowed'
            ],'403');
        }
        Product::destroy($id);
        return response(['message'=>'Product Deleted Successfully']);

    }
}
