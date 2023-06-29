<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins=Admin::paginate();
        return view('dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('dashboard.admins.create',compact([
            'roles'=>Role::all(),
            'admins'=>new Admin(),
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required|string|max:255',
            'roles'=>'array|required'
        ]);
        $admin=Admin::create($request->all());
        $admin->roles()->attach($request->roles);
        return redirect()->route('admins.index')->with(['success','Admin Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
        $roles=Role::all();
        $admin_roles=$admin->roles()->pluck('id')->toArray();
        return view('dashboard.admins.edit',compact([
            'roles','admin_roles','admin'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $request->validate([
            'name'=>'required|string|max:255',
            'roles'=>'required|array'
        ]);
        $admin->update($request->all());
        $admin->roles()->sync($request->roles);
        return redirect()->route('admins.index')->with(['success','Admin Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin=Admin::destroy($id);
        return redirect()->route('admins.index')->with('success','Admin Deleted!!');
    }
}
