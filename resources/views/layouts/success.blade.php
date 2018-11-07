@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        {{--<div class="panel-heading">--}}
            {{--{{ $title }}--}}
        {{--</div>--}}
        <div class="panel-body">
            <div class="success">
                @if(is_set($success))
                {{ $success }}
                    @endif
            </div>
            <div>
            </div>
        </div>
    </div>
@endsection