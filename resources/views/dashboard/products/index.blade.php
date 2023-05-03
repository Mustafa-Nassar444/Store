@extends('layouts.dashboard')
@section('title','Show Products')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products Page</li>
@endsection
@section('content')
 {{--   <div class="mb-5">
        <a href="{{route('products.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
        <a href="{{route('products.trashed')}}" class="btn btn-sm btn-outline-info">Trash</a>

    </div>--}}
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
            <th>
            </th>
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Description
            </th>
            <th>
                Store
            </th>
            <th>
                Category
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
        @if($products->count()>0)
            @foreach($products as $product)
                <tr>
                    <td>
                    </td>
                    <td>
                        {{$product->id}}
                    </td>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        {{$product->description}}
                    </td>
                {{--    <td>
                        <img src="{{asset('uploads/'.$product->image)}}"  height="50">
                    </td>--}}
                    <td>
                        {{$product->store->name}}
                    </td>
                    <td>
                        {{$product->category->name}}
                    </td>
                    <td>
                        {{$product->created_at}}
                    </td>
                    <td>

                            <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-primary" type="submit">Edit</a>
                    </td>
                      {{--  <td>
                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Delete</button>

                        </form>

                    </td>--}}
                </tr>
            @endforeach
        @else
{{--
            <td class="alert alert-danger">No products Found</td>
--}}
        @endif

        </tbody>
    </table>
    {{$products->withQueryString()->links()}}
@endsection
