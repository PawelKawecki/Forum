<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{

    use DatabaseMigrations;

    public function test_guest_can_not_create_new_thread()
    {
        $this->expectException(AuthenticationException::class);

        $this->post('threads', []);
    }

    public function test_quest_can_not_see_create_thread_page()
    {
        $this->expectException(AuthenticationException::class);

        $this->get('threads/create');
    }

    public function test_a_user_can_create_new_thread()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $this->post('threads', $thread->toArray());

        $this->get("threads/$thread->id")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
