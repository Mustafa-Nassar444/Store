@extends('layouts.dashboard')
@section('title','Create Role')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Role</li>
    <li class="breadcrumb-item active">Create Role</li>
@endsection
@section('content')
    <form action="{{route('roles.store')}}" method="POST">
        <div class="form-group">
            <label for="">Name</label>
            <input name="name" type="text" class="form-control" value="{{old('name')}}">
            @error('name')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
        </div>
        @csrf
        <fieldset>
            <legend>{{ __('Abilities') }}</legend>

            @foreach (app('abilities') as $ability_code => $ability_name)
                <div class="row mb-2">
                    <div class="col-md-6">


                        {{$ability_name}}
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="abilities[{{ $ability_code }}]" value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                        Allow
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="abilities[{{ $ability_code }}]" value="deny" @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                        Deny
                    </div>
                    <div class="col-md-2">
                        <input type="radio" name="abilities[{{ $ability_code }}]" value="inherit" @checked(($role_abilities[$ability_code] ?? '') == 'inherit')>
                        Inherit
                    </div>
                </div>
            @endforeach
        </fieldset>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Save</button>
        </div>
    </form>
@endsection
