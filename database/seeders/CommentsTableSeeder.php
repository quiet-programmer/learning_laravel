<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();

        if($posts->count() <= 0) {
            $this->command->info('There no blog post, so no comments where created.');
            return;
        }

        $commentCount = (int)$this->command->ask('How many comments would you like?', 150);
        $users = User::all();
        Comment::factory()->count($commentCount)->make()->each(function($comment) use ($posts, $users) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
