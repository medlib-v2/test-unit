<?php

namespace Tests\Unit\Console;

use Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommandVueTest extends TestCase
{
    /**
     * Set up the environment of test
     */
    public function setUp()
    {
        parent::setUp();
        @unlink(resource_path('assets/js/components/NewComponent.vue'));
        @unlink(resource_path('custom/path/NewComponent.vue'));
        @unlink(resource_path('assets/js/mixins/NewMixin.js'));
        @unlink(resource_path('custom/path/NewMixin.js'));
    }

    public function tearDown()
    {
        parent::tearDown();
        @unlink(resource_path('assets/js/components/NewComponent.vue'));
        @unlink(resource_path('custom/path/NewComponent.vue'));
        @unlink(resource_path('assets/js/mixins/NewMixin.js'));
        @unlink(resource_path('custom/path/NewMixin.js'));
    }

    /**
     * @test
     */
    public function testItSavesComponentFileWithSpecifiedName()
    {
        $file = resource_path('assets/js/components/NewComponent.vue');
        $this->assertFileNotExists($file);
        Artisan::call('vue:component', [
            'name'    => 'NewComponent',
            '--empty' => true,
        ]);
        $this->assertFileExists($file);
    }

    /**
     * @test
     */
    public function testItGeneratesAnEmptyComponentFile()
    {
        $file = resource_path('assets/js/components/NewComponent.vue');
        $this->assertFileNotExists($file);

        Artisan::call('vue:component', [
            'name'    => 'NewComponent',
            '--empty' => true,
        ]);

        $this->assertFileEquals(__DIR__.'/../../../app/Console/Commands/stubs/EmptyComponent.vue', $file);
    }

    /**
     * @test
     */
    public function testItGeneratesAFilledComponentFile()
    {
        $file = resource_path('assets/js/components/NewComponent.vue');
        $this->assertFileNotExists($file);
        Artisan::call('vue:component', [
            'name' => 'NewComponent',
        ]);
        $this->assertFileEquals(__DIR__.'/../../../app/Console/Commands/stubs/Component.vue', $file);
    }

    /**
     * @test
     */
    public function testItSavesComponentFileToSpecifiedPath()
    {
        $file = resource_path('custom/path/NewComponent.vue');
        $this->assertFileNotExists($file);
        Artisan::call('vue:component', [
            'name'   => 'NewComponent',
            '--path' => 'custom/path',
        ]);
        $this->assertFileExists($file);
    }

    /**
     * @test
     */
    public function testItSavesComponentsToPathSetInConfig()
    {
        config(['vue.paths.components' => 'custom/path']);

        $file = resource_path('custom/path/NewComponent.vue');
        $this->assertFileNotExists($file);
        Artisan::call('vue:component', [
            'name'   => 'NewComponent',
        ]);
        $this->assertFileExists($file);
    }

    /**
     * @test
     *
     * @expectedException \Medlib\Exceptions\ResourceAlreadyExists
     * @expectedExceptionMessage File NewComponent.vue already exists at path.
     */
    public function testItDoesntOverwriteComponentsThatAlreadyExist()
    {
        $file = resource_path('assets/js/components/NewComponent.vue');
        Artisan::call('vue:component', [
            'name'   => 'NewComponent',
        ]);
        $this->assertFileExists($file);
        Artisan::call('vue:component', [
            'name'   => 'NewComponent',
        ]);
    }

    /**
     * @test
     */
    public function testItSavesMixinFileXithSpecifiedName()
    {
        $file = resource_path('assets/js/mixins/NewMixin.js');
        $this->assertFileNotExists($file);
        Artisan::call('vue:mixin', [
            'name'    => 'NewMixin',
            '--empty' => true,
        ]);
        $this->assertFileExists($file);
    }

    /**
     * @test
     */
    public function testItGeneratesEmptyMixinFile()
    {
        $file = resource_path('assets/js/mixins/NewMixin.js');
        $this->assertFileNotExists($file);
        Artisan::call('vue:mixin', [
            'name'    => 'NewMixin',
            '--empty' => true,
        ]);
        $this->assertFileEquals(__DIR__.'/../../../app/Console/Commands/stubs/EmptyMixin.js', $file);
    }

    /**
     * @test
     */
    public function testItGeneratesFilledMixinFile()
    {
        $file = resource_path('assets/js/mixins/NewMixin.js');
        $this->assertFileNotExists($file);
        Artisan::call('vue:mixin', [
            'name' => 'NewMixin',
        ]);
        $this->assertFileEquals(__DIR__.'/../../../app/Console/Commands/stubs/Mixin.js', $file);
    }

    /**
     * @test
     */
    public function testItSavesMixinFileToSpecifiedPath()
    {
        $file = resource_path('custom/path/NewMixin.js');
        $this->assertFileNotExists($file);
        Artisan::call('vue:mixin', [
            'name'   => 'NewMixin',
            '--path' => 'custom/path',
        ]);
        $this->assertFileExists($file);
    }

    /**
     * @test
     */
    public function testItSavesMixinsToPathSetInConfig()
    {
        app()['config']->set('vue.paths.mixins', 'custom/path');
        $file = resource_path('custom/path/NewMixin.js');
        $this->assertFileNotExists($file);
        Artisan::call('vue:mixin', [
            'name'   => 'NewMixin',
        ]);
        $this->assertFileExists($file);
    }

    /**
     * @test
     *
     * @expectedException \Medlib\Exceptions\ResourceAlreadyExists
     * @expectedExceptionMessage File NewMixin.js already exists at path.
     */
    public function testItDoesntOverwriteMixinThatAlreadyExist()
    {
        $file = resource_path('assets/js/mixins/NewMixin.js');
        Artisan::call('vue:mixin', [
            'name'   => 'NewMixin',
        ]);
        $this->assertFileExists($file);
        Artisan::call('vue:mixin', [
            'name'   => 'NewMixin',
        ]);
    }
}
