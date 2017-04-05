<?php

namespace Tests\Feature\Functionality;

use Medlib\Models\User;
use Faker\Factory as Faker;
use Tests\BrowserKitTestCase;
use Laracasts\TestDummy\Factory;

class RegistrationTest extends BrowserKitTestCase
{
    /**
     * @test if the field first_name is empty
     * @return void
     */
    public function testEmptyFirstNameShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => '',
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1980',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'first_name' => ['The first Name field is required.']
        ]);
    }

    /**
     * @test if the field first_name content short charset
     * @return void
     */
    public function testFirstNameTooShortShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
         $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => 'g',
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
         ])->seeJson([
             'first_name' => [
                 'The first Name format is invalid.',
                 'The first Name must be at least 3 characters.',
             ]
         ]);
    }

    /**
     * @test if the field first_name content number
     * @return void
     */
    public function testFirstNameContainNumberShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;

        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => $faker->firstName.'12344',
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
        ])->seeJson([
            'first_name' => ['The first Name format is invalid.']
        ]);
    }

    /**
     * @test if the field last_name is empty
     * @return void
     */
    public function testLastNameEmptyShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;

        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => '',
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
        ])->seeJson([
            'last_name' => ['The last Name field is required.']
        ]);
    }

    /**
     * @test if the field last_name content short charset
     * @return void
     */
    public function testLastNameTooShortShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => 'g',
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
        ])->seeJson([
            'last_name' => [
                'The last Name format is invalid.',
                'The last Name must be at least 3 characters.'
            ]
        ]);
    }

    /**
     * @test if the field last_name content number
     * @return void
     */
    public function testLastNameContainNumberShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;

        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm'    =>    'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName.'1234',
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
        ])->seeJson([
            'last_name' => ['The last Name format is invalid.']
        ]);
    }

    /**
     * @test if the field username is empty
     * @return void
     */
    public function testEmptyNicknameShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => '',
            'password' => 'secret1983',
            'password_confirm'    =>    'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
        ])->seeJson([
            'username' => ['The nickname field is required.']
        ]);
    }

    /**
     * @test if the field username content short charset
     * @return void
     */
    public function testEmptyTooShortNicknameShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => '',
            'email_confirm' => $email,
            'username' => 'de',
            'password' => 'secret1983',
            'password_confirm' =>  'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
        ])->seeJson([
            'username' => ['The nickname must be at least 3 characters.'],
            'email' => ['The e-mail field is required.'],
            'email_confirm' => ['The confirmation E-mail and e-mail must match.']
        ]);
    }

    /**
     * @test if the field email is empty
     * @return void
     */
    public function testEmptyEmailShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => '',
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm'    =>    'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile(),
        ])->seeJson([
            'email' => ['The e-mail field is required.'],
            'email_confirm' => ['The confirmation E-mail and e-mail must match.']
        ]);
    }

    /**
     * @test if the email address exist in database
     * @return void
     */
    public function testTakenEmailShowsErrorOnSubmit()
    {
        $user = Factory::create(User::class);
        $faker = Faker::create();

        $this->post(route('auth.register.submit'), [
            'email' => $user->getEmail(),
            'email_confirm' => $user->getEmail(),
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm'	=> 	'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'	=>	$faker->dayOfMonth,
            'month' => $faker->month,
            'year'	=>	'1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            //'email' => ['The e-mail field is required.'],
            //'email_confirm' => ['The confirmation E-mail and e-mail must match.']
        ]);
    }


    /**
     * @test if the field password is empty
     * @return void
     */
    public function testEmptyPasswordShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;

        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => '',
            'password_confirm' => 'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'password' => ['The password field is required.']
        ]);
    }

    /**
     * @test if the password miss match with password_confirm
     * @return void
     */
    public function testConfirmPasswordShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;

        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm'    =>    'hello1234',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'password_confirm' => ['The password Confirmation and password must match.']
        ]);
    }

    /**
     * @test if the field password content short charset
     * @return void
     */
    public function testPasswordTooShortShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'h',
            'password_confirm' => 'hello1234',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'password' => ['The password must be at least 6 characters.'],
            'password_confirm' => ['The password Confirmation and password must match.']
        ]);
    }

    /**
     * @test if the field password_confirm is empty
     * @return void
     */
    public function testEmptyPasswordConfirmationShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm'    =>    '',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '1983',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'password_confirm' => ['The password Confirmation field is required.']
        ]);
    }

    /**
     * @test if the field year is empty
     * @return void
     */
    public function testEmptyYearShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'year' => ['The year field is required.']
        ]);
    }

    /**
     * @test if the field year is string given
     * @return void
     */
    public function testNumericYearShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm'    =>    '',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    'bab1',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'year' => ['The year must be a number.']
        ]);
    }

    /**
     * @test if the field year is string given
     * @return void
     */
    public function testYearBeforeCurrentShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '2015',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => $this->getUploadedFile()
        ])->seeJson([
            'year' => ['The year must be a date before 2002.']
        ]);
    }

    /**
     * @test if the field profileImage attached an image file
     * @return void
     */
    public function testEmptyImageShowsErrorOnSubmit()
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        $this->post(route('auth.register.submit'), [
            'email' => $email,
            'email_confirm' => $email,
            'username' => $faker->unique()->username,
            'password' => 'secret1983',
            'password_confirm' => 'secret1983',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'day'    =>    $faker->dayOfMonth,
            'month' => $faker->month,
            'year'    =>    '2015',
            'gender' => $faker->randomElement(['male','female']),
            'profileimage' => ''
        ])->seeJson([
            'profileimage' => ['The profileimage field is required.']
        ]);
    }
}
