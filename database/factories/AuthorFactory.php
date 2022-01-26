<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function createAuthor()
    {
        return $this->afterCreating(function(Author $author) {
            $author->profile()->save(Author::factory()->make());
        });
    }

    public function createAuthorMaking()
    {
        return $this->afterMaking(function(Author $author) {
            $author->profile()->save(Author::factory()->make());
        });
    }
}
