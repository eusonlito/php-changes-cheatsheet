<?php declare(strict_types=1);

namespace App\View;

use App\Filesystem\File;
use RuntimeException;

class Page
{
    public static function write(string $path, string $title, string $content): void
    {
        $name = basename($path);
        $markdown = $name.'.md';
        $class = $name === 'index' ? 'index' : 'docs';

        File::write($path.'.md', self::markdown($content));
        File::write($path.'.html', Template::get('layout', compact('title', 'content', 'class', 'markdown')));
    }

    private static function markdown(string $content): string
    {
        $content = preg_replace('~(<a\s+[^>]*?href=")([a-z0-9-]+)\.html"~i', '$1$2.md"', $content);
        // Older PHP manuals use <br> inside inline code to lay out multi-line examples.
        $content = preg_replace_callback('~<div class="phpcode"><code>(.*?)</code></div>~s', static function ($match) {
            $code = strip_tags(preg_replace('~<br\s*/?>~i', "\n", $match[1]));
            return '<pre><code>'.str_replace(["\u{00a0}", '&nbsp;'], ' ', $code).'</code></pre>';
        }, $content);

        $input = tmpfile();
        fwrite($input, $content);
        rewind($input);
        $process = proc_open(
            ['pandoc', '--from=html-native_divs-native_spans', '--to=gfm-raw_html', '--wrap=none'],
            [$input, ['pipe', 'w'], STDERR],
            $pipes
        );
        if (!is_resource($process)) {
            throw new RuntimeException('Could not start Pandoc to generate Markdown.');
        }
        $markdown = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        fclose($input);
        if (proc_close($process) !== 0 || $markdown === false) {
            throw new RuntimeException('Markdown conversion failed. Check that pandoc is installed and on PATH.');
        }
        return $markdown;
    }
}
