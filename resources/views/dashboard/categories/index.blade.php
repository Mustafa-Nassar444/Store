@extends('layouts.dashboard')
@section('title','Show Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories Page</li>
@endsection
@section('content')
    <div class="mb-5">
        @can('category.create')
        <a href="{{route('categories.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
        @endcan
        <a href="{{route('categories.trashed')}}" class="btn btn-sm btn-outline-info">Trash</a>

    </div>
    <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="name" placeholder="Name" class="mx-2">
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="active">Active</option>
            <option value="archived">Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
<x-alert type="success" />
    <table class="table">
        <thead>
        <tr>
            <td></td>
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
                Product #
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
            @forelse($categories as $category)
                <tr>
                    <td></td>
                    <td>
                        {{$category->id}}
                    </td>
                    <td><a href="{{route('categories.show',$category->id)}}" >{{$category->name}}</a></td>
                    <td>
                        {{$category->parent_name}}
                    </td>
                    <td>
                        {{$category->products_count}}
                    </td>
                    <td>
                        <img src="{{asset('uploads/'.$category->image)}}"  height="50">
                    </td>
                    <td>
                        {{$category->created_at}}
                    </td>
                    <td>
                            @can('category.update')
                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-outline-primary" type="submit">Edit</a>
                        @endcan
                    </td>
                        <td>
                            @can('category.delete')
                        <form action="{{route('categories.destroy',$category->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Delete</button>

                        </form>
                            @endcan
                    </td>
                </tr>
            @empty
                <tr>
                <td colspan="5" class="alert alert-danger">No Categories Found</td>
                </tr>
            @endforelse



        </tbody>
    </table>
    {{$categories->withQueryString()->links()}}
@endsection
