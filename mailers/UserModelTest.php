<?php

namespace Medlib\Tests\Mailers;

use Medlib\Models\Feed;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;

class UserModelTest extends TestCase {


    public function testPostedAtFeed()
    {
        /**
         * Instantiate, fill with values, save and return
         */
        $post = Factory::create(Feed::class);

        /**
         * Regular expression that represents d/m/Y pattern
         * @var  $expected
         */
        $expected = '/\d{2}\/\d{2}\/\d{4}/';

        /**
         * True if preg_match finds the pattern
         */
        $matches = ( preg_match($expected, $post->publishAt()) ) ? true : false;

        $this->assertTrue( $matches );
    }
}