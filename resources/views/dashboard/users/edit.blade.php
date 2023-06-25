@extends('layouts.dashboard')
@section('title','Edit User')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">User</li>
    <li class="breadcrumb-item active">Edit User</li>
@endsection
@section('content')
    <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        <div class="form-group">
            <label for="">Name</label>
            <input name="name" type="text" class="form-control" value="{{$user->name}}">
            @error('name')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" value="{{$user->email}}">
            @error('email')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        @csrf
        <fieldset>
            <legend>{{ __('Roles') }}</legend>

            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" @checked(in_array($role->id, old('roles', $user_roles)))>
                    <label class="form-check-label">
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
        </fieldset>

        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Update</button>
        </div>
    </form>
@endsection
