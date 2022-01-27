<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // this is used to fetch all the data from the database
    public function index()
    {
        // DB::enableQueryLog();
        // $posts = BlogPost::with('comments')->get();

        // foreach($posts as $post) {
        //     foreach($post->comments as $comment) {
        //         echo $comment->content;
        //     }
        // }

        // dd(DB::getQueryLog());
        return view(
            'post.index', 
            [
                'posts' => BlogPost::withCount('comments')->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // routing the  user to the create form page
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // this is use to store or save data in the database
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $post = BlogPost::create($validated);
        // $post = new BlogPost();
        // $post->title = $validated['title'];
        // $post->content = $validated['content'];
        // $post->save();

        $request->session()->flash('status', 'Blog Post has been created');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // this can be used to fetch a particular data from the database
    public function show($id)
    {
        return view('post.show', ['post' => BlogPost::with('comments')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // routing users to edit form page
    public function edit($id)
    {
        return view('post.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // for updating data in database
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        $request->session()->flash('status', 'Post updated successfully!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // for deleting data from database
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        session()->flash('status', 'Blog post has been deleted');
        return redirect()->route('posts.index');
    }
}
