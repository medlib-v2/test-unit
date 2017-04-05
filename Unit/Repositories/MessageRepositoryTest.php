<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Medlib\Models\Message;
use Medlib\Models\Conversation;
use Laracasts\TestDummy\Factory;
use Illuminate\Database\Eloquent\Collection;
use Medlib\Repositories\Message\EloquentMessageRepository;


class MessageRepositoryTest extends TestCase
{
    /**
     * @var \Medlib\Repositories\Message\EloquentMessageRepository
     */
    protected static $messageRepository;


    /**
     * Set up the environment of test
     */
    public function setUp()
    {
        parent::setUp();
        self::$messageRepository = new EloquentMessageRepository;
    }

    public function tearDown()
    {
        parent::tearDown();
        self::$messageRepository = null;
    }

    public function testFindByidReTurnsMessageInstance()
    {
        $message = Factory::create(Message::class);
        $response = self::$messageRepository->findById($message->id);

        $this->assertInstanceOf(Message::class, $response);
    }

    public function testFindByIdWithResponsesReturnsCollection()
    {
        Factory::create(Conversation::class);
        Factory::create(Message::class);

        $message = Message::first();

        $response = self::$messageRepository->findByIdWithMessageResponses($message->id);

        $this->assertInstanceOf(Collection::class, $response);
    }
}