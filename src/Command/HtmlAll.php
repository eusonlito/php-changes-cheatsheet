<?php declare(strict_types=1);

namespace App\Command;

use App\Console\Message as MessageConsole;
use App\Filesystem\Directory as DirectoryFilesystem;
use App\View\Template as TemplateView;

class HtmlAll extends CommandAbstract
{
    /**
     * @param string $name
     *
     * @return void
     */
    public function handle(): void
    {
        $this->store($this->html($this->files()));
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
        return DirectoryFilesystem::files(static::PATH_HTML, '*.html');
    }

    /**
     * @param array $files
     *
     * @return string
     */
    protected function html(array $files): string
    {
        $html = '';

        foreach ($files as $file) {
            $dom = $this->dom($file);
            $html .= $dom->toHtml($dom->queryItem('//section[@class="info-wrapper"]'));
        }

        return $this->htmlLayout($html);
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
        $target = $this->path('all').'.html';

        MessageConsole::echo(sprintf("Generating <color:green>%s</color> HTML page\n", $this->removePathBase($target)));

        $this->fileWrite($target, $html);
    }
}
