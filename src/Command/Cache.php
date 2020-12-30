<?php declare(strict_types=1);

namespace App\Command;

use Generator;
use App\Console\Message as MessageConsole;
use App\Filesystem\Directory as DirectoryFilesystem;

class Cache extends CommandAbstract
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $this->clean();
        $this->create();

        foreach ($this->urls() as $url) {
            $this->store($url);
        }
    }

    /**
     * @return void
     */
    protected function clean(): void
    {
        DirectoryFilesystem::rmdir($this->path());
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
        return static::PATH_CACHE_MIGRATION.'/'.$file;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    protected function url(string $path): string
    {
        return static::URL_DOCS.'/'.$path;
    }

    /**
     * @return \Generator
     */
    protected function urls(): Generator
    {
        $dom = $this->dom($this->url('appendices.php'));

        foreach ($dom->query('//div[@id="appendices"]/ul/li/ul/li/a') as $node) {
            $href = $node->getAttribute('href');

            if (strpos($href, 'migration') === 0) {
                yield $this->url($href);
            }
        }
    }

    /**
     * @param string $url
     *
     * @return void
     */
    protected function store(string $url): void
    {
        $target = $this->path(basename($url));

        MessageConsole::echo(sprintf("Downloading <color:green>%s</color> into <color:green>%s</color>\n", $url, $this->removePathBase($target)));

        $this->fileWrite($target, $url, true);
    }
}
