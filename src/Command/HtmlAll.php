<?php declare(strict_types=1);

namespace App\Command;

use DOMElement;
use App\Console\Message as MessageConsole;
use App\Filesystem\Directory as DirectoryFilesystem;
use App\Html\Dom as DomHtml;
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
     * @return string
     */
    protected function html(): string
    {
        $dom = $this->dom($this->path('index.html'));
        $html = '';

        foreach ($dom->query('//main/ul/li/a') as $node) {
            $html .= $this->htmlNode($dom, $node);
        }

        return $this->htmlLayout($html);
    }

    /**
     * @param \App\Html\Dom $dom
     * @param \DOMElement $node
     *
     * @return string
     */
    protected function htmlNode(DomHtml $dom, DOMElement $node): string
    {
        $link = $node->getAttribute('href');

        if ((strpos($link, 'http') === 0) || ($link === 'all.html')) {
            return '';
        }

        $dom = $this->dom($this->path($link));

        return $dom->toHtml($dom->queryItem('//section[@class="info-wrapper"]'));
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
