<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Illuminate\View\View;
use Medlib\Http\Controllers\Auth\AuthController;

class RegistrationControllerTest extends TestCase
{
    /**
     * @var \Medlib\Http\Controllers\Auth\AuthController
     */
    protected static $registrationController;

    /**
     * Set up the environment of test
     */
    public static function setUpBeforeClass()
    {
        self::$registrationController = new AuthController;
    }

    /**
     * unset the $registrationController
     */
    public static function tearDownAfterClass()
    {
        self::$registrationController = null;
    }

    /**
     * @test if the page of registration is return
     */
    public function testCreateReturnsViewInstance()
    {
        $response = self::$registrationController->showRegister();

        $this->assertInstanceOf(View::class, $response);
    }
}
