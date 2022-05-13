<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class PostTagController extends Controller
{
    public function index($tag)
    {
        $tag = Tag::findOrFail($tag);

        return view('post.index', [
            'posts' => $tag->blogPosts,
        ],);
    }
}
