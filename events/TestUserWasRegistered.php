<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Medlib\Events\UserWasRegistered;

class TestUserWasRegistered extends TestCase
{
	public function testUserObjectExistinClass()
	{
		$user = Factory::create(User::class);

		$event = new UserWasRegistered($user);

		$this->assertEquals($user->firstname, $event->user->firstname);
		
	}
}