@extends('layouts.app')

@section('title', 'Update Post')

@section('content')
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
    @csrf
    @method('PUT')
    @include('post.partials.form')
    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Update">
    </div>
</form>
@endsection