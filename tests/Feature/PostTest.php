<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    public function testForWhenBlogPostIsEmpty()
    {
        // act part
        $response = $this->get('/posts');

        // arrange part
        $response->assertSeeText('No Post found.');
    }

    public function testToSeeOneBlogPost()
    {
        // Arrange 
        $post = $this->createDemoPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('Just testing now');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Just testing now',
        ]);
    }

    public function testStoreValueIsValid()
    {
        $param = [
            'title' => 'This is a Title',
            'content' => 'This is a valid content from me',
        ];

        $this->post('/posts', $param)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post has been created');
    }

    public function testThatStoringValidFailsCorrectly()
    {
        $param = [
            'title' => 'boy',
            'content' => 'no',
        ];

        $this->post('/posts', $param)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValueIsValid()
    {
        // Arrange 
        $post = $this->createDemoPost();

        $this->assertDatabaseHas('blog_posts', array($post->id => '1'));

        $params = [
            'title' => 'A new title for test',
            'content' => 'A new content for test'
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post updated successfully!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new title for test'
        ]);
    }

    public function testForDeletedPost()
    {
        $post = $this->createDemoPost();
        $this->assertDatabaseHas('blog_posts', array($post->id => '1'));

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post has been deleted');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    private function createDemoPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'Just testing now';
        $post->content = 'Just another test for updating...';
        $post->save();

        return $post;
    }
}
