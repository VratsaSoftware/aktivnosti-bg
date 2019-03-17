<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Photo;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        $currentUser = User::find($id)->role_id;
        $rolesPluck= (Role::pluck('role','role_id'));
        $approvals = ['0'=> 'Not Approved'] + ['1'=> 'Approved'];
        $roles = [$currentUser => $rolesPluck[$currentUser]] + Role::pluck('role','role_id')->toArray();
        $user = User::findOrFail($id);
        return view('users.edit')->with(compact('user'))->with(compact('roles'))->with(compact('approvals'))->with(compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->name = $request->get('family');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->photo = $request->get('photo');
        $user->approved_at = ($request->get('approved')==1) ? (date('Y-m-d H:i:s')): NULL;
        $user->role_id = $request->get('role');
        $user->save();
        return redirect('users')->with('message', 'Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect()->back()->with('message', 'Done!');
    }
}
