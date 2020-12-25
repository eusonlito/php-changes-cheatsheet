<?php
/**
 * @param string $html
 *
 * @return \DOMDocument
 */
function dom(string $html): DOMDocument
{
    libxml_use_internal_errors(true);

    $dom = new DOMDocument();
    $dom->recover = true;
    $dom->preserveWhiteSpace = false;
    $dom->substituteEntities = false;
    $dom->loadHtml(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_NOBLANKS | LIBXML_ERR_NONE);
    $dom->encoding = 'utf-8';

    libxml_use_internal_errors(false);

    return $dom;
}

/**
 * @param \DOMDocument $dom
 * @param string $query
 * @param \DOMElement $node = null
 *
 * @return \DOMNodeList
 */
function xpathQuery(DOMDocument $dom, string $query, DOMElement $node = null): DOMNodeList
{
    return (new DOMXpath($dom))->query($query, $node);
}

/**
 * @param \DOMDocument $dom
 * @param string $query
 * @param \DOMElement $node = null
 * @param int $item = 0
 *
 * @return \DOMElement
 */
function xpathQueryItem(DOMDocument $dom, string $query, DOMElement $node = null, int $item = 0): DOMElement
{
    return xpathQuery($dom, $query, $node)->item($item) ?: new DOMElement('root');
}

/**
 * @param string $url
 * @param string $name = ''
 *
 * @return string
 */
function download(string $url, string $name = ''): string
{
    if (!is_dir(CACHE)) {
        mkdir(CACHE, 0755, true);
    }

    $cache = CACHE.'/'.($name ?: basename($url));

    if (is_file($cache) === false) {
        file_put_contents($cache, file_get_contents($url));
    }

    return file_get_contents($cache);
}

/**
 * @param \DOMDocument $dom
 * @param \DOMElement $node
 * @param string $name
 *
 * @return string
 */
function nodeToHtml(DOMDocument $dom, DOMElement $node, string $name): string
{
    if (!is_dir(HTML)) {
        mkdir(HTML, 0755, true);
    }

    $data = pageData($name, $dom);

    $frontmatter = [
      "---",
      "title: {$data['title']}",
      "version: \"{$data['version']}\"",
      "tags:",
      " - \"{$data['version']}\"",
      " - {$data['type']}",
      "---",
    ];

    $html = $dom->saveHTML($node);
    $html = preg_replace('/href="([a-z])/', 'href="'.REMOTE.'$1', $html);

    $name = preg_replace('/^[^0-9]+/', '', $name);
    $name = preg_replace('/^([0-9])\./', '${1}0.', $name);
    $name = str_replace('.', '-', $name);

    file_put_contents(HTML.'/'.$name.'.html', implode("\n", $frontmatter)."\n".$html);

    return $name;
}

/**
 * @param array $pages
 * @param string $name
 * @param \DOMDocument $dom
 *
 * @return array
 */
function pageData(string $name, DOMDocument $dom): array
{
    [$version, $type] = explode('.', $name);
    
    $version = version($version);
    $title = str_replace("\n", '', xpathQueryItem($dom, '//h2[@class="title"]')->textContent);

    return compact('version', 'type', 'title', 'name');
}

/**
 * @param array $pages
 * @param string $name
 * @param \DOMDocument $dom
 *
 * @return array
 */
function pageIndex(array $pages, string $name, DOMDocument $dom): array
{
    [$version, $type] = explode('.', $name);

    $pages[$type]['title'] = str_replace("\n", '', xpathQueryItem($dom, '//h2[@class="title"]')->textContent);
    $pages[$type]['versions'][version($version)] = $name;

    return $pages;
}

/**
 * @param array $pages
 *
 * @return string
 */
function version(string $version): string
{
    return implode('.', str_split(substr(preg_replace('/[^0-9]/', '', $version).'0', 0, 2)));
}

/**
 * @return void
 */
function css(): void
{
    $cached = CACHE.'/styles.scss';
    $scss = HTML.'/styles.scss';
    $css = HTML.'/styles.scss';

    download('https://www.php.net/cached.php?t=1606338002&f=/styles/theme-base.css', basename($scss));

    file_put_contents($scss, '.phpnet { '.str_replace('.docs', '', file_get_contents($cached)). ' }');

    shell_exec('node-sass "'.$scss.'" "'.$css.'"');
}

define('REMOTE', 'https://www.php.net/manual/en/');
define('CACHE', __DIR__.'/.cache');
define('HTML', __DIR__.'/info');

$dom = dom(file_get_contents(REMOTE.'appendices.php'));
$pages = [];

foreach (xpathQuery($dom, '//div[@id="appendices"]/ul/li') as $index) {
    $href = xpathQueryItem($dom, './a', $index)->getAttribute('href');

    if (strpos($href, 'migration') !== 0) {
        continue;
    }

    foreach (xpathQuery($dom, './ul/li/a', $index) as $line) {
        $url = REMOTE.$line->getAttribute('href');

        echo sprintf('Downloading %s -> %s'."\n", $line->textContent, $url);

        $page = dom(download($url));
        $id = preg_replace('/\.php$/', '', basename($url));

        $contents = xpathQueryItem($page, '//div[@id="'.$id.'"]');

        if (empty($contents)) {
            continue;
        }

        nodeToHtml($page, $contents, $id);
        // $pages = pageIndex($pages, nodeToHtml($page, $contents, $id), $page);
    }
}

// css();

// yaml_emit_file(HTML.'/index.yaml', $pages);
