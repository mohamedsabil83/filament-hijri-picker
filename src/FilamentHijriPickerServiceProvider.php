<?php

namespace Mohamedsabil83\FilamentHijriPicker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mohamedsabil83\FilamentHijriPicker\Commands\FilamentHijriPickerCommand;

class FilamentHijriPickerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-hijri-picker')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-hijri-picker_table')
            ->hasCommand(FilamentHijriPickerCommand::class);
    }
}
