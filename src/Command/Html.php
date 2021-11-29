<?php declare(strict_types=1);

namespace App\Command;

use App\Filesystem\Directory as DirectoryFilesystem;

class Html extends CommandAbstract
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $this->clean();
        $this->create();

        foreach ($this->groups() as $name) {
            $this->group($name);
        }

        $this->index();
        $this->all();
    }

    /**
     * @return void
     */
    protected function clean(): void
    {
        DirectoryFilesystem::rmdir($this->path(), '*.html');
    }

    /**
     * @return void
     */
    protected function create(): void
    {
        DirectoryFilesystem::mkdir($this->path());
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
     * @return void
     */
    protected function index(): void
    {
        $this->command('HtmlIndex');
    }

    /**
     * @return void
     */
    protected function all(): void
    {
        $this->command('HtmlAll');
    }

    /**
     * @return array
     */
    protected function groups(): array
    {
        return array_map(fn ($file) => $this->fileCode($file), DirectoryFilesystem::files(static::PATH_CACHE_CHUNK));
    }

    /**
     * @param string $name
     *
     * @return void
     */
    protected function group(string $name): void
    {
        $this->command('HtmlGroup', $name);
    }
}
