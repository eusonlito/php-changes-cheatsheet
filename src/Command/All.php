<?php declare(strict_types=1);

namespace App\Command;

class All extends CommandAbstract
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $this->command('Cache');
        $this->command('Chunk');
        $this->command('Html');
        $this->command('Asset');
    }
}
