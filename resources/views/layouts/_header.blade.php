<div class="container">
<nav class="header">
@if($user = Auth::check())


    <!--{{ $user = Auth::user() }}-->
        <div class="row">
            <div class="col-md-offset-10 col-md-2">
            <span>
                <img src="{{Auth::user()->gravatar() }}">

            </span>
                <span>
                    {{ Auth::user()->email }}----
                </span>
                <form action="{{route('logout')}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-primary" value="注销">
                </form>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"> 编辑个人资料</a>
            </div>
        </div>
@else
    <div class="col-md-2 pull-right">
        <a href="{{ route('login') }}" class="btn btn-primary">登陆</a>
    </div>
    
@endif
</nav>

