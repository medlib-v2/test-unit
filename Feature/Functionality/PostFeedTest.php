<?php

namespace Tests\Feature\Functionality;

use Medlib\Models\Timeline;
use Medlib\Models\User;
use Tests\BrowserKitTestCase;
use Laracasts\TestDummy\Factory;

class PostFeedTest extends BrowserKitTestCase
{

    /**
     * @test if a feed has been published
     * @return void
     */
    public function testSuccessfulPostFeed()
    {
        $currentUser = Factory::create(User::class);
        $timeline = Factory::create(Timeline::class);

        $this->postAsUser(
            route('user.feeds.store', ['username' => $currentUser->getUsername()]),
            [
                'user_id'     => $currentUser->id,
                'timeline_id' => $timeline->id,
                'body' => 'New post',
                'type' => 'text',
                'user_tags' => ''
            ],
            $currentUser
        )->seeJsonStructure([
            'success',
            'data' => [
                'post' => [
                    'id',
                    'user_id',
                    'timeline_id',
                    'body',
                    'type',
                    'updated_at',
                    'created_at',
                ]
            ],
            'status_code'
        ]);

        $feedCount =  $currentUser->feeds()->count();

        $this->assertEquals(1, $feedCount);
    }
}
