<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Medlib\Events\FriendRequestWasSent;

class SendEmailFriendRequestTest extends TestCase {

    public function testHandleReturnsTrueAfterFriendRequestWasSent() {

        $requesterUser = Factory::create(User::class);
        $requestedUser = Factory::create(User::class);

        $response =  event(new FriendRequestWasSent($requestedUser, $requesterUser));
        dd($response);
        $this->assertTrue($response[0]);
    }
}