<?php

namespace Medlib\Tests\Controllers;

use Faker;
use Medlib\Models\User;
use Illuminate\View\View;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Medlib\Http\Requests\RegisterUserRequest;
use Medlib\Http\Requests\CreateSessionRequest;
use Medlib\Http\Controllers\Auth\AuthController;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AuthControllerTest extends TestCase
{

    /**
     * @var \Medlib\Http\Controllers\Auth\AuthController
     */
    protected static $authController;

    /**
     * @var \Medlib\Models\User
     */
    protected static $currentUser;

    /**
     * Set up the environment of test
     */
    public static function setUpBeforeClass()
    {
        self::$currentUser = Factory::create(User::class);
        self::$authController = new AuthController;
    }

    public static function tearDownAfterClass()
    {
        Auth::logout();
        self::$authController = null;
    }

    /**
     * @test if instance return equal to RedirectResponse
     */
    public function testLogInUserReturnsRedirectResponseInstance()
    {
        $request = new CreateSessionRequest(['email' => self::$currentUser->email, 'password' => self::$currentUser->password]);
        $request->setSession($this->manager->driver());
        $request->session()->set('something', []);

        $response =  self::$authController->doLogin($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    /**
     * @test if user is logged and the instance return equal to RedirectResponse
     */
    public function testLogInUserReturnsRedirectResponseInstanceLoginWrong()
    {
        $request = new CreateSessionRequest(['email' => 'jon@example.com', 'password' => 'secret1983']);
        $request->setSession($this->manager->driver());
        $request->session()->set('something', []);

        $response =  self::$authController->doLogin($request);

        $this->assertFalse(Auth::check());

        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    /**
     * @test if logout and the instance return equal to RedirectResponse
     */
    public function testLogoutUserReturnsRedirectResponseInstance()
    {
        Auth::login(self::$currentUser);

        $response =  self::$authController->doLogout();

        $this->assertFalse(Auth::check());

        $this->assertInstanceOf(RedirectResponse::class, $response);
    }


    public function testShowRegisterReturnsViewInstance()
    {
        $response = self::$authController->showRegister();

        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * @test if logout and the instance return equal to RedirectResponse
     */
    public function testRegistrationUserReturnsRedirectResponseInstance()
    {
        $faker = Faker\Factory::create('fr_FR');
        $email = $faker->unique()->email;
        $username = $faker->unique()->username;
        $password = 'secret_1985';

        $uploadedFile = new UploadedFile(
            dirname(__DIR__). '/medias/fururama_img.jpg',
            'fururama_img.jpg');

        $request = RegisterUserRequest::create('/register', 'GET', [], [], ['profileimage' => $uploadedFile]);

        $request->merge([
            'email' => $email,
            'email_confirm' => $email,
            'username' => $username,
            'password' => $password,
            'password_confirm' => $password,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'profession' => $faker->randomElement(['student','researcher', 'teacher']),
            'location' => 'Paris, Ile-de-France',
            'gender' => $faker->randomElement(['man','woman']),
            'year' => 1983,
            'month' => 8,
            'day' => 25,
        ]);

        $response =  self::$authController->doRegister($request);
        
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }
}
