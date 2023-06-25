@extends('layouts.dashboard')
@section('title','Show Admins')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admins Page</li>
@endsection
@section('content')
    <div class="mb-5">
        @can('admin.create')
            <a href="{{route('admins.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
        @endcan

        {{--
                <a href="{{route('admins.trashed')}}" class="btn btn-sm btn-outline-info">Trash</a>
        --}}

    </div>

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
                Email
            </th>
            <th>
                Roles
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
        @forelse($admins as $admin)
            <tr>
                <td></td>
                <td>
                    {{$admin->id}}
                </td>
                <td><a href="{{route('admins.show',$admin->id)}}" >{{$admin->name}}</a></td>

                <td>
                    {{$admin->email}}
                </td>
                <td>

                </td>
                <td>
                    {{$admin->created_at}}
                </td>
                @can('admin.update')
                    <td>
                    <a href="{{route('admins.edit',$admin->id)}}" class="btn btn-outline-primary" type="submit">Edit</a>
                    @endcan
                    </td>
                    <td>
                        @can('admin.delete')
                            <form action="{{route('admins.destroy',$admin->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Delete</button>

                            </form>
                        @endcan
                    </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="alert alert-danger">No admins Found</td>
            </tr>
        @endforelse



        </tbody>
    </table>
    {{$admins->withQueryString()->links()}}
@endsection
