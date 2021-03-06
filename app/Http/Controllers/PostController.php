<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    // use this to set authentication for some routes
    public function __construct()
    {
        // if user is not authenticated the user is prompt to login or create an account.
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

        return view(
            'post.index',
            [
                'posts' => BlogPost::latestWithRelations()->get(),
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
        $this->authorize('create');
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
        $validated['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validated);
        // $post = new BlogPost();
        // $post->title = $validated['title'];
        // $post->content = $validated['content'];
        // $post->save();

        // how to save files
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            $blogPost->image()->save(
                Image::create(['path' => $path])
            );
            // dump($file);
            // dump($file->getClientMimeType());
            // dump($file->getClientOriginalExtension());

            // dump($file->store('thumbnails'));
            // $name1 = $file->storeAs('thumbnails', $blogPost->id . '.' . $file->guessClientExtension());
            // dump(Storage::url($name1));
        }

        $request->session()->flash('status', 'Blog Post has been created');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
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
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", now()->addMinutes(60), function () use ($id) {
            return BlogPost::with('comments', 'tags', 'user', 'comments.user')
                ->findOrFail($id);
        });

        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::tags(['blog-post'])->get($usersKey, []);;
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;

        Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);
        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return view('post.show', [
            'post' => $blogPost,
            'counter' => $counter,
        ]);

        // return view('post.show', [
        //     'post' => BlogPost::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id)
        // ]);
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
        $post = BlogPost::findOrFail($id);

        $this->authorize('update', $post);

        return view('post.edit', ['post' => $post]);
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

        // if(Gate::denies('update-post', $post)) {
        //     abort(403, "You can't edit this blog post, you are not authorized to.");
        // }

        $this->authorize('update', $post);

        $validated = $request->validated();
        $post->fill($validated);

        // how to save files
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::create(['path' => $path])
                );
            }
            // dump($file);
            // dump($file->getClientMimeType());
            // dump($file->getClientOriginalExtension());

            // dump($file->store('thumbnails'));
            // $name1 = $file->storeAs('thumbnails', $blogPost->id . '.' . $file->guessClientExtension());
            // dump(Storage::url($name1));
        }

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

        // if(Gate::denies('delete-post', $post)) {
        //     abort(403, "You can't delete this blog post, you are not authorized to.");
        // }


        // $this->authorize('delete', $post);

        // or

        $this->authorize($post);

        $post->delete();

        session()->flash('status', 'Blog post has been deleted');
        return redirect()->route('posts.index');
    }
}
