<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;


class MessagesTest extends TestCase {

	/**
	 * @test if a message as sent to an other user
	 * @return void
	 */
	public function testSendingAmessageToAnotherUser() {

		$currentUser = Factory::create(User::class);

		$otherUser = Factory::create(User::class);

		Auth::login($currentUser);

		$this->visit('/messages/compose/'.$otherUser->getUsername())
		->submitForm('Submit', ['body' => 'This is the new message to you.'])
		->seeInDatabase('messages', ['body' => 'This is the new message to you.'])
		->seeInDatabase('message_responses', ['body' => 'This is the new message to you.']);
	}

}