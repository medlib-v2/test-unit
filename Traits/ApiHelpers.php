<?php

namespace Tests\Traits;

use Medlib\Models\User;

trait ApiHelpers
{
    /**
     * Return request headers needed to interact with the API.
     *
     * @param string $version
     * @param User   $user
     *
     * @return array Array of headers.
     */
    protected function headers($version = 'v1', User $user = null)
    {
        $standardsTree = config('api.standardsTree');
        $subtype = config('api.subtype');
        $headers = [
            'Accept' => "application/$standardsTree.$subtype.$version+json",
        ];
        if (!$user !== null) {
            $headers['Authorization'] = "Bearer $user->api_token";
        }
        return $headers;
    }
    /**
     * @param User $user
     *
     * @return $this
     */
    protected function actingAsApiUser(User $user)
    {
        $this->actingAs($user);
        $this->app['api.auth']->setUser($user);
        return $this;
    }
}