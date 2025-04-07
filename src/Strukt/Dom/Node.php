<?php

namespace Strukt\Dom;

class Node{

    private $el;

    /**
     * @param \DomElement $el
     */
    public function __construct(\DomElement $el){

        $this->el = $el;
    }

    /**
     * @param string $attr
     * @param string $value
     * 
     * @return static
     */
    public function addAttr(string $attr, string $value):static{

        $this->el->setAttribute($attr, $value);  

        return $this;      
    }

    /**
     * @return \Dom\Node|\DomElement
     */
    public function getNode():\Dom\Node|\DomElement{

        return $this->el;
    }

    /**
     * @return string|false
     */
    public function yield():string|false{

        return $this->el->ownerDocument->saveXML($this->el);
    }
};