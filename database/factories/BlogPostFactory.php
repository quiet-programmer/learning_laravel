<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraph(5, true)
        ];
    }

    // new way of writing test state for laravel 8
    public function defaultTitle()
    {
        return $this->state([
            'title' => 'Just testing now',
        ]);
    }
}
