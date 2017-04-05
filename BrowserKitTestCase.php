<?php
namespace Tests;

use Medlib\Models\User;
use Tests\Traits\TestHelpers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tests\Traits\CreatesApplication;
use Tests\Traits\DatabaseMigrations;
use Laravel\BrowserKitTesting\TestCase;

abstract class BrowserKitTestCase extends TestCase
{
    use TestHelpers, CreatesApplication, DatabaseMigrations;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://medlib.app';


    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $manager;

    /**
     * Settings the environment test
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->manager = app('session');
    }

    /**
     * Resetting all information this environment test
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        $this->artisanMigrateReset();
    }

    protected function getAsUser($url, $user = null)
    {
        $user = $this->authUser($user);

        return $this->get($url, [
            'Authorization' => 'Bearer '.JWTAuth::fromUser($user),
        ]);
    }

    protected function deleteAsUser($url, $data = [], $user = null)
    {
        $user = $this->authUser($user);

        return $this->delete($url, $data, [
            'Authorization' => 'Bearer '.JWTAuth::fromUser($user),
        ]);
    }

    protected function postAsUser($url, $data, $user = null)
    {
        $user = $this->authUser($user);

        return $this->post($url, $data, [
            'Authorization' => 'Bearer '.JWTAuth::fromUser($user),
        ]);
    }

    protected function putAsUser($url, $data, $user = null)
    {

        return $this->put($url, $data, [
            'Authorization' => 'Bearer '.JWTAuth::fromUser($user),
        ]);
    }

    /**
     * @param null $user
     * @return mixed|null
     */
    private function authUser($user = null)
    {
        if (!$user) {
            $user = factory(User::class)->create();
            Auth::login($user);
        } else {
            Auth::login($user);
        }
        return $user;
    }
}