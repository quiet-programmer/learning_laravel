<?php

namespace App\Providers;

use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user) {
            return $user->is_admin;
        });

        // returns true or false
        // Gate::define('update-post', function($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        // Gate::define('delete-post', function($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        // Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');
        // Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');

        // Gate::resource('posts', 'App\Policies\BlogPostPolicy');
        // you get -> posts.create, posts.view, posts.update, post.delete

        // overriding permissions
        Gate::before(function($user, $ability) {
            if($user->is_admin && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        });

        // Gate::after(function($user, $ability, $result) {
        //     if($user->is_admin && in_array($ability, ['update-post'])) {
        //         return true;
        //     }
        // });
    }
}
