<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest', [
           'only' => ['create']
        ]);
    }


    public function create()
    {
        if (!Auth::check()) {
            return view('session.create');
        }else {
            return redirect()->route('home');
        }
    }

    public function store(SessionLoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password], $request->has('remember'))) {
            $user = Auth::user();
            session()->flash('success', '登陆成功');
            return redirect()->route('home');
        } else {
            session()->flash('danger', '登陆失败');
            return redirect()->back();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('danger', '退出登陆！');
        return redirect()->back();
    }

}
