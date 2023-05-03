@extends('layouts.dashboard')
@section('title','Edit Product')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Product</li>
    <li class="breadcrumb-item active">Edit Product</li>
@endsection
@section('content')
   <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
       @method('PUT')
       @csrf
       <div class="form-group">
            <label for="">Name</label>
           <input name="name" type="text" class="form-control" value="{{$product->name}}">
           @error('name')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Product Parent</label>
          <select name="parent_id" class="form-control">
              <option value="">Primary Product</option>
              @foreach(\App\Models\Category::all() as $category)
                  <option value="{{$category->id}}" @selected($product->category_id == $category->id)>{{$category->name}}</option>
              @endforeach
              @error('category_id')
              <div  class="form-text text-danger">{{$message}}</div>
              @enderror
          </select>
       </div>
       <div class="form-group">
           <label for="">Description</label>
           <textarea name="description" class="form-control" >{{$product->description}}</textarea>
           @error('description')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Image</label>
           <input type="file" name="image" class="form-control" accept="image/">
           @if($product->image)
               <img src="{{asset('uploads/'.$product->image)}}"  height="50" >
           @endif
           @error('image')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Price</label>
           <textarea name="price" class="form-control" >{{$product->price}}</textarea>
           @error('price')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Compare Price</label>
           <textarea name="compare_price" class="form-control" >{{$product->compare_price}}</textarea>
           @error('compare_price')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Tags</label>
           <textarea name="tags" class="form-control" >{{$tags}}</textarea>
           @error('tags')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Status</label>
           <div>
           <div class="form-check">
               <input class="form-check-input" type="radio" name="status"  value="active" @checked($product->status=='active')>
               <label class="form-check-label">
                   Active
               </label>
           </div>
               <div class="form-check">
                   <input class="form-check-input" type="radio" name="status"  value="draft" @checked($product->status=='draft')>
                   <label class="form-check-label">
                       Draft
                   </label>
               </div>
           <div class="form-check">
               <input class="form-check-input" type="radio" name="status"  value="archived" @checked($product->status=='archived')>
               <label class="form-check-label">
                   Archived
               </label>
           </div>
               @error('status')
               <div  class="form-text text-danger">{{$message}}</div>
               @enderror
           </div>
       </div>
       <div class="form-group">
         <button type="submit" class="btn btn-outline-primary">Update</button>
       </div>
   </form>
@endsection

