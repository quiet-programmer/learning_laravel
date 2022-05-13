<p>
    @foreach ($tags as $tag)
        <a href="{{ route('post.tags.index', ['tag' => $tag->id]) }}" class="badge badge-primary badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>