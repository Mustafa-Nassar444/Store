@extends('layouts.dashboard')
@section('title','Create User')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">User</li>
    <li class="breadcrumb-item active">User Create</li>
@endsection
@section('content')
    <form action="{{route('users.store')}}" method="POST">
        <div class="form-group">
            <label for="">Name</label>
            <input name="name" type="text" class="form-control" value="{{old('name')}}">
            @error('name')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input name="email" type="email" class="form-control" value="{{old('email')}}">
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
            <button type="submit" class="btn btn-outline-primary">Save</button>
        </div>
    </form>
@endsection
