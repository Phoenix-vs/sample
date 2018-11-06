@extends('layouts.app')

@section('content')
    <!--{{ $user = Auth::user() }}-->
    @if($userid == $user->id)
    <div class="panel panel-default col-md-offset-4 col-md-4">
        @include('shared._validate_message')
        <div class="panel-heading">
            更新个人资料
        </div>
        <div class="panel-body">
            <form action="{{route('users.update', $user->id)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="InputName">昵称</label>
                    <input type="text" class="form-control" value="" placeholder="{{ $user->name }}" name="name">
                </div>
                <div class="form-group">
                    <label for="InputPassword">密码</label>
                    <input type="password" class="form-control" value="" name="password">
                </div>
                <div class="form-group">
                    <label for="InputPasswordConfirm">密码</label>
                    <input type="password" class="form-control" value="" name="password_confirmation">
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="提交">
                </div>
            </form>
        </div>

    </div>
    @else
        <div class="col-md-offset-4 col-md-4 text-center">
            不能修改其他用户的信息
        </div>
    @endif
@endsection