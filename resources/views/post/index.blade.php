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
        <div class="container">
            <div class="row">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h5 class="card-title">Most Commented</h5>
                        <h6 class="card-subtitle">
                            What people are currently talking about.
                        </h6>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach ($mostCommented as $post)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                {{ $post->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h5 class="card-title">Most Active</h5>
                        <h6 class="card-subtitle">
                            Users with most post written
                        </h6>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach ($mostActive as $user)
                        <li class="list-group-item">
                            {{ $user->name }}
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <div class="row mt-4">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h5 class="card-title">Most Active Last Month</h5>
                        <h6 class="card-subtitle">
                            Users with most post written last month
                        </h6>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach ($mostActiveLastMonth as $user)
                        <li class="list-group-item">
                            {{ $user->name }}
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection