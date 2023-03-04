@extends('layouts.dashboard')
@section('title','Show Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories Page</li>
@endsection
@section('content')
    <div class="mb-5">
        <a href="{{route('categories.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>
            </th>
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Parent
            </th>
            <th>
                Image
            </th>
            <th>
                Created At
            </th>
            <th colspan="2">
                Operations
            </th>
        </tr>
        </thead>
        <tbody>
        @if($categories->count()>0)
            @foreach($categories as $category)
                <tr>
                    <td>
                    </td>
                    <td>
                        {{$category->id}}
                    </td>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        {{$category->parent_id}}
                    </td>
                    <td>
                        <img src="{{asset('uploads/'.$category->image)}}"  height="50">
                    </td>
                    <td>
                        {{$category->created_at}}
                    </td>
                    <td>

                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-outline-primary" type="submit">Edit</a>
                    </td>
                        <td>
                        <form action="{{route('categories.destroy',$category->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Delete</button>

                        </form>

                    </td>
                </tr>
            @endforeach
        @else
{{--
            <td class="alert alert-danger">No Categories Found</td>
--}}
        @endif

        </tbody>
    </table>
@endsection
