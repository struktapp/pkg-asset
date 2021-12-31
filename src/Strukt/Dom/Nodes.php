<?php

namespace Strukt\Dom;

use Strukt\Contract\HtmlQuery;
use Strukt\Type\Arr;

class Nodes{

    private $el;
    private $nodes;

    public function __construct(string $expr, HtmlQuery $hq){

    	$domNodes = $hq->queryNodes($expr)->yield();

    	$nodes = [];
    	foreach($domNodes as $domNode)
    		$nodes[] = new Node($domNode);

        $this->nodes = Arr::create($nodes);
    }

    public function getNodes(){

    	return $this->nodes;
    }
};