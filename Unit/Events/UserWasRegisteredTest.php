<?php

namespace Tests\Unit\Events;

use Tests\TestCase;
use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Medlib\Events\UserWasRegistered;

class UserWasRegisteredTest extends TestCase
{
    public function testUserObjectExistInClass()
    {
        $user = Factory::create(User::class);
        $event = new UserWasRegistered($user);

        $this->assertEquals($user->firstname, $event->user->firstname);
    }
}
