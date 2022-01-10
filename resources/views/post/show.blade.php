@extends('layouts.app')

@section('title', $post['title'])


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
<h1>{{ $post['title'] }}</h1>
<p>{{ $post['content'] }}</p>
@endsection