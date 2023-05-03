@extends('layouts.dashboard')
@section('title','Edit Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Category</li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection
@section('content')
   <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
       @method('PUT')
       @csrf
       <div class="form-group">
            <label for="">Name</label>
           <input name="name" type="text" class="form-control" value="{{$category->name}}">
           @error('name')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>

       <div class="form-group">
           <label for="">Category Parent</label>
          <select name="parent_id" class="form-control">
              <option value="">Primary Category</option>
              @foreach($parents as $parent)
                  <option value="{{$parent->id}} @selected($category->parent_id == $parent->id)">{{$parent->name}}</option>
              @endforeach
              @error('parent_id')
              <div  class="form-text text-danger">{{$message}}</div>
              @enderror
          </select>
       </div>
       <div class="form-group">
           <label for="">Description</label>
           <textarea name="description" class="form-control" >{{$category->description}}</textarea>
           @error('description')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Image</label>
           <input type="file" name="image" class="form-control" accept="image/">
           @if($category->image)
           <img src="{{asset('uploads/'.$category->image)}}"  height="50" >
           @endif
           @error('image')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
       </div>
       <div class="form-group">
           <label for="">Status</label>
           <div>
           <div class="form-check">
               <input class="form-check-input" type="radio" name="status"  value="active" @checked($category->status=='active')>
               <label class="form-check-label">
                   Active
               </label>
           </div>
           <div class="form-check">
               <input class="form-check-input" type="radio" name="status"  value="archived" @checked($category->status=='archived')>
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
