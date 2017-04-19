<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
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

    public function test_a_user_can_create_new_thread()
    {
        $this->actingAs(factory(User::class)->create());

        $thread = factory(Thread::class)->make();

        $this->post('threads', $thread->toArray());

        $this->get("threads/$thread->id")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
