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
        $request=request();

        $categories=Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
            ->select(['categories.*','parents.name as parent_name'])
            ->withCount('products')
            ->filter($request->query())
            ->paginate();
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
    public function show(Category $category)
    {
        return view('dashboard.categories.show',[
           'category'=>$category
        ]);
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


        return redirect()->route('categories.index')->with(['success'=>'Category Deleted']);
    }
    public function getTrashed(){
        $categories=Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request,$id){
        $categories=Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()->route('categories.trashed')->with(['success','Category restored Successfully']);
    }
    public function force($id){
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        $image_path = public_path("uploads/".$category->image);
        if (File::exists($image_path)) {
            unlink($image_path);
        }
        return redirect()->route('categories.trashed')->with(['success'=>'Category Deleted']);
    }
}
