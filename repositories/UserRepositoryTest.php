<?php

namespace Medlib\Tests\Repositories;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Repositories\User\EloquentUserRepository;

class TestUserRepository extends TestCase
{

    /**
     * @var \Medlib\Repositories\User\EloquentUserRepository
     */
    protected static $userRepository;

    /**
     * Set up the environment of test
     */
    public static function setUpBeforeClass()
    {
        self::$userRepository = new EloquentUserRepository;
    }

    public static function tearDownAfterClass()
    {
        self::$userRepository = null;
    }

    public function testGetPaginatedReturnsACollectionSuccesfully()
    {
        $currentUser = Factory::create(User::class);
        $users = Factory::times(20)->create(User::class);

        Auth::login($currentUser);

        $this->assertEquals(10, count(self::$userRepository->getPaginated()));
    }

    public function testFindManyById()
    {
        $users = Factory::times(20)->create(User::class);
        $ids = [];
        foreach ($users as $user) {

            $ids[] = $user->id;
        }
        $ids = collect($ids);

        $result = self::$userRepository->findManyById($ids);

        $this->assertEquals(20, count($result));
    }
}