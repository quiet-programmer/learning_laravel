<h3>
    @if($post->trashed())
    <del>
        @endif
        <a class="{{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('posts.show', ['post' => $post->id]) }}">{{
            $post->title }}</a>
        @if($post->trashed())
    </del>
    @endif
</h3>

<p class="text-muted">
    Added {{ $post->created_at->diffForHumans() }}
    By {{ $post->user->is_admin ? 'Admin' : $post->user->name }}
</p>

@if($post->comments_count)
<p>{{ $post->comments_count }} comments</p>
@else
<p>No comments yet!</p>
@endif

<div class="mb-3">
    @can('update', $post)
    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
    @endcan

    {{-- @cannot('delete', $post)
    <p>You cannot delete this post. Admin only</p>
    @endcannot --}}
    @if(!$post->trashed())
    @can('delete', $post)
    <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="btn btn-dark" type="submit" value="Delete">
    </form>
    @endcan
    @endif
</div>