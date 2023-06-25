@extends('layouts.dashboard')
@section('title','Show Roles')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles Page</li>
@endsection
@section('content')
    <div class="mb-5">
        @can('role.create')
            <a href="{{route('roles.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
        @endcan

            {{--
                    <a href="{{route('roles.trashed')}}" class="btn btn-sm btn-outline-info">Trash</a>
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
            <th colspan="2">
                Operations
            </th>
        </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
                <tr>
                    <td></td>
                    <td>
                        {{$role->id}}
                    </td>
                    <td><a href="{{route('roles.show',$role->id)}}" >{{$role->name}}</a></td>

                    <td>
                            @can('role.update')<a href="{{route('roles.edit',$role->id)}}" class="btn btn-outline-primary" type="submit">Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('role.delete')
                        <form action="{{route('roles.destroy',$role->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                        </form>
                            @endcan
                    </td>
                </tr>
            @empty
                <tr>
                <td colspan="5" class="alert alert-danger">No Roles Found</td>
                </tr>
            @endforelse



        </tbody>
    </table>
    {{$roles->withQueryString()->links()}}
@endsection
