<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Medlib\Events\UserWasRegistered;

class SendUserMailerTest extends TestCase {

    /**
     * @test if an email has been sent with success
     */
    public function testSendingUserMailSuccess(){

        $user = Factory::create(User::class);

        $response = event(new UserWasRegistered($user));

        $this->assertTrue($response[0]);
    }
}