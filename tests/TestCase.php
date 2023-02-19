<?php

namespace MohamedSabil83\FilamentHijriPicker\Tests;

use MohamedSabil83\FilamentHijriPicker\FilamentHijriPickerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            FilamentHijriPickerServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
