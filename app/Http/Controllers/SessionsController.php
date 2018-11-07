<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\URL;

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
        session(['reurl' => $_SERVER['HTTP_REFERER']]);
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

        $reurl = parse_url(session('reurl'))['path'];
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->has('remember'))) {
            $user = Auth::user();
            if ($user->is_activated) {
                session()->flash('success', '登陆成功');
                return redirect($reurl);
            }else{
                session()->flash('warning', '该账户尚未激活');
                return redirect()->route('users.to_confirm');
            }
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
