<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::where('id', '>', 10)->paginate(10);
        return view('users.index', compact('users'));
    }

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


    public function edit($userid)
    {
        return view('users.edit', compact('userid'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'nullable|min:3|max:50',
            'password' => 'nullable|confirmed|min:6|'
        ]);
        $name = $request->name;
        $password = bcrypt($request->password);

        $name ? $user->name = $name : $password ;
        $password ? $user->password = $password : $password ;
        $user->save();
        session()->flash('success', '资料更新成功');
        return redirect()->route('users.show', compact('user'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', '用户' . $user->name . '已删除！');
        return redirect()->back();
    }
}
