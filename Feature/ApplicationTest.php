<?php

namespace Tests\Feature;

use App;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\BrowserKitTestCase;
use GuzzleHttp\Handler\MockHandler;

class ApplicationTest extends BrowserKitTestCase
{
    public function setUp()
    {
        parent::setUp();
        @unlink(App::publicPath().'/hot');
    }

    public function testStaticUrlWithoutCDN()
    {
        config(['medlib.cdn.url' => '']);
        $this->assertEquals($this->baseUrl.'/', App::staticUrl());
        $this->assertEquals($this->baseUrl.'/css/foo.css', App::staticUrl('css/foo.css'));
    }

    /**
     * @test The static url with cdn given
     */
    public function testStaticUrlWithCDN()
    {
        config(['medlib.cdn.url' => 'http://cdn.bar']);

        $this->assertEquals('http://cdn.bar/', App::staticUrl());
        $this->assertEquals('http://cdn.bar/css/foo.css', App::staticUrl('/css/foo.css  '));
    }

    /**
     * @test Laravel mix version testing
     */
    public function testRevision()
    {
        config(['medlib.cdn.url' => 'http://localhost']);

        $manifestFile = dirname(__DIR__).'/medias/mix-manifest.json';

        $this->assertEquals('http://localhost/css/foo00.css', App::rev('/css/foo.css', $manifestFile)->__toString());

        config(['medlib.cdn.url' => 'http://cdn.bar']);
        $this->assertEquals('http://cdn.bar/js/bar00.js', App::rev('/js/bar.js', $manifestFile)->__toString());
    }

    /**
     * @test The last version
     */
    public function testGetLatestVersion()
    {
        $githubTags = dirname(__DIR__).'/medias/github-tags.json';
        $mock = new MockHandler([
            new Response(200, [], file_get_contents($githubTags)),
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $this->assertEquals('v1.1.2', App::getLatestVersion($client));
    }
}
