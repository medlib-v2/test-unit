<?php

$factory(Medlib\Models\Timeline::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'name'     => $faker->name,
        'type'    => 'user',
        'avatar_id' => $faker->numberBetween($min = 1, $max = 80),
        'cover_id' => $faker->numberBetween($min = 1, $max = 80),
        'cover_position' => ''
    ];
});

$factory(Medlib\Models\User::class, function (Faker\Generator $faker) {
  $email = $faker->unique()->email;

  return [
      'timeline_id' => 'factory:Medlib\Models\Timeline',
      'email' => $email,
      'username' => $faker->unique()->username,
      'password' => bcrypt("secret1983"),
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastName,
      'profession' => $faker->randomElement(['student','researcher', 'teacher']),
      'date_of_birth' => $faker->date,
      'gender' => $faker->randomElement(['male','female']),
      'activated' => true,
      'account_type' => false,
      'remember_token' => str_random(32)
  ];
});

$factory(Medlib\Models\Feed::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 'factory:Medlib\Models\User',
        'timeline_id' => 'factory:Medlib\Models\Timeline',
        'body' => $faker->text,
        'location'    => $faker->country,
        'type'        => $faker->randomElement($array = ['text', 'photo', 'music', 'video', 'location']),
        /**
        'poster_username'  => $faker->username,
        'poster_profile_image'  => $faker->imageUrl($width = 180, $height = 180),
        'image_url'  => $faker->imageUrl($width = 180, $height = 180),
        'video_url'  => "https://www.youtube.com/watch?v=jpdD87aLkUY",
        'location' => $faker->latitude.",".$faker->longitude,
         */

    ];
});

$factory(Medlib\Models\FriendRequest::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'requester_id'  => $faker->numberBetween($min = 2, $max = 30)
    ];
});

$factory(Medlib\Models\Conversation::class, function (Faker\Generator $faker) {
    return [
        'sender_id' => 'factory:Medlib\Models\User',
        'receiver_id' => 'factory:Medlib\Models\User',
    ];
});

$factory(Medlib\Models\Message::class, function (Faker\Generator $faker) {

    return [
        'body'  => $faker->sentence(),
        'sender_id' => 'factory:Medlib\Models\User',
        'receiver_id' => 'factory:Medlib\Models\User',
        'conversation_id' => 'factory:Medlib\Models\Conversation',
    ];
});
