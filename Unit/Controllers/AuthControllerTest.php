<?php

namespace Tests\Unit\Controllers;

use Faker;
use Tests\TestCase;
use Medlib\Models\User;
use Illuminate\View\View;
use Laracasts\TestDummy\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Medlib\Http\Requests\RegisterUserRequest;
use Medlib\Http\Requests\CreateSessionRequest;
use Medlib\Http\Controllers\Auth\AuthController;

class AuthControllerTest extends TestCase
{

    /**
     * @var \Medlib\Http\Controllers\Auth\AuthController
     */
    protected $authController;

    /**
     * @var \Medlib\Models\User
     */
    protected $currentUser;

    /**
     * Set up the environment of test
     */
    public function setUp()
    {
        parent::setUp();
        $this->currentUser = Factory::create(User::class);
        $this->authController = new AuthController;
    }

    public function tearDown()
    {
        Auth::logout();
        parent::tearDown();
        $this->authController = null;
    }

    /**
     * @test if instance return equal to JsonResponse
     */
    public function testLogInUserReturnsJsonResponseInstance()
    {
        $request = new CreateSessionRequest(['email' => $this->currentUser->getEmail(), 'password' => $this->currentUser->password]);

        $request->setLaravelSession($this->manager->driver());
        $request->session()->put('something', []);

        $response =  $this->authController->doLogin($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * @test if user is logged and the instance return equal to JsonResponse
     */
    public function testLogInUserReturnsJsonResponseInstanceLoginWrong()
    {
        $request = new CreateSessionRequest(['email' => 'jon@example.com', 'password' => 'secret1983']);
        $request->setLaravelSession($this->manager->driver());
        $request->session()->put('something', []);

        $response =  $this->authController->doLogin($request);

        $this->assertFalse(Auth::check());

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * @test if logout and the instance return equal to JsonResponse
     */
    public function testLogoutUserReturnsJsonResponseInstance()
    {
        Auth::login($this->currentUser);

        $response =  $this->authController->doLogout();

        $this->assertFalse(Auth::check());

        $this->assertInstanceOf(JsonResponse::class, $response);
    }


    public function testShowRegisterReturnsViewInstance()
    {
        $response = $this->authController->showRegister();
        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * @test if logout and the instance return equal to JsonResponse
     */
    public function testRegistrationUserReturnsJsonResponseInstance()
    {
        $faker = Faker\Factory::create('fr_FR');
        $email = $faker->unique()->email;
        $username = $faker->unique()->username;
        $password = 'secret_1985';

        $request = RegisterUserRequest::create(route('auth.register.submit'), 'GET', [], [], ['profileimage' => $this->getUploadedFile()]);

        $request->merge([
            'email' => $email,
            'email_confirm' => $email,
            'username' => $username,
            'password' => $password,
            'password_confirm' => $password,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'gender' => $faker->randomElement(['male','female']),
            'year' => 1983,
            'month' => 8,
            'day' => 25,
        ]);

        $response =  $this->authController->doRegister($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
