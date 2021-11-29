<?php declare(strict_types=1);

namespace App\Command;

use App\Console\Message as MessageConsole;
use App\Filesystem\Directory as DirectoryFilesystem;
use App\View\Template as TemplateView;

class HtmlIndex extends CommandAbstract
{
    /**
     * @param string $name
     *
     * @return void
     */
    public function handle(): void
    {
        $this->store($this->html($this->list($this->files())));
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function name(string $name): string
    {
        return preg_replace('/[^a-z0-9-]/', '', $name);
    }

    /**
     * @param string $path = ''
     *
     * @return string
     */
    protected function url(string $path = ''): string
    {
        return static::URL_DOCS.'/'.$path;
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
        $files = [];

        foreach (DirectoryFilesystem::files(static::PATH_CACHE_CHUNK) as $file) {
            $files = $this->filesFile($files, $file);
        }

        uasort($files, static fn ($a, $b) => count($a['versions']) > count($b['versions']) ? -1 : 1);

        foreach ($files as &$group) {
            krsort($group['versions'], SORT_NUMERIC);
        }

        return $files;
    }

    /**
     * @param array $files
     * @param string $file
     *
     * @return array
     */
    protected function filesFile(array $files, string $file): array
    {
        $name = $this->fileCode($file);

        if (empty($files[$name])) {
            $files[$name] = ['file' => $file, 'versions' => []];
        }

        $files[$name]['versions'][] = $this->filesVersion($file);

        return $files;
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function filesVersion(string $file): string
    {
        return implode('.', str_split(preg_replace(['/[^0-9]/', '/^[0-9]$/'], ['', '${0}0'], basename($file))));
    }

    /**
     * @param array $files
     *
     * @return array
     */
    protected function list(array $files): array
    {
        foreach ($files as $name => $group) {
            $files[$name]['link'] = $this->listLink($name);
            $files[$name]['title'] = $this->listTitle($group);
        }

        return $files;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function listLink(string $name): string
    {
        return $name.'.html';
    }

    /**
     * @param array $group
     *
     * @return string
     */
    protected function listTitle(array $group): string
    {
        $title = trim($this->dom(reset($group))->queryItem('//h2[@class="title"]')->textContent);
        $title = preg_replace(['/\n/', '/\s+/', '/ in PHP.*/'], [' ', ' ', ''], $title);

        return trim($title);
    }

    /**
     * @param array $files
     *
     * @return string
     */
    protected function html(array $files): string
    {
        return $this->htmlLayout($this->htmlIndex($files));
    }

    /**
     * @param array $files
     *
     * @return string
     */
    protected function htmlIndex(array $files): string
    {
        return TemplateView::get('index', [
            'groups' => $files
        ]);
    }

    /**
     * @param string $html
     *
     * @return string
     */
    protected function htmlLayout(string $html): string
    {
        return TemplateView::get('layout', [
            'class' => 'index',
            'title' => 'PHP changes cheatsheet',
            'content' => $html
        ]);
    }

    /**
     * @param string $html
     *
     * @return void
     */
    protected function store(string $html): void
    {
        $target = $this->path('index').'.html';

        MessageConsole::echo(sprintf("Generating <color:green>%s</color> HTML page\n", $this->removePathBase($target)));

        $this->fileWrite($target, $html);
    }
}
