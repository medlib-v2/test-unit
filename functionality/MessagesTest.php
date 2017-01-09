<?php

namespace Medlib\Tests\Functionality;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;

class MessagesTest extends TestCase
{

    /**
     * @test if a message as sent to an other user
     * @return void
     */
    public function testSendingAMessageToAnotherUser()
    {
        $currentUser = Factory::create(User::class);
        $otherUser = Factory::create(User::class);

        Auth::login($currentUser);

        $this->visit('/messages/compose/'.$otherUser->getUsername())
        //->submitForm('Submit', ['body' => 'This is the new message to you.'])
        ->type('This is the new message to you.', 'body')
        ->press('Submit')
        ->seeJsonEquals(['response' => 'success', 'message' => 'Your message was sent.']);
        //->seeInDatabase('messages', ['body' => 'This is the new message to you.'])
        //->seeInDatabase('message_responses', ['body' => 'This is the new message to you.']);
    }
}
