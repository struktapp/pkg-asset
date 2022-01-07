<?php

namespace App\Command\Asset;

use Strukt\Console\Input;
use Strukt\Console\Output;

/**
* md:html     Markdown file to HTML
*
* Usage:
*
*       md:html <file>
*
* Arguments:
*
*       file  Markdown source file
*/
class MarkdownToHtml extends \Strukt\Console\Command{

	public function execute(Input $in, Output $out){

		$dom = \Strukt\Html\Xpath::fromMarkFile($in->get("file"));

		$out->add($dom->rawHTML());
	}
}