<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadsThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @var Thread $thread */
    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    public function test_user_can_browse_tests()
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->body);
    }

    public function test_user_can_see_specific_thread()
    {
        $response = $this->get($this->thread->path());

        $response->assertSee($this->thread->body);
    }

    public function test_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $response = $this->get($this->thread->path());

        $response->assertSee($reply->body);
    }

    public function test_a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create(Channel::class);

        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);

        $threadNotInChannel = create(Thread::class);

        $this->get('threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    public function test_user_can_filter_threads_by_any_username()
    {
        $this->signIn($user = create(User::class, ['name' => 'JohnDoe']));

        $userThread = create(Thread::class, ['user_id' => auth()->id()]);

        $otherThread = $this->thread;

        $this->get('threads?by=JohnDoe')
            ->assertSee($userThread->title)
            ->assertDontSee($otherThread->title);
    }
}
