<?php declare(strict_types=1);

namespace App\Command;

use App\Console\Message as MessageConsole;

class Css extends CommandAbstract
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $this->remote();
        $this->local();
        $this->images();
    }

    /**
     * @param string $theme
     *
     * @return string
     */
    protected function url(string $theme): string
    {
        return static::URL_BASE.'cached.php?f=/styles/theme-'.$theme.'.css&t='.time();
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function path(string $file): string
    {
        return static::PATH_HTML.$file;
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function asset(string $file): string
    {
        return PATH_SRC.'/views/assets/'.$file;
    }

    /**
     * @return void
     */
    protected function remote(): void
    {
        $target = $this->path('phpnet.css');
        $css = file_get_contents($this->url('base'))."\n".file_get_contents($this->url('medium'));

        MessageConsole::echo(sprintf("Download CSS into <color:green>%s</color>\n", $this->removePathBase($target)));

        $this->fileWrite($target, $css);
    }

    /**
     * @return void
     */
    protected function local(): void
    {
        $target = $this->path('styles.css');
        $source = $this->asset('css/styles.css');

        MessageConsole::echo(sprintf("Copy <color:green>%s</color> into <color:green>%s</color>\n", $this->removePathBase($source), $this->removePathBase($target)));

        $this->fileWrite($target, $source, true);
    }

    /**
     * @return void
     */
    protected function images(): void
    {
        if (preg_match_all('/url\(([^\)]+)/', file_get_contents($this->path('phpnet.css')), $matches) === 0) {
            return;
        }

        foreach ($matches[1] as $image) {
            $this->image($image);
        }
    }

    /**
     * @param string $image
     *
     * @return void
     */
    protected function image(string $image): void
    {
        $image = str_replace(["'", '"', '../'], '', $image);

        $this->fileWrite($this->path('images/'.basename($image)), static::URL_BASE.$image, true);
    }
}
