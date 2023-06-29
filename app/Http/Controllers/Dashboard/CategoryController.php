<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use UploadImageTrait;
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if(Gate::denies('category.view'))
            abort(403);*/
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
        /*if(Gate::denies('category.create'))
            abort(403);*/
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
       /* if($request->hasFile('image')) {
            $img= $this->uploadImage($request,'uploads');
        }
        //
        $request->merge([
           'slug'=>Str::slug($request->post('name'))
        ]);
        $category=Category::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'description'=>$request->description,
            'image'=>$img,
            'status'=>$request->status
        ]);*/
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] =  $this->uploadImage($request,'uploads');;


        // Mass assignment
        $category = Category::create( $data );
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
        if(Gate::denies('category.view'))
            abort(403);
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
    public function edit(Category $category)
    {
        //
       /* if(Gate::denies('category.update'))
            abort(403);*/
        $id=$category->id;
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
    public function update(CategoryRequest $request, Category $category)
    {
        //

      //  $category=Category::findOrFail($id);
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
    public function destroy(Category $category)
    {
        //
       /* if(Gate::denies('category.delete'))
            abort(403);*/
      //  $category=Category::findOrFail($id);
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
