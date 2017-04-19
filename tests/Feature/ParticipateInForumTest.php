<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    public function test_an_unauthenticated_user_may_not_participate_in_forum_threads()
    {
        $this->expectException(AuthenticationException::class);

        $this->post('threads/1/replies', []);
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Thread::class);

        $this->post("threads/$thread->id/replies", $reply->toArray());

        $this->get("threads/$thread->id")->assertSee($reply->body);
    }

}
