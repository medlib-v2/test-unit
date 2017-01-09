<?php

use Illuminate\Support\Facades\Hash;

$factory(Medlib\Models\User::class, function (Faker\Generator $faker) {
    return [

        'email' => $faker->unique()->email,
        'username' => $faker->unique()->username,
        'password' => Hash::make('secret1983'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'profession' => $faker->randomElement(['student','researcher', 'teacher']),
        'location' => "",
        'date_of_birth' => $faker->date,
        'gender' => $faker->randomElement(['man','woman']),
        'activated' => true,
        'account_type' => false,
        'user_avatar' => $faker->imageUrl($width = 180, $height = 180),
        'remember_token' => str_random(10)
    ];
});

$factory(Medlib\Models\Feed::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 'factory:Medlib\Models\User',
        'body' => $faker->sentence,
        'poster_username'  => $faker->username,
        'poster_profile_image'  => $faker->imageUrl($width = 180, $height = 180),
        'image_url'  => $faker->imageUrl($width = 180, $height = 180),
        'video_url'  => "https://www.youtube.com/watch?v=jpdD87aLkUY",
        'location' => $faker->latitude.",".$faker->longitude,

    ];
});

$factory(Medlib\Models\FriendRequest::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'requester_id'  => $faker->numberBetween($min = 2, $max = 30)
    ];
});

$factory(Medlib\Models\Message::class, function (Faker\Generator $faker) {
    return [
        'body'  => $faker->sentence,
        'sender_id' => $faker->randomDigit,
        'sender_name' => $faker->name,
        'sender_profile_image' => $faker->imageUrl($width = 180, $height = 180)
    ];
});

$factory(Medlib\Models\MessageResponse::class, function (Faker\Generator $faker) {
    return [
        'message_id' => 'factory:Medlib\Models\Message',
        'body'  => $faker->sentence,
        'sender_id' => $faker->randomDigit,
        'receiver_id' => $faker->randomDigit,
        'sender_name' => $faker->name,
        'sender_profile_image' => $faker->imageUrl($width = 180, $height = 180)
    ];
});
