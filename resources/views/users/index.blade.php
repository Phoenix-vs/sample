@extends('layouts.app')

@section('content')

    <!--{{ $isAdmin = Auth::user()->is_admin }}-->

        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>用户列表</h5>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <th>头像</th>
                    <th>用户ID</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    @if($isAdmin)
                        <th>操作</th>
                    @endif
                    @if(count($users) >0)
                        @foreach($users as $user)
                        <tr class="info">
                            <td><img src="{{ $user->gravatar() }}" alt=""></td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if($isAdmin)
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <input type="submit" class="btn btn-danger" value="删除">
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    @endif
                </table>
                {!! $users->render() !!}
            </div>
        </div>


@endsection