<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Medlib\Models\Feed;
use Medlib\Models\User;
use Medlib\Models\Timeline;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Services\CreateFeedService;
use Medlib\Http\Requests\CreateFeedRequest;

class CreateFeedServiceTest extends TestCase
{
    public function testHandleReturnsTheNewlyCreatedFeed()
    {
        $currentUser = Factory::create(User::class);

        Auth::login($currentUser);

        $request = new CreateFeedRequest([
            'user_id' => $currentUser->id,
            'timeline_id' => $currentUser->timeline_id,
            'body'    => 'This is the feed body',
            'type' => 'image'
        ]);
        $createFeedService = new CreateFeedService($request);
        $response = $createFeedService->handle();

        $this->assertInstanceOf(Feed::class, $response['post']);
        $this->assertInstanceOf(Timeline::class, $response['timeline']);
    }
}