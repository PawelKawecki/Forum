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
        $this->post('threads', [])
            ->assertRedirect('/login');
    }

    public function test_quest_can_not_see_create_thread_page()
    {
        $this->get('threads/create')
            ->assertRedirect('/login');
    }

    public function test_a_user_can_create_new_thread()
    {
        $this->signIn();

        /** @var Thread $thread */
        $thread = create(Thread::class);

        $this->post('threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
