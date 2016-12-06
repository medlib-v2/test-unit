<?php

namespace Medlib\Tests\Controllers;

use Medlib\Models\User;
use Illuminate\View\View;
use Medlib\Tests\TestCase;
use Illuminate\Http\Request;
use Medlib\Models\FriendRequest;
use Laracasts\TestDummy\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Http\Controllers\Friends\FriendRequestController;
use Medlib\Repositories\FriendRequest\EloquentFriendRequestRepository;

class FriendRequestControllerTest extends TestCase
{
	/**
	 * Logout after test down
	 */
	public static function tearDownAfterClass()
	{
		Auth::logout();
	}

	public function testStoreReturnsJsonResponseInstance()
	{
		$currentUser = Factory::create(User::class);

		$otherUser = Factory::create(User::class);

		Auth::login($currentUser);

		$request = new Request(['username' => $otherUser->username]);

		$friendRequestController = new FriendRequestController($currentUser);

		$response = $friendRequestController->store($request);
		
		$this->assertEquals(1, $otherUser->friendRequests()->count());

		$this->assertInstanceOf(JsonResponse::class, $response);

	}

	public function testIndexReturnsViewInstance()
	{
		$user = Factory::create(User::class);

		$friendRequests = Factory::times(25)->create(FriendRequest::class, ['user_id' => $user->id]);

		Auth::login($user);

		$friendRequestController = new FriendRequestController($user);

		$friendRequestRepository = new EloquentFriendRequestRepository;

		$userRepository = new EloquentUserRepository;

		$response = $friendRequestController->index($friendRequestRepository, $userRepository);

		$this->assertInstanceOf(View::class, $response);

	}
}