<?php

namespace Medlib\Tests\Repositories;

use Medlib\Models\Message;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Medlib\Models\MessageResponse;
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
    public static function setUpBeforeClass()
    {
        self::$messageRepository = new EloquentMessageRepository;
    }

    public static function tearDownAfterClass()
    {
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
        Factory::create(MessageResponse::class);
        $message = Message::first();

        $response = self::$messageRepository->findByIdWithMessageResponses($message->id);

        $this->assertInstanceOf(Message::class, $response);
    }
}