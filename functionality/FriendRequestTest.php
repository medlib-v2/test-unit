<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;

class FriendRequestTest extends TestCase {

	/**
	 * @test if a friend was accepted the friend request
	 * @return void
	 */
	public function testAddNewFriendRequest() {

		$currentUser = Factory::create(User::class);

		$otherUser = Factory::create(User::class);

		Auth::login($currentUser);

		$this->visit('u/'.$otherUser->getUsername())
		->click('Ajouter de la liste d’amis');

		$this->assertResponseOk();
	}
}
