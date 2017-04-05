<?php

namespace Tests\Feature\Functionality;

use Tests\TestCase;
use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;

class FriendRequestTest extends TestCase
{

    /**
     * @test if a friend was accepted the friend request
     * @return void
     */
    public function testAddNewFriendRequest()
    {
        $currentUser = Factory::create(User::class);
        $otherUser = Factory::create(User::class);

        Auth::login($currentUser);

        $response = $this->post(route('request.post'), ['username' => $otherUser->getUsername()]);

        $response->assertJson([
            "success" => true,
            "data" => [
                "message" => "Friend request submitted"
            ],
            "status_code" => 200
        ]);
        $response->assertStatus(200);
    }
}
