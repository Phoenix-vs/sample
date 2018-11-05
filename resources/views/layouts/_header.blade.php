<div class="container">
<nav class="header">
@if($user = Auth::check())

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
            </div>
        </div>
@endif
</nav>

