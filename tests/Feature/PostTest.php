<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
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

    public function testToSeeOneBlogPostWithNoComments()
    {
        // Arrange 
        $post = $this->createDemoPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('Just testing now');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Just testing now',
        ]);
    }

    public function testToSeeOneBlogPostWithComments()
    {
        // Arrange 
        $post = $this->createDemoPost();

        // creating model factory for comment
        Comment::factory()->count(4)->create([
            'blog_post_id' => $post->id
        ]);

        // Act
        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');
    }

    public function testStoreValueIsValid()
    {

        $param = [
            'title' => 'This is a Title',
            'content' => 'This is a valid content from me',
        ];

        $this->actingAs($this->user())->post('/posts', $param)
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

        $this->actingAs($this->user())->post('/posts', $param)
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

        $this->actingAs($this->user())->put("/posts/{$post->id}", $params)
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

        $this->actingAs($this->user())
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post has been deleted');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    // has a type of BlogPost
    private function createDemoPost(): BlogPost
    {
        // $post = new BlogPost();
        // $post->title = 'Just testing now';
        // $post->content = 'Just another test for updating...';
        // $post->save();

        return BlogPost::factory()->defaultTitle()->create();

        // return $post;
    }
}
