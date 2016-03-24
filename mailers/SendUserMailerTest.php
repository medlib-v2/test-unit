<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Medlib\Events\UserWasRegistered;

class SendUserMailerTest extends TestCase {

    public function testSendigUserMailSuccess(){

        $user = Factory::create(User::class);
        $response = event(new UserWasRegistered($user));

        dd($response);

        $this->assertTrue($response[0]);
    }
}