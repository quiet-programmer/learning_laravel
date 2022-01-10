@extends('layouts.app')

@section('title', 'Blog Posts')


@section('content')
    @forelse ($posts as $key => $post)
        {{--  @break($key == 2)  --}}
        {{--  @continue($key == 1)  --}}
        @include('post.partials.post')
    @empty
        <div>
            No Post found.
        </div>
    @endforelse
@endsection