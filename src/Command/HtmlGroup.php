<?php declare(strict_types=1);

namespace App\Command;

use App\Console\Message as MessageConsole;
use App\Filesystem\Directory as DirectoryFilesystem;
use App\View\Template as TemplateView;

class HtmlGroup extends CommandAbstract
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @param string $name
     *
     * @return void
     */
    public function handle(string $name): void
    {
        $this->name = $this->name($name);
        $this->files = $this->files();
        $this->title = $this->title();

        $this->store($this->html());
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
        return static::URL_DOCS.$path;
    }

    /**
     * @param string $file = ''
     *
     * @return string
     */
    protected function path(string $file = ''): string
    {
        return static::PATH_HTML.$file;
    }

    /**
     * @return array
     */
    protected function files(): array
    {
        $files = [];

        foreach (DirectoryFilesystem::files(static::PATH_CACHE_CHUNK) as $file) {
            if ($this->filesName($file) === $this->name) {
                $files[$this->filesVersion($file)] = $file;
            }
        }

        krsort($files, SORT_NUMERIC);

        return $files;
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function filesName(string $file): string
    {
        return explode('.', basename($file))[1];
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
     * @return string
     */
    protected function title(): string
    {
        $title = trim($this->dom(reset($this->files))->queryItem('//h2[@class="title"]')->textContent);
        $title = preg_replace(['/\n/', '/\s+/', '/ in PHP.*/'], [' ', ' ', ''], $title);

        return sprintf('%s in PHP %s', $title, implode(', ', array_keys($this->files)));
    }

    /**
     * @return string
     */
    protected function html(): string
    {
        return $this->htmlLayout($this->htmlInfo($this->htmlInfoVersion($this->files)));
    }

    /**
     * @return string
     */
    protected function htmlInfoVersion(): string
    {
        $html = '';

        foreach ($this->files as $version => $file) {
            $html .= TemplateView::get('info-version', [
                'version' => $version,
                'link' => $this->url(basename($file)),
                'content' => $this->htmlInfoVersionContent($file)
            ]);
        }

        return $html;
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function htmlInfoVersionContent(string $file): string
    {
        return str_replace('href="', 'target="_blank" href="'.$this->url(), file_get_contents($file));
    }

    /**
     * @param string $html
     *
     * @return string
     */
    protected function htmlInfo(string $html): string
    {
        return TemplateView::get('info', [
            'title' => $this->title,
            'versions' => array_keys($this->files),
            'content' => $html
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
            'class' => 'docs',
            'title' => $this->title,
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
        $target = $this->path($this->name).'.html';

        MessageConsole::echo(sprintf("Generating <color:green>%s</color> HTML page\n", $this->removePathBase($target)));

        $this->fileWrite($target, $html);
    }
}
