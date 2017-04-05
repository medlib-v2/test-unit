<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Repositories\User\EloquentUserRepository;

class UserRepositoryTest extends TestCase
{

    /**
     * @var \Medlib\Repositories\User\EloquentUserRepository
     */
    protected static $userRepository;

    /**
     * Set up the environment of test
     */
    public function setUp()
    {
        parent::setUp();
        self::$userRepository = new EloquentUserRepository;
    }

    public function tearDown()
    {
        parent::tearDown();
        self::$userRepository = null;
    }

    public function testGetPaginatedReturnsACollectionSuccesfully()
    {
        $currentUser = Factory::create(User::class);
        Factory::times(20)->create(User::class);

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