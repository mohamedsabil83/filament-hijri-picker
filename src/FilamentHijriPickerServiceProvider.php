<?php

namespace MohamedSabil83\FilamentHijriPicker;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentHijriPickerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-hijri-picker';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            AlpineComponent::make('filament-hijri-picker', __DIR__.'/../resources/dist/js/hijri-date-time-picker.js'),
        ], package: 'mohamedsabil83/filament-hijri-picker');
    }
}
