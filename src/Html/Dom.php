<?php declare(strict_types=1);

namespace App\Html;

use DOMDocument;
use DOMElement;
use DOMNodeList;
use DOMXpath;

class Dom
{
    /**
     * @var \DOMDocument
     */
    protected DOMDocument $dom;

    /**
     * @param string $html
     *
     * @return self
     */
    public function __construct(string $html)
    {
        $this->load($this->encode($html));
    }

    /**
     * @param string $html
     *
     * @return string
     */
    protected function encode(string $html): string
    {
        $html = htmlentities($html, ENT_COMPAT, 'UTF-8', false);
        $html = mb_convert_encoding($html, 'UTF-8', mb_list_encodings());
        $html = htmlspecialchars_decode($html);

        return $html;
    }

    /**
     * @param string $html
     *
     * @return self
     */
    protected function load(string $html): self
    {
        libxml_use_internal_errors(true);

        $this->dom = new DOMDocument();
        $this->dom->recover = true;
        $this->dom->preserveWhiteSpace = false;
        $this->dom->substituteEntities = false;
        $this->dom->loadHtml($html, LIBXML_NOBLANKS | LIBXML_ERR_NONE);
        $this->dom->encoding = 'utf-8';

        libxml_use_internal_errors(false);

        return $this;
    }

    /**
     * @param string $query
     * @param \DOMElement $node = null
     *
     * @return \DOMNodeList
     */
    public function query(string $query, DOMElement $node = null): DOMNodeList
    {
        return (new DOMXpath($this->dom))->query($query, $node);
    }

    /**
     * @param string $query
     * @param \DOMElement $node = null
     * @param int $item = 0
     *
     * @return ?\DOMElement
     */
    public function queryItem(string $query, DOMElement $node = null, int $item = 0): ?DOMElement
    {
        return $this->query($query, $node)->item($item);
    }

    /**
     * @param \DOMElement $node
     *
     * @return string
     */
    public function toHtml(DOMElement $node): string
    {
        return $this->dom->saveHTML($node);
    }
}
