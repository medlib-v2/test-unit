<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Medlib\Models\User;
use Medlib\Models\FriendRequest;
use Laracasts\TestDummy\Factory;
use Medlib\Repositories\FriendRequest\EloquentFriendRequestRepository;

class FriendRequestRepositoryTest extends TestCase
{
    /**
     * @var \Medlib\Repositories\FriendRequest\EloquentFriendRequestRepository
     */
    protected static $repository;

    /**
     * Set up the environment of test
     */
    public static function setUpBeforeClass()
    {
        self::$repository = new EloquentFriendRequestRepository;
    }

    public static function tearDownAfterClass()
    {
        self::$repository = null;
    }

    public function testGetIdsThatSentRequestToCurrentUser()
    {
        $user = Factory::create(User::class);
        $friendRequests = Factory::times(25)->create(FriendRequest::class, ['user_id' => $user->id]);
        $results = self::$repository->getIdsThatSentRequestToCurrentUser($user->id);

        $this->assertEquals(25, count($results));
    }
}
