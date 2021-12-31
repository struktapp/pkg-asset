<?php

namespace Strukt\Html;

use Strukt\Type\Str;
use Strukt\Fs;

/**
 * HtmlMark
 */
class Mark extends AbstractQuery{

	private $html;
	private $markdown;

	public function __construct(string $html){

		$this->converter = new \League\HTMLToMarkdown\HtmlConverter();

		$this->markdown = $this->converter->convert($html);

		$this->doc = new \DOMDocument();
		$this->doc->loadHTML($html);
	}

	public static function create(string $html){

		return new self($html);
	}

	/**
	 * From html file
	 */
	public static function fromHtmlFile(string $filename){

		return new self(Fs::cat($filename));
	}

	public function getMarkdown(){

		return $this->markdown;
	}
}