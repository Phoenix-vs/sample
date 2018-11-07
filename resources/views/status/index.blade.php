@extends('layouts.app')

@section('content')
@if(Auth::check())
<div class="col-md-offset-2 col-md-8">
    <form action="{{ route('statuses.store') }}" method="post">
        {{ csrf_field() }}

        <textarea name="content" id="" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
        <input type="submit" class="btn btn-primary" value="发布">
    </form>
</div>
@endif
<div class="col-md-offset-2 col-md-8">
    <table class="table table-bordered table-responsive">
        <th>用户id</th>
        <th>用户头像</th>
        <th>微博内容</th>
        <th>发布时间</th>
        @foreach($statuses as $status)
            <tr>
                <td>{{ $status->user->id }}</td>
                <td><img src="{{ $status->user->gravatar() }}" alt=""></td>
                <td>{{ $status->content }}</td>
                <td>{{ $status->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
    </table>
    {!! $statuses->render() !!}
</div>
@endsection