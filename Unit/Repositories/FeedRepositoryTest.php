<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Medlib\Models\User;
use Medlib\Models\Feed;
use Laracasts\TestDummy\Factory;
use Medlib\Repositories\Feed\EloquentFeedRepository;


class FeedRepositoryTest extends TestCase
{
    /**
     * @var \Medlib\Repositories\Feed\EloquentFeedRepository
     */
    protected static $repository;

    /**
     * Set up the environment of test
     */
    public static function setUpBeforeClass()
    {
        self::$repository = new EloquentFeedRepository;
    }

    public static function tearDownAfterClass()
    {
        self::$repository = null;
    }

    public function testGetPublishedByUserAndFriendsReturnArrayWithResults()
    {
        $user = Factory::create(User::class);
        Factory::times(20)->create(Feed::class, ['user_id' => $user->id]);

        $feedCount = self::$repository->getPublishedByUserAndFriends($user);
        $this->assertEquals(15, count($feedCount));
    }

    public function testGetPublishedByUserReturnArrayWithResults()
    {
        $user = Factory::create(User::class);
        Factory::times(20)->create(Feed::class, ['user_id' => $user->id]);

        $feedCount = self::$repository->getPublishedByUser($user);
        $this->assertEquals(8, count($feedCount));
    }

    public function testGetPublishedByUserAndFriendsAjaxReturnArrayWithResults()
    {
        $user = Factory::create(User::class);
        Factory::times(20)->create(Feed::class, ['user_id' => $user->id]);

        $feedCount = self::$repository->getPublishedByUserAndFriends($user);
        $this->assertEquals(15, count($feedCount));
    }
}