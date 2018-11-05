<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function show(User $user)
    {
        return view('users.show', compact('user') );
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            "email" => 'required|min:6|unique:users',
            "password" => 'required|confirmed|min:6',
        ]);

        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
        \Auth::login($user);
        session()->flash('success', $user->name.',账号注册成功');
        return redirect()->route('users.show', compact('user'));
    }


}
