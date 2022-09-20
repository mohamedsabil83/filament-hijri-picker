<?php

namespace Mohamedsabil83\FilamentHijriPicker;

use Filament\Facades\Filament;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentHijriPickerServiceProvider extends PluginServiceProvider
    // class FilamentHijriPickerServiceProvider extends PackageServiceProvider
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

    public function packageBooted(): void
    {
        Filament::registerScripts([
            // 'filament-hijri-picker' => __DIR__.'/../resources/dist/js/hijri-date-time-picker.js',
            // 'filament-hijri-picker' => asset('vendor/filament-hijri-picker/tinymce/tinymce.min.js'),
            // asset('vendor/filament-hijri-picker/js/filament-forms-range-component.min.css'),
        ]);
    }
}
