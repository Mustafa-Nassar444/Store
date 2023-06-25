{{--

--}}
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
            <input name="name" type="text" class="form-control" value="{{old('name')}}">
            @error('name')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select name="parent_id" class="form-control">
                <option value="">Primary Category</option>
                @foreach($parents as $parent)
                    <option value="{{$parent->id}}" @selected(old('parent_id'))>{{$parent->name}}</option>
                @endforeach
                @error('parent_id')
                <div  class="form-text text-danger">{{$message}}</div>
                @enderror
            </select>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" class="form-control"></textarea>
            @error('description')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" class="form-control" accept="image/">
            @error('image')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status"  value="active">
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
                @error('status')
                <div  class="form-text text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Save</button>
        </div>
    </form>
@endsection
