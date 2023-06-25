@extends('layouts.dashboard')
@section('title','Edit Admin')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admin</li>
    <li class="breadcrumb-item active">Admin Edit</li>
@endsection
@section('content')
    <form action="{{route('admins.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        <div class="form-group">
            <label for="">Name</label>
            <input name="name" type="text" class="form-control" value="{{$admin->name}}">
            @error('name')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" value="{{$admin->email}}">
            @error('email')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        @csrf
        <fieldset>
            <legend>{{ __('Roles') }}</legend>

            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" @checked(in_array($role->id, old('roles', $admin_roles)))>
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
