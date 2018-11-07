<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\User;
use Illuminate\Http\Request;
use Auth;

class StatusesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
           'except' => ['index']
        ]);
    }

    public function index()
    {
        if (Auth::check())
        $statuses = Auth::user()->feed()->paginate(10);
        else
        $statuses = Status::where('id', '>', 0)->orderBy('created_at', 'desc')->paginate(10);
        return view('status.index', compact(['statuses']));
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        if ($request->content == '') {
            session()->flash('warning', '微博内容不能为空');
            return redirect()->back();
        }
        $user = $request->user();
        Status::create([
            'content' => $request->content,
            'user_id' => $user->id,
        ]);
        session()->flash('success', '微博发布成功');
        return redirect()->back();
    }
}
