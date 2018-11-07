@extends('layouts.app')

@section('content')


    <form action="{{ route('statuses.store') }}">
        <textarea name="content" id="" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
        <input type="submit" class="btn btn-primary" value="发布">
    </form>

@endsection