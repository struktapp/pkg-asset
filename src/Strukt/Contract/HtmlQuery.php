<?php

namespace Strukt\Contract;

use Strukt\Type\Str;
use Strukt\Type\Arr;

interface HtmlQuery{

	public function query(string $expr):string|Str;
	public function queryNodes(string $expr):Arr;
	public function queryAll(string $expr):Arr;
}