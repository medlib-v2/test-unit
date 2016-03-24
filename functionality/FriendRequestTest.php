<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;

class FriendRequestTest extends TestCase {

	/**
	 * test a freind request
	 * @return void
	 */
	public function testAddNewFriendRequest() {

		$currentUser = Factory::create(User::class);

		$otherUser = Factory::create(User::class);

		Auth::login($currentUser);

		$this->visit('profiles/'.$otherUser->getUsername())
		->click('Add friend');

		$this->assertResponseOk();
	}
}