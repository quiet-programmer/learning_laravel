@extends('layouts.app')

@section('title', 'Update Post')

@section('content')
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('post.partials._form')
    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Update">
    </div>
</form>
@endsection