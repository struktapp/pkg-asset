<?php

namespace Strukt\Html;

use Strukt\Type\Str;
use Strukt\Type\Arr;

use Strukt\Dom\Nodes;
use Strukt\Dom\Node;

use Strukt\Contract\HtmlQuery;

abstract class AbstractQuery implements HtmlQuery{

    protected $doc;

    /**
     * @param string $expr
     * 
     * @return \Strukt\Type\Str|string
     */
    public function query(string $expr):string|Str{

        $xpath = new \DOMXpath($this->doc);
        $elements = $xpath->query($expr);

        $html = Str::create("");
        foreach($elements as $element)
            $html = $html->concat($element->nodeValue);

        return $html;
    }

    /**
     * @param string $expr
     * 
     * @return \Strukt\Type\Arr
     */
    public function queryNodes(string $expr):Arr{

        $xpath = new \DOMXpath($this->doc);
        $elements = $xpath->query($expr);

        $els = [];
        foreach($elements as $element)
            $els[] = $element;

        return Arr::create($els);
    }

    /**
     * @param string $expr
     * 
     * @return \Strukt\Type\Arr
     */
    public function queryAll(string $expr):Arr{

        $domNodes = new Nodes($expr, $this);

        return $domNodes->getNodes();
    }
}

