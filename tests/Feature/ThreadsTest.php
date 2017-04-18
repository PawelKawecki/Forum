<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_can_browse_tests()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get('/threads');

        $response->assertSee($thread->body);
    }

    public function test_user_can_see_specific_thread()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get("/threads/$thread->id");

        $response->assertSee($thread->body);
    }
}
