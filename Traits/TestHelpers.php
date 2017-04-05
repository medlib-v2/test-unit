<?php
namespace Tests\Traits;

use Mockery;
use Mockery\MockInterface;
use BadMethodCallException;
use Greggilbert\Recaptcha\Facades\Recaptcha;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait TestHelpers
{
    /**
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
            return $this->call($method, $args[0]);
        }
        throw new BadMethodCallException();
    }

    /**
     * @param string $class
     *
     * @return MockInterface
     */
    protected function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }
    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod(
        &$object,
        $methodName,
        array $parameters = []
    ) {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
    /**
     * Mock captcha calls.
     */
    protected function mockReCaptcha()
    {
        Recaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(true);
        Recaptcha::shouldReceive('display')
            ->zeroOrMoreTimes()
            ->andReturn(
                '<input type="hidden" name="g-recaptcha-response" value="1" />'
            );
    }

    /**
     * @param string $filename
     * @return UploadedFile
     */
    public function getUploadedFile($filename = 'fururama_img.jpg') {
        $path = dirname(__DIR__) . '/medias/'.$filename;
        $uploadedFile = new UploadedFile(
            $path, $filename, filesize($path), 'image/jpg', null, true);

        return $uploadedFile;
    }

}