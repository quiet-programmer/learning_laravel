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
<div class="row">
    <div class="col-8">
        <h1>
            @if($post->image)
            <img style="height: auto; width: 50%" src="{{ $post->image->url() }}" alt="Blog Post Image"> <br>
            {{-- styling background-attachment: fixed --}}
            @endif
            {{ $post->title }}
            {{-- using component with slots --}}
            @badge(['type' => 'primary', 'show' => now()->diffInMinutes($post->created_at) < 50]) New Post!! @endbadge
                </h1>
                <p>{{ $post->content }}</p>
                @tags(['tags' => $post->tags])@endtags

                @updated(['date' => $post->created_at, 'name' => $post->user->name])
                @endupdated

                @updated(['date' => $post->updated_at])
                Updated
                @endupdated

                <p>Currently read by {{ $counter }} people.</p>

                <h4>Comments</h4>
                @include('comments.partials._forms')
                <hr>
                @forelse($post->comments as $comment)
                <p>
                    {{ $comment->content }}
                </p>
                <p class="text-muted">
                    @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
                    @endupdated
                </p>
                <hr>
                @empty
                <p>No Comments</p>
                @endforelse

    </div>
    <div class="col-4">
        @include('post.partials._activity')
    </div>
</div>

@endsection