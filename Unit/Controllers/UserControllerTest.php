<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Medlib\Models\User;
use Illuminate\Http\JsonResponse;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Http\Controllers\Users\UsersController;
use Medlib\Repositories\User\EloquentUserRepository;

class TestUserController extends TestCase
{
    /**
     * @var \Medlib\Http\Controllers\Users\UsersController
     */
    protected static $userController;

    /**
     * @var \Medlib\Models\User
     */
    protected static $currentUser;

    /**
     * set up the environment of test
     */
    public function setUp()
    {
        parent::setUp();

        self::$currentUser = Factory::create(User::class);
        self::$userController = new UsersController;
        Auth::login(self::$currentUser);
    }

    /**
     * unset all variables and logout after test down
     */
    public function tearDown()
    {
        Auth::logout();
        parent::tearDown();

        $this->artisanMigrateReset();
        self::$userController = null;
    }

    /**
     *
     */
    public function testIndexReturnsJsonResponseInstance()
    {
        $userRepository = new EloquentUserRepository;
        $response = self::$userController->index(self::$currentUser->getUsername(), $userRepository);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     *
     */
    public function testShowReturnsJsonResponseInstance()
    {
        $otherUser = Factory::create(User::class);

        $userRepository = new EloquentUserRepository;
        $response = self::$userController->show($otherUser->username, $userRepository);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}