@extends('layouts.dashboard')
@section('title','Trashed Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Trashed Categories</li>
@endsection
@section('content')
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
                Image
            </th>
            <th>
                Deleted At
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
                        <img src="{{asset('uploads/'.$category->image)}}"  height="50">
                    </td>
                    <td>
                        {{$category->deleted_at}}
                    </td>
                        <td>
                            <form action="{{route('categories.restore',$category->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-outline-info" type="submit">Restore</button>
                            </form>
                        </td>
                    <td>
                        <form action="{{route('categories.forceDelete',$category->id)}}" method="post">
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
    {{$categories->withQueryString()->links()}}
@endsection
