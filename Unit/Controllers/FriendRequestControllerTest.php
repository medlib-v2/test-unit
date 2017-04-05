<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Medlib\Models\User;
use Illuminate\View\View;
use Medlib\Models\FriendRequest;
use Laracasts\TestDummy\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Medlib\Http\Requests\FriendUserRequest;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Http\Controllers\Friends\FriendRequestController;
use Medlib\Repositories\FriendRequest\EloquentFriendRequestRepository;

class FriendRequestControllerTest extends TestCase
{
    /**
     * @var \Medlib\Http\Controllers\Friends\FriendRequestController
     */
    protected static $friendRequestController;
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
        self::$friendRequestController = new FriendRequestController;
    }

    /**
     * unset all variables and logout after test down
     */
    public function tearDown()
    {
        Auth::logout();
        parent::tearDown();
        $this->artisanMigrateReset();
        self::$friendRequestController = null;
    }

    public function testStoreReturnsJsonResponseInstance()
    {
        $otherUser = Factory::create(User::class);

        $request = new FriendUserRequest(['username' => $otherUser->username]);
        $response = self::$friendRequestController->store($request);

        $this->assertEquals(1, $otherUser->friendRequests()->count());
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testIndexReturnsJsonResponseInstance()
    {
        Factory::times(25)->create(FriendRequest::class, ['user_id' => self::$currentUser->id]);

        $friendRequestRepository = new EloquentFriendRequestRepository;
        $userRepository = new EloquentUserRepository;
        $response = self::$friendRequestController->index($friendRequestRepository, $userRepository);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
