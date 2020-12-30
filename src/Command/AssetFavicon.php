<?php declare(strict_types=1);

namespace App\Command;

use App\Console\Message as MessageConsole;
use App\Filesystem\Directory as DirectoryFilesystem;

class AssetFavicon extends CommandAbstract
{
    /**
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->files() as $file) {
            $this->store($file);
        }
    }

    /**
     * @param string $file = ''
     *
     * @return string
     */
    protected function path(string $file = ''): string
    {
        return static::PATH_HTML.'/'.$file;
    }

    /**
     * @return array
     */
    protected function files(): array
    {
        return DirectoryFilesystem::files(static::PATH_ASSET.'/favicon');
    }

    /**
     * @param string $file
     *
     * @return void
     */
    protected function store(string $file): void
    {
        $target = $this->storeName($file);

        MessageConsole::echo(sprintf("Creating <color:green>%s</color> favicon\n", $this->removePathBase($target)));

        $this->fileWrite($target, $file, true);
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function storeName(string $file): string
    {
        return $this->path(basename($file));
    }
}
