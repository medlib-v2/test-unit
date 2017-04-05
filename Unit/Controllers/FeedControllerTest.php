<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Medlib\Models\Feed;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Medlib\Http\Requests\CreateFeedRequest;
use Medlib\Repositories\Page\EloquentPageRepository;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Repositories\Feed\EloquentFeedRepository;
use Medlib\Http\Controllers\Timelines\FeedController;
use Medlib\Repositories\Group\EloquentGroupRepository;

class FeedControllerTest extends TestCase
{
    /**
     * @var \Medlib\Http\Controllers\Timelines\FeedController
     */
    protected $feedController;

    /**
     * @var \Medlib\Models\User
     */
    protected $currentUser;

    protected $currentTimeline;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);

        $this->currentUser = $this->getUser();
        $this->feedController = new FeedController();
        $this->currentTimeline = $this->currentUser->timeline_id;
        Auth::login($this->currentUser);
    }

    /**
     * Unset all variables and logout after test down
     */
    public function tearDown()
    {
        Auth::logout();
        parent::tearDown();
        $this->artisanMigrateReset();

        $this->feedController = null;
        $this->currentUser = null;
        $this->currentTimeline = null;
    }

    /**
     * @test if the instance return equal to view
     */
    public function testIndexReturnsJsonResponseInstance()
    {
        Factory::times(20)->create(Feed::class, [
            'user_id' => $this->currentUser->id,
            'timeline_id' => $this->currentTimeline
        ]);

        $request = new Request(['username' => $this->currentUser->getUsername()]);

        $feedRepository = new EloquentFeedRepository;
        $userRepository = new EloquentUserRepository;
        $pageRepository = new EloquentPageRepository;
        $groupRepository = new EloquentGroupRepository;

        $response = $this->feedController->index($request->username, $feedRepository, $userRepository, $pageRepository, $groupRepository);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * @test if the instance return is equal to JsonResponse
     */
    public function testStoreReturnsJsonResponseInstance()
    {
        $request = new CreateFeedRequest([
            'user_id' => $this->currentUser->id,
            'timeline_id' => $this->currentTimeline,
            'body' => 'Hello my friend',
            'type' => 'text'
        ]);

        $response = $this->feedController->store($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * @test if the instance return is equal to JsonResponse
     */
    public function testStoreFileReturnsJsonResponseInstance()
    {
        $request = new CreateFeedRequest([
            'user_id' => $this->currentUser->id,
            'timeline_id' => $this->currentTimeline,
            'body' => 'Hello my friend with images',
            'type' => 'text',
            'post_images_upload' => [
                $this->getUploadedFile(),
                $this->getUploadedFile('image_full.jpg')
            ]
        ]);

        $response = $this->feedController->store($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
