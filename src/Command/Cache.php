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
     * @param string $path
     *
     * @return string
     */
    protected function urlLegacy(string $path): string
    {
        return static::URL_LEGACY_DOCS.'/'.str_replace('.html', '.php', $path);
    }

    /**
     * @return \Generator
     */
    protected function urls(): Generator
    {
        yield from $this->urlsCurrent();
        yield from $this->urlsLegacy();
    }

    /**
     * @return \Generator
     */
    protected function urlsCurrent(): Generator
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
     * @return \Generator
     */
    protected function urlsLegacy(): Generator
    {
        $dom = $this->dom($this->urlLegacy('appendices'));

        foreach ($dom->query('//div[@id="appendices"]/ul/li/ul/li/a') as $node) {
            $href = $node->getAttribute('href');

            if (strpos($href, 'migration') === 0) {
                yield $this->urlLegacy($href);
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

        if (is_file($target)) {
            MessageConsole::echo(sprintf("Skip download existing file <color:yellow>%s</color> into <color:yellow>%s</color>\n", $url, $this->removePathBase($target)));
            return;
        }

        MessageConsole::echo(sprintf("Downloading <color:green>%s</color> into <color:green>%s</color>\n", $url, $this->removePathBase($target)));

        $this->fileWrite($target, $url, true);
    }
}
