<div>
    @auth
    <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            @error('content')
            <div style="color: red;">
                {{ $message }}
            </div>
            @enderror
            <textarea required class="form-control" name="content" cols="30" placeholder="Content"
                rows="5"></textarea>
        </div>
        <div>
            <input class="btn btn-primary btn-block" type="submit" value="Add comment">
        </div>
    </form>
    @else
    <p>
        <a href="{{ route('login') }}">Sign in to be able to post comment</a>
    </p>
    @endauth
</div>