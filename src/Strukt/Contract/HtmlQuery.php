<?php

namespace Strukt\Contract;

interface HtmlQuery{

	public function query(string $expr);
	public function queryNodes(string $expr);
	public function queryAll(string $expr);
}