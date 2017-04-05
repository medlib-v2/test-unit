<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Medlib\Models\User;
use Illuminate\View\View;
use Laracasts\TestDummy\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Medlib\Http\Requests\FriendUserRequest;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Http\Controllers\Friends\FriendController;

class FriendControllerTest extends TestCase
{
    /**
     * @var \Medlib\Http\Controllers\Friends\FriendController
     */
    protected static $friendController;

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
        Auth::login(self::$currentUser);
        self::$friendController = new FriendController(self::$currentUser);
    }

    /**
     * unset all variables and logout after test down
     */
    public function tearDown()
    {
        Auth::logout();
        parent::tearDown();
        $this->artisanMigrateReset();

        self::$friendController = null;
        self::$currentUser = null;
    }

    public function testIndexReturnsJsonResponseInstance()
    {
        Factory::times(5)->create(User::class);

        $friendController = new FriendController(self::$currentUser);

        $userRepository = new EloquentUserRepository;

        $response = $friendController->index($userRepository);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testStoreReturnsJsonResponseInstance()
    {
        $user = Factory::create(User::class);

        $controller = new FriendController(self::$currentUser);

        $request = new FriendUserRequest(['username' => $user->getUsername()]);

        $response = $controller->store($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testDestroyReturnsJsonResponseInstance()
    {
        $user = Factory::create(User::class);

        $controller = new FriendController(self::$currentUser);

        $request = new FriendUserRequest(['username' => $user->getUsername()]);

        $response = $controller->destroy($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
