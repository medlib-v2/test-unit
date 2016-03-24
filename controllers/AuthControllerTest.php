<?php

use Medlib\Models\User;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Medlib\Http\Requests\CreateSessionRequest;
use Medlib\Http\Controllers\Auth\AuthController;

class AuthControllerTest extends TestCase {

    /**
     * @var \Medlib\Http\Controllers\Auth\AuthController
     */
    protected static $authControlller;

    public static function setUpBeforeClass() {
        self::$authControlller = new AuthController();
    }

    public static function tearDownAfterClass() {
        Auth::logout();
    }

    public function testStoreReturnsRedirectResponseInstance() {

        $tempUser = Factory::create(User::class);

        $request = new CreateSessionRequest(['email' => $tempUser->email, 'password' => $tempUser->password]);

        $response =  self::$authControlller->doLogin($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);

    }


    public function testStoreReturnsRedirectResponseInstanceLoginWrong() {

        $request = new CreateSessionRequest(['email' => 'jon@example.com', 'password' => 'secret1983']);

        $response =  self::$authControlller->doLogin($request);

        $this->assertFalse(Auth::check());

        $this->assertInstanceOf(RedirectResponse::class, $response);

    }

    public function testDestroyReturnsRedirectResponseInstance() {

        $tempUser = Factory::create(User::class);

        Auth::login($tempUser);

        $request = new Request(['userId' => $tempUser->id]);

        $response =  self::$authControlller->doLogout($request);

        $this->assertFalse(Auth::check());

        $this->assertInstanceOf(RedirectResponse::class, $response);

    }
}