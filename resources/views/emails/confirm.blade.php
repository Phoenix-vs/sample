@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        邮箱验证
    </div>
    <div class="panel-body">
        <p>点击按钮发送验证邮件到注册邮箱：</p>
        <a href="{{ route('users.confirm', $user->activation_token) }}" class="btn btn-primary">发送邮件</a>
    </div>
</div>
    @endsection