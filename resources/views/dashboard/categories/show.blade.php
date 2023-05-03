@extends('layouts.dashboard')
@section('title',$category->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">{{$category->name}}</li>

@endsection
@section('content')

    <table class="table">
        <thead>
        <tr>
            <td></td>
            <th>
                Name
            </th>

            <th>
                Store
            </th>
            <th>
                Image
            </th>
            <th>
               Status
            </th>
            {{--<th colspan="2">
                Operations
            </th>--}}
        </tr>
        </thead>
        <tbody>
        @php
            $products=$category->products()->with('store')->paginate();
        @endphp
            @forelse($products as $product)
                <tr>
                    <td></td>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        {{$product->store->name}}
                    </td>
                    <td>
                        <img src="{{asset('uploads/'.$category->image)}}"  height="50">
                    </td>
                    <td>
                        {{$product->status}}
                    </td>
                 {{--   <td>

                            <a href="{{route('categories.edit',$product->id)}}" class="btn btn-outline-primary" type="submit">Edit</a>
                    </td>
                        <td>
                        <form action="{{route('categories.destroy',$category->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Delete</button>

                        </form>

                    </td>--}}
                </tr>
            @empty
                <tr>
                <td colspan="5" class="alert alert-danger">No Product Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{$products->withQueryString()->links()}}
@endsection
