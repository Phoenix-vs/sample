@extends('layouts.app')

@section('content')
    <div class="container">
        <img src="{{ $user->gravatar() }}">
        <h3>{{ $user->name }}</h3>
    </div>
@endsection