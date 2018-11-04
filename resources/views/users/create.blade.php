@extends('layouts.app')
@section('content')
<div class="container" style="border:1px solid greenyellow">

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($user))
        <div class="alert alert-success">
            注册成功！
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <div class="col-md-2">
                <label for="InputName">UserName</label>
            </div>
            <input type="text" name="name" placeholder="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <div class="col-md-2 ">
                <label for="InputEmail">E-mail</label>
            </div>
            <input type="email" id="InputEmail" placeholder="email" name="email">
        </div>
        <div class="form-group">
            <div class="col-md-2 ">
                <label for="InputPassword">Password</label>
            </div>
            <input type="password" id="InputPassword" placeholder="password" name="password">
        </div>
        <div class="form-group">
            <div class="col-md-2 ">
                <label for="InputPassword">Password Verify</label>
            </div>
            <input type="password" id="InputPassword" placeholder="password" name="password_confirmation">
        </div>
        <div class="col-md-2">
            <input type="submit" value="注册">
        </div>
    </form>
</div>
@endsection
