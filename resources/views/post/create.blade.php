@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div>
        <input type="text" name="title" placeholder="Title">
    </div>
    <br>
    <div>
        <textarea name="content" cols="30" placeholder="Content" rows="10"></textarea>
    </div>
    <br>
    <div>
        <input type="submit" value="Create">
    </div>
</form>
@endsection