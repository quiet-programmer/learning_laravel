<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertSeeText('Welcome to Learning Laravel');
        $response->assertSeeText('This is a tutorial I am eatching to learn how Laravel works.');
    }

    public function testContactPage()
    {
        $response = $this->get('/contacts');

        $response->assertSeeText('Contact Page');
    }
}
