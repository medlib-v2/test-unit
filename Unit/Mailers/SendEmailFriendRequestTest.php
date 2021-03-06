<?php

namespace Tests\Unit\Mailers;

use Tests\TestCase;
use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Medlib\Events\FriendRequestWasSent;

class SendEmailFriendRequestTest extends TestCase
{

    /**
     * @test if an email has been sent after a friend request
     */
    public function testHandleReturnsTrueAfterFriendRequestWasSent()
    {
        $requesterUser = Factory::create(User::class);
        $requestedUser = Factory::create(User::class);

        $response =  event(new FriendRequestWasSent($requestedUser, $requesterUser));
        
        $this->assertTrue($response[0]);
    }
}
