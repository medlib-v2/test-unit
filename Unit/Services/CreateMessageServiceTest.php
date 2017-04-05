<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Medlib\Models\User;
use Medlib\Models\Message;
use Medlib\Models\Conversation;
use Laracasts\TestDummy\Factory;
use Medlib\Services\CreateMessageService;
use Medlib\Http\Requests\CreateMessageRequest;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Repositories\Message\EloquentMessageRepository;


class CreateMessageServiceTest extends TestCase
{
    public function testHandleReturnsTrue()
    {
        $sender = Factory::create(User::class);
        $receiver = Factory::create(User::class);

        $conversation = Factory::create(Conversation::class);

        $userRepository = new EloquentUserRepository;
        $messageRepository = new EloquentMessageRepository;

        $request = new CreateMessageRequest([
            'body' => 'This is the new message to you.',
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'conversation_id' => $conversation->id,
        ]);

        $service = new CreateMessageService($request);

        $response = $service->handle($userRepository, $messageRepository);

        $this->assertInstanceOf(Message::class, $response);
    }
}