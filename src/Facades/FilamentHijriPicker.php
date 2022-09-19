<?php

namespace Mohamedsabil83\FilamentHijriPicker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mohamedsabil83\FilamentHijriPicker\FilamentHijriPicker
 */
class FilamentHijriPicker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mohamedsabil83\FilamentHijriPicker\FilamentHijriPicker::class;
    }
}
