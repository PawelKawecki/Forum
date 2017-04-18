<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_browse_tests()
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->body);
    }

    public function test_user_can_see_specific_thread()
    {
        $response = $this->get("/threads/{$this->thread->id}");

        $response->assertSee($this->thread->body);
    }

    public function test_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);

        $response = $this->get("/threads/{$this->thread->id}");

        $response->assertSee($reply->body);
    }
}
