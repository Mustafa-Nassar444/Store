<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    //
    public function edit()
    {
        $user = Auth::user();
        $countries = Countries::getNames();
        $languages = Languages::getNames();
        return view('dashboard.profile.edit', compact('user', 'countries', 'languages'));
    }

    public function update(ProfileRequest $request)
    {
        $user = $request->user();
        $user->profile->fill($request->all())->save();
         return redirect()->route('profile.edit')->with('success','Profile Updated');
    }

}
