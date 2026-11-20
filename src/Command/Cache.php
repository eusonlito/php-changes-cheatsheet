<?php declare(strict_types=1);

namespace App\Command;

use Generator;
use RuntimeException;
use App\Console\Message as MessageConsole;
use App\Filesystem\Directory as DirectoryFilesystem;

class Cache extends CommandAbstract
{
    private const MAX_DOWNLOADS = 8;

    /**
     * @return void
     */
    public function handle(): void
    {
        $downloads = [];
        foreach ($this->urls() as $url) {
            $downloads[basename($url)] ??= $url;
        }

        $this->clean();
        $this->create();
        $multi = function_exists('curl_multi_init') ? curl_multi_init() : null;
        $pending = 0;

        foreach ($downloads as $name => $url) {
            $target = $this->path($name);
            MessageConsole::echo(sprintf("Downloading <color:green>%s</color> into <color:green>%s</color>\n", $url, $this->removePathBase($target)));

            if ($multi === null) {
                $this->fileWrite($target, $url, true);
                continue;
            }

            $request = curl_init($url);
            curl_setopt_array($request, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_FAILONERROR => true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_PRIVATE => $url,
            ]);
            $status = curl_multi_add_handle($multi, $request);
            if ($status !== CURLM_OK) {
                throw new RuntimeException(curl_multi_strerror($status));
            }

            if (++$pending === self::MAX_DOWNLOADS) {
                $pending -= $this->storeCompleted($multi);
            }
        }

        while ($pending > 0) {
            $pending -= $this->storeCompleted($multi);
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
     * @param resource|\CurlMultiHandle $multi
     */
    private function storeCompleted($multi): int
    {
        $completed = 0;
        do {
            $status = curl_multi_exec($multi, $running);
            if ($status !== CURLM_OK) {
                throw new RuntimeException(curl_multi_strerror($status));
            }

            while ($info = curl_multi_info_read($multi)) {
                $request = $info['handle'];
                $url = curl_getinfo($request, CURLINFO_PRIVATE);
                if ($info['result'] !== CURLE_OK) {
                    throw new RuntimeException($url.' - '.curl_error($request));
                }
                $this->fileWrite($this->path(basename($url)), curl_multi_getcontent($request));
                curl_multi_remove_handle($multi, $request);
                ++$completed;
            }

            if (!$completed && curl_multi_select($multi) === -1) {
                usleep(1000);
            }
        } while (!$completed);

        return $completed;
    }
}
