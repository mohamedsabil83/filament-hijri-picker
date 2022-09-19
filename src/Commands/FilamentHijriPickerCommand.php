<?php

namespace Mohamedsabil83\FilamentHijriPicker\Commands;

use Illuminate\Console\Command;

class FilamentHijriPickerCommand extends Command
{
    public $signature = 'filament-hijri-picker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
