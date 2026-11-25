<?php declare(strict_types=1);

namespace App\Command;

use App\View\Page;
use App\Filesystem\Directory as DirectoryFilesystem;
use App\View\Template as TemplateView;

class HtmlGroup extends CommandAbstract
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var array
     */
    protected array $files;

    /**
     * @var string
     */
    protected string $title;

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

        $content = TemplateView::get('info', ['title' => $this->title, 'content' => $this->htmlInfoVersion()]);
        Page::write($this->path($this->name), $this->title, $content);
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
        $docs = preg_match('/^migration5[1-5]?\./', $path) ? static::URL_LEGACY_DOCS : static::URL_DOCS;
        return $docs.'/'.$path;
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
            if ($this->fileCode($file) === $this->name) {
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
        $base = $this->url(basename($file));
        return preg_replace_callback('/(<a\s+[^>]*?)href="([^"]*)"/i', static function ($match) use ($base) {
            $href = $match[2];
            if (strpos($href, '//') === 0) {
                $href = 'https:'.$href;
            } elseif (strpos($href, '/') === 0) {
                $href = 'https://'.parse_url($base, PHP_URL_HOST).$href;
            } elseif (!preg_match('~^[a-z][a-z0-9+.-]*:~i', $href)) {
                $href = strpos($href, '#') === 0 ? $base.$href : dirname($base).'/'.$href;
            }
            return $match[1].'target="_blank" href="'.$href.'"';
        }, file_get_contents($file));
    }
}
