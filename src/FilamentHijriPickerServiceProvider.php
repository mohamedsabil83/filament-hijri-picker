<?php

namespace MohamedSabil83\FilamentHijriPicker;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentHijriPickerServiceProvider extends PluginServiceProvider
{
    protected array $beforeCoreScripts = [
        'filament-hijri-picker' => __DIR__.'/../resources/dist/js/hijri-date-time-picker.js',
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-hijri-picker')
            ->hasViews();
    }
}
