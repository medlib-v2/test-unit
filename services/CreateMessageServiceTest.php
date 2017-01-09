<?php

namespace Medlib\Tests\Services;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Medlib\Services\CreateMessageService;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Repositories\Message\EloquentMessageRepository;


class CreateMessageServiceTest extends TestCase
{
    public function testHandleReturnsTrue()
    {
        $faker = Faker::create();

        $user = Factory::create(User::class);

        $userRepository = new EloquentUserRepository;
        $messageRepository = new EloquentMessageRepository;

        $request = new Request([
            'receiver_id' => $user->id,
            'body' => $faker->sentence,
            'sender_id' => $faker->randomDigit,
            'sender_profile_image' => $faker->imageUrl($width = 180, $height = 180),
            'sender_name' => $faker->name
        ]);
        $service = new CreateMessageService($request);

        $response = $service->handle($userRepository, $messageRepository);

        $this->assertTrue($response);
    }
}