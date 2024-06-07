<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_user_data=User::all();
        return view('admin.user',[
            'get_user'=>$get_user_data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.FormUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password'=> 'required',
            'avatar' => 'required',
            'is_admin' => 'required'
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" =>Hash::make($request->password),
            "avatar" => $request->avatar,
            "is_admin" => $request->is_admin
        ]);

        return redirect()->route('user.index')->with('message','User has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view('admin.FormUpdateUser', [
            'user_data'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password'=> 'required',
            'avatar' => 'required',
            'is_admin' => 'required'
        ]);


        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" =>Hash::make($request->password),
            "avatar" =>$request->avatar,
            "is_admin" => $request->is_admin

        ]);
        return redirect()->route('user.index')->with('message','User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect()->route('user.index')->with('message','User has been deleted');
    }
}
