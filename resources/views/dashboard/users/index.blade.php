@extends('layouts.dashboard')
@section('title','Show Users')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Users Page</li>
@endsection
@section('content')
    <div class="mb-5">
        @can('user.create')
            <a href="{{route('users.create')}}" class="btn btn-sm btn-outline-primary">Create</a>
        @endcan

        {{--
                <a href="{{route('users.trashed')}}" class="btn btn-sm btn-outline-info">Trash</a>
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
        @forelse($users as $user)
            <tr>
                <td></td>
                <td>
                    {{$user->id}}
                </td>
                <td><a href="{{route('users.show',$user->id)}}" >{{$user->name}}</a></td>

                <td>
                    {{$user->email}}
                </td>
                <td>

                </td>
                <td>
                    {{$user->created_at}}
                </td>
                @can('user.update')
                    <td>
                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-outline-primary" type="submit">Edit</a>
                    @endcan
                    </td>
                    <td>
                        @can('user.delete')
                            <form action="{{route('users.destroy',$user->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Delete</button>

                            </form>
                        @endcan
                    </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="alert alert-danger">No users Found</td>
            </tr>
        @endforelse



        </tbody>
    </table>
    {{$users->withQueryString()->links()}}
@endsection
