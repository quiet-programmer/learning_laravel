@extends('layouts.app')

@section('title', 'Blog Posts')


@section('content')
<div class="row">
    <div class="col-8">
        @forelse ($posts as $key => $post)
        {{-- @break($key == 2) --}}
        {{-- @continue($key == 1) --}}
        @include('post.partials.post')
        @empty
        <div>
            No Post found.
        </div>
        @endforelse
    </div>

    <div class="col-4">
        @include('post.partials._activity')
    </div>
</div>
@endsection