<?php

use Medlib\Models\User;
use Medlib\Models\Feed;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Medlib\Http\Controllers\Feeds\FeedController;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Repositories\Feed\EloquentFeedRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Medlib\Repositories\Comment\EloquentCommentRepository;


class FeedControllerTest extends TestCase
{
	/**
	 * @var \Medlib\Http\Controllers\Feeds\FeedController
	 */
	protected static $feedController;

	/**
	 * @var \Medlib\Models\User
	 */
	protected  static $currentUser;

	public static function setUpBeforeClass() {
		self::$currentUser = Factory::create(User::class);
		Auth::login(self::$currentUser, true);
		self::$feedController = new FeedController();
	}

	public static function getImageFile($filename, $type = 'image/jpeg') {
		return $file = new UploadedFile( $filename, basename($filename), $type, null, null, true);
	}

	/**
	 * Unset all variables and logout after test down
	 */
	public static function tearDownAfterClass()
	{
		Auth::logout();
		self::$feedController = null;
		self::$currentUser = null;
	}

	/**
	 * @test if the instance return equal to view
	 */
	public function testIndexReturnsViewInstance() {

		$feeds = Factory::times(20)->create(Feed::class, ['user_id' => self::$currentUser->id]);

		$request = new Request(['username' => self::$currentUser->getUsername()]);

		$feedRepository = new EloquentFeedRepository;
		$userRepository = new EloquentUserRepository;
		$commentRepository = new EloquentCommentRepository();

		$response = self::$feedController->index($request->username, $feedRepository, $userRepository, $commentRepository);
		
		$this->assertInstanceOf(View::class, $response);
	}
	
	/**
	 * @test if the instance return is equal to JsonResponse
	 */
	public function testStoreReturnsJsonResponseInstance()
	{
		Auth::login(self::$currentUser);

		$request = new Request(['body' => 'Hello my friend']);

		$response = self::$feedController->store($request);
		
		$this->assertInstanceOf(JsonResponse::class, $response);
	}

	/**
	 * @test if the instance return is equal to JsonResponse
	 */
	public function testStoreFileReturnsJsonResponseInstance() {

		Auth::login(self::$currentUser);

		$file = public_path('avatars/a2.jpg');

		$fileUpload = self::getImageFile($file);

		$request = new Request(['body' => 'Hello my friend, I will be send you an image', 'image' => $fileUpload]);

		$response = self::$feedController->store($request);

		$this->assertInstanceOf(JsonResponse::class, $response);
	}

}
