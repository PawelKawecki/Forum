<?php

namespace Tests\Feature;

use App\Channel;
use App\Thread;
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
        $thread = make(Thread::class);

        $this->post('threads', $thread->toArray());

        $this->get($thread->path() . '1')
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_valid_channel()
    {
        $channels = factory(Channel::class, 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 123])
            ->assertSessionHasErrors('channel_id');
    }

    private function publishThread($overrides)
    {
        $this->signIn();

        $thread = make(Thread::class, $overrides);

        return $this->post('threads', $thread->toArray());
    }
}
