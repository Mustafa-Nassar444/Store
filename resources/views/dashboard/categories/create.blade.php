@extends('layouts.dashboard')
@section('title','Create Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Category</li>
    <li class="breadcrumb-item active">Create Category</li>
@endsection
@section('content')
   <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
       @csrf
       <div class="form-group">
            <label for="">Name</label>
           <input name="name" type="text" class="form-control">
       </div>
       <div class="form-group">
           <label for="">Category Parent</label>
          <select name="parent_id" class="form-control">
              <option value="">Primary Category</option>
              @foreach($parents as $parent)
                  <option value="{{$parent->id}}">{{$parent->name}}</option>
              @endforeach
          </select>
       </div>
       <div class="form-group">
           <label for="">Description</label>
           <textarea name="description" class="form-control"></textarea>
       </div>
       <div class="form-group">
           <label for="">Image</label>
           <input type="file" name="image" class="form-control" accept="image/">
       </div>
       <div class="form-group">
           <label for="">Status</label>
           <div>
           <div class="form-check">
               <input class="form-check-input" type="radio" name="status"  value="active" checked>
               <label class="form-check-label">
                   Active
               </label>
           </div>
           <div class="form-check">
               <input class="form-check-input" type="radio" name="status"  value="archived">
               <label class="form-check-label">
                   Archived
               </label>
           </div>
           </div>
       </div>
       <div class="form-group">
         <button type="submit" class="btn btn-outline-primary">Save</button>
       </div>
   </form>
@endsection
