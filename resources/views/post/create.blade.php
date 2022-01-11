@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    @include('post.partials.form')
    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Create">
    </div>
</form>
@endsection