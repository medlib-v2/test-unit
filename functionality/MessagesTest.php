<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;


class MessagesTest extends TestCase
{
	public function testSendingAmessageToAnotherUser()
	{
		$currentUser = Factory::create(User::class);

		$otherUser = Factory::create(User::class);

		Auth::login($currentUser);

		$this->visit('/messages/compose/'.$otherUser->getUsername())
		->submitForm('Submit', ['body' => 'This is the new message to you.'])
		->verifyInDatabase('messages', ['body' => 'This is the new message to you.'])
		->verifyInDatabase('message_responses', ['body' => 'This is the new message to you.']);		
	}

}