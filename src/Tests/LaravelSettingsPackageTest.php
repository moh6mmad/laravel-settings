<?php

namespace Moh6mmad\LaravelSettings\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Moh6mmad\LaravelSettings\Tests\TestCase;

class InstallBlogPackageTest extends TestCase
{
    /** @test */
    function the_install_command_copies_the_configuration()
    {
        Artisan::call('laravelsettings:install');
    }
}