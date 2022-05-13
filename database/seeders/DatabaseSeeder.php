<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        if($this->command->confirm('Do you want to refresh the Database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed.');
        }

        Cache::tags(['blog-post'])->flush();

        $this->call([
            UsersTableSeeder::class, 
            BlogPostsTableSeeder::class, 
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
            BlogPostTagTableSeeder::class,
        ]);
    }
}
