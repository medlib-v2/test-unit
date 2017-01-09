<?php

namespace Medlib\Tests\Services;

use Medlib\Models\Feed;
use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Services\CreateFeedService;

class CreateFeedServiceTest extends TestCase
{
    public function testHandleReturnsTheNewlyCreatedFeed()
    {
        $currentUser = Factory::create(User::class);

        Auth::login($currentUser);

        $createFeedService = new CreateFeedService('This is the feed body', 'postername', 'http://image/sampleimage.jpg');
        $response = $createFeedService->handle();

        $this->assertInstanceOf(Feed::class, $response);
    }
}