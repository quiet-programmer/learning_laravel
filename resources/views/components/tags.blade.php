<p>
    @foreach ($tags as $tag)
        <a href="#" class="badge badge-primary badge-lg">{{ $tag->name }}</a>
    @endforeach
</p>