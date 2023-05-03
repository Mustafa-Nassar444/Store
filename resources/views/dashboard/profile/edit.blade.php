@extends('layouts.dashboard')
@section('title','Edit Profile')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section('content')
    <x-alert type="success" />
    <form action="{{route('profile.update')}}" method="POST">
        @csrf
        @method('PATCH')
       <div class="form-row">
           <div class="col-md-6">
               <label for="">First Name</label>
               <input name="first_name" type="text" class="form-control" value="{{$user->profile->first_name}}">
               @error('first_name')
               <div  class="form-text text-danger">{{$message}}</div>
               @enderror
           </div>
           <div class="col-md-6">
               <label for="">Last Name</label>
               <input name="last_name" type="text" class="form-control" value="{{$user->profile->last_name}}">
               @error('last_name')
               <div  class="form-text text-danger">{{$message}}</div>
               @enderror
           </div>
       </div>
       <div class="form-row">
           <div class="col-md-6">
               <label for="">Birthday</label>
               <input name="birthday" type="date" class="form-control" value="{{$user->profile->birthday}}">
               @error('birthday')
               <div  class="form-text text-danger">{{$message}}</div>
               @enderror
           </div>
           <div class="col-md-6">
               <label for="">Gender</label>
               <div>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="gender"  value="male" @checked($user->profile->gender=='male')>
                       <label class="form-check-label">
                           Male
                       </label>
                   </div>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="gender"  value="female" @checked($user->profile->gender=='female')>
                       <label class="form-check-label">
                           Female
                       </label>
                   </div>
                   @error('gender')
                   <div  class="form-text text-danger">{{$message}}</div>
                   @enderror
               </div>
           </div>
       </div>
       <div class="form-row">
           <div class="col-md-4">
           <label for="">Street Address</label>
           <input type="text" name="street_address" class="form-control" value="{{$user->profile->street_address}}">
           @error('street_address')
           <div  class="form-text text-danger">{{$message}}</div>
           @enderror
           </div>
           <div class="col-md-4">
               <label for="">City</label>
               <input type="text" name="city" class="form-control" value="{{$user->profile->city}}">
               @error('city')
               <div  class="form-text text-danger">{{$message}}</div>
               @enderror
           </div>
           <div class="col-md-4">
               <label for="">State</label>
               <input type="text" name="state" class="form-control" value="{{$user->profile->state}}">
               @error('state')
               <div  class="form-text text-danger">{{$message}}</div>
               @enderror
           </div>
       </div>
       <div class="form-row">
           <div class="col-md-4">
               <label for="">Postal Code</label>
               <input type="text" name="postal_code" class="form-control" value="{{$user->profile->postal_code}}">
               @error('postal_code')
               <div  class="form-text text-danger">{{$message}}</div>
               @enderror
           </div>
           <div class="col-md-4">
               <label for="">Country</label>
               <select name="country" class="form-control">
                   @foreach($countries as $key=>$value)
                       <option value="{{$key}}" @selected($key == $user->profile->country)>{{$value}}</option>
                   @endforeach
                   @error('country')
                   <div  class="form-text text-danger">{{$message}}</div>
                   @enderror
               </select>
           </div>
           <div class="col-md-4">
               <label for="">Language</label>
               <select name="locale" class="form-control">
                   @foreach($languages as $key=>$value)
                       <option value="{{$key}}" @selected($key==$user->profile->locale )>{{$value}}</option>
                   @endforeach
                   @error('locale')
                   <div  class="form-text text-danger">{{$message}}</div>
                   @enderror
               </select>
           </div>
       </div>
       <div class="form-group">
         <button type="submit" class="btn btn-outline-primary">Update</button>
       </div>
   </form>
@endsection
