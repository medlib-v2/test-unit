<?php

namespace Tests\Feature\Functionality;

use Medlib\Models\User;
use Tests\BrowserKitTestCase;
use Medlib\Models\Conversation;
use Laracasts\TestDummy\Factory;

class MessagesTest extends BrowserKitTestCase
{
    /**
     * @test if a message as sent to an other user
     * @return void
     */
    public function testSendingAMessageToAnotherUser()
    {
        $currentUser = Factory::create(User::class);
        $otherUser = Factory::create(User::class);
        $conversation = Factory::create(Conversation::class);

        $this->postAsUser(route('message.store'), [
            'body' => 'This is the new message to you.',
            'sender_id' => $currentUser->id,
            'receiver_id' => $otherUser->id,
            'conversation_id' => $conversation->id
        ], $currentUser)->seeJsonStructure([
            'success',
            'data' => [
                'body',
                'sender_id',
                'receiver_id',
                'user',
                'conversation' => [
                    'id',
                    'active',
                    'archived'
                ]
            ],
            'status_code'
        ]);
    }
}
