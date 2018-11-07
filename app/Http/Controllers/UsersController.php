<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'confirmEmail']
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
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password), 'activation_token' => str_random(30)]);
        \Auth::login($user);
        $activation_token = md5($user->id . $user->email.'weibo');
        $user->activation_token = $activation_token;
        $user->save();
        $this->sendMail($request);
        session()->flash('success', $user->name.',账号注册成功，请尽快到邮箱进行激活操作！');
        return redirect()->route('users.show', compact('user'));
    }


    public function edit($userid)
    {
        if (User::find($userid)->is_activated)
            return view('users.edit', compact('userid'));
        else
            return view('emails.confirm', ['user' => User::find($userid)]);
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

    public function confirmEmail($token)
    {
        $user = \Auth::user();
        $this->authorize('confirmEmail', \Auth::user());

        if ($user->activation_token == $token) {
            $user->is_activated = true;
            $user->save();
            session()->flash('success', '邮箱验证成功');
            return view('users.show', compact('user'));
        } else {
            session()->flash('danger', '邮箱验证失败');
            return view('layout.success', ['success' => '邮箱验证失败，请重新验证']);
        }
    }

    public function sendConfirmMail(Request $request)
    {
        $user = $request->user();
        return view('emails.confirm', compact(['user']));
    }

    public function sendMail(Request $request)
    {
        $user = $request->user();
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'aufree@yousails.com';
        $name = 'Aufree';
        $to = $user->email;
        $subject = '感谢注册sample微博账户！快来验证邮箱吧！';
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
        session()->flash('success', '邮件发送成功');
        $success = '邮件发送成功，请尽快登陆邮箱完成验证！';
        return view('layouts.success', compact('success'));
    }


}
