<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents=Category::all();
        return view('dashboard.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if($request->hasFile('image')) {
            $img= $this->uploadImage($request,'uploads');
        }
        //
        $category=Category::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'description'=>$request->description,
            'image'=>$img,
            'status'=>$request->status
        ]);
        return redirect()->route('categories.index')->with(['success'=>'Category Saved']);
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
    public function edit($id)
    {
        //

        $category=Category::findOrFail($id);
        $parents=Category::where('id','<>',$id)
            ->where(function ($query) use($id){
                $query->whereNull('parent_id')
                    ->orWhere('parent_id','<>',$id);
            })
            ->get();
        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //

        $category=Category::findOrFail($id);
        $old_img=$category->image;
        $data=$request->except('image');
        if($request->hasFile('image')) {
            $img= $this->uploadImage($request,'uploads');
            $data['image']=$img;
        }
        $category->update($data);
        if ($old_img && isset($data['image'])) {
            unlink(public_path("uploads/".$old_img));
        }
        return redirect()->route('categories.index')->with(['success'=>'Category Updated']);
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
        $category=Category::findOrFail($id);
        $category->delete();
        $image_path = public_path("uploads/".$category->image);

        if (File::exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->route('categories.index')->with(['success'=>'Category Deleted']);
    }
}
