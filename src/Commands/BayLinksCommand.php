<?php

namespace PalPalani\BayLinks\Commands;

use Illuminate\Console\Command;

class BayLinksCommand extends Command
{
    public $signature = 'baylinks-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
