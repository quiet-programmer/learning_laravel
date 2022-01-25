@extends('layouts.app')

@section('title', $post->title)


@section('content')
{{-- @if ($post['is_new'])
<div>
    <h3>A new Blog Post using If</h3>
</div>
@else
<div>
    <h3>An old Blog Post using If</h3>
</div>
@endif --}}
<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
<p>Added {{ $post->created_at->diffForHumans() }}</p>

@if(now()->diffInMinutes($post->created_at) < 5) <div class="alert alert-info">New!</div>
    @endif

    <h4>Comments</h4>
    <hr>
    @forelse($post->comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <p class="text-muted">
        added {{ $comment->created_at->diffForHumans() }}
    </p>
    <hr>
    @empty
    <p>No Comments</p>
    @endforelse

    @endsection