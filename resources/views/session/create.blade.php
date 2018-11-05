@extends('layouts.app')
@section('content')
<div class="col-md-offset-4 col-md-4">
    <div class="panel panel-default">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="panel-heading">
            <h5>登陆</h5>
        </div>

        <div class="panel-body">

            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="InputEmail">邮箱</label>
                    <input type="text" name="email" value="{{ old('email') }}" id="InputEmail" class="form-control">
                </div>
                <div class="form-group">
                        <label for="InputPassword">密码</label>
                    <input type="password" name="password" value="{{ old('password') }}" id="InputPassword" class="form-control">
                </div>
                <div class="form-group">
                        <label for="RememberMe">记住我</label>
                        <input type="checkbox" checked="checked" id="RememberMe" name="remember">
                </div>
                <input type="submit" value="登陆" class="btn btn-primary" >
            </form>
            <hr>
            <p>还没有账号？点击这里<a href="{{route('signup')}}">注册</a></p>
        </div>
    </div>
</div>
@endsection

@section('subjs')
<script>
    $(function () {

    });

</script>

@endsection