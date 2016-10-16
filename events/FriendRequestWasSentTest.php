<?php 

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Medlib\Events\FriendRequestWasSent;

class FriendRequestWasSentTest extends TestCase
{
	public function testBothUserObjectsExistInClass()
	{
		$requestedUser = Factory::create(User::class);

		$requesterUser = Factory::create(User::class);

		$event = new FriendRequestWasSent($requestedUser, $requesterUser);

		$this->assertEquals($requesterUser->email, $event->requesterUser->email);

		$this->assertEquals($requestedUser->email, $event->requestedUser->email);
	}

}