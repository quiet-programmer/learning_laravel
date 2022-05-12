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
<h1>
    {{ $post->title }}
        {{-- using component with slots --}}
        @badge(['type' => 'primary', 'show' => now()->diffInMinutes($post->created_at) < 50])
            New Post!!
        @endbadge
</h1>
<p>{{ $post->content }}</p>
@updated(['date' => $post->created_at, 'name' => $post->user->name])
@endupdated
@updated(['date' => $post->updated_at])
Updated
@endupdated

@tags(['tags' => $post->tags])

@endtags

<p>Currently read by {{ $counter }} people.</p>

    <h4>Comments</h4>
    <hr>
    @forelse($post->comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <p class="text-muted">
        @updated(['date' => $comment->created_at])
        @endupdated
    </p>
    <hr>
    @empty
    <p>No Comments</p>
    @endforelse

    @endsection