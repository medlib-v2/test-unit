<?php

namespace Medlib\Tests\Controllers;

use Medlib\Models\User;
use Illuminate\View\View;
use Medlib\Tests\TestCase;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
	protected  static $currentUser;

	/**
	 * set up the environment of test
	 */
	public static function setUpBeforeClass() {

		self::$currentUser = Factory::create(User::class);
		Auth::login(self::$currentUser);
		self::$friendController = new FriendController(self::$currentUser);
	}

	/**
	 * unset all variables and logout after test down
	 */
	public static function tearDownAfterClass() {

		Auth::logout();
		self::$friendController = null;
		self::$currentUser = null;
	}

	public function testIndexReturnsViewInstance() {

		$users = Factory::times(5)->create(User::class);

		Auth::login(self::$currentUser);

		$friendController = new FriendController(self::$currentUser);

		$userRepository = new EloquentUserRepository;

		$response = $friendController->index($userRepository);

		$this->assertInstanceOf(View::class, $response);

	}

	public function testStoreReturnsJsonResponseInstance() {

		$user = Factory::create(User::class);

		Auth::login(self::$currentUser);

		$controller = new FriendController(self::$currentUser);

		$repository = new EloquentUserRepository;

		$request = new Request(['username' => $user->getUsername()]);

		$response = $controller->store($request, $repository);

		$this->assertInstanceOf(JsonResponse::class, $response);

	}

	public function testDestroyReturnsJsonResponseInstance() {

		$user = Factory::create(User::class);

		Auth::login(self::$currentUser);

		$controller = new FriendController(self::$currentUser);

		$request = new Request(['username' => $user->getUsername()]);
		
		$response = $controller->destroy($request);

		$this->assertInstanceOf(JsonResponse::class, $response);

	}
}