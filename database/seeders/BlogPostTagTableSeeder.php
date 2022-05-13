<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if(0 === $tagCount) {
            $this->command->info('No tags found, skipping assigning tags to blog post');
            return;
        }

        $howManyMin = (int)$this->command->ask('Hom many minimum tags on blog post?', 0);
        $howManyMax = min((int)$this->command->ask('Hom many maximum tags on blog post?', $tagCount), $tagCount);

        BlogPost::all()->each(function (BlogPost $blogPost) use($howManyMin, $howManyMax) {
            $take = random_int($howManyMin, $howManyMax);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $blogPost->tags()->sync($tags);
        });

    }
}
