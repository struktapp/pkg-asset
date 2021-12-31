<?php

namespace Strukt\Dom;

class Node{

    private $el;

    public function __construct(\DomElement $el){

        $this->el = $el;
    }

    public function addAttr(string $attr, string $value){

        $this->el->setAttribute($attr, $value);  

        return $this;      
    }

    public function getNode(){

        return $this->el;
    }

    public function yield(){

        return $this->el->ownerDocument->saveXML($this->el);
    }
};