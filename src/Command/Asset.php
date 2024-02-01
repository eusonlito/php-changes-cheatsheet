<?php declare(strict_types=1);

namespace App\Command;

use App\Console\Message as MessageConsole;

class Asset extends CommandAbstract
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $this->command('AssetCss');
        $this->command('AssetFavicon');
        $this->command('AssetImages');
    }
}
