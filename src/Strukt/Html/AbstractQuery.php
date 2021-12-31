<?php

namespace Strukt\Html;

use Strukt\Type\Str;
use Strukt\Type\Arr;

use Strukt\Dom\Nodes;
use Strukt\Dom\Node;

use Strukt\Contract\HtmlQuery;

/**
 * App\Helper\AbstractHtmlQuery
 */
abstract class AbstractQuery implements HtmlQuery{

    protected $doc;

    public function query(string $expr){

        $xpath = new \DOMXpath($this->doc);
        $elements = $xpath->query($expr);

        $html = Str::create("");
        foreach($elements as $element)
            $html = $html->concat($element->nodeValue);

        return $html;
    }

    public function queryNodes(string $expr){

        $xpath = new \DOMXpath($this->doc);
        $elements = $xpath->query($expr);

        $els = [];
        foreach($elements as $element)
            $els[] = $element;

        return Arr::create($els);
    }

    public function queryAll(string $expr){

        $domNodes = new Nodes($expr, $this);

        return $domNodes->getNodes();
    }
}

