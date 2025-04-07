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
	private $converter;

	/**
	 * @param string $html
	 */
	public function __construct(string $html){

		$this->converter = new \League\HTMLToMarkdown\HtmlConverter();

		$this->markdown = $this->converter->convert($html);

		$this->doc = new \DOMDocument();
		$this->doc->loadHTML($html);
	}

	/**
	 * @param strng $html
	 * 
	 * @return static
	 */
	public static function create(string $html):static{

		return new self($html);
	}

	/**
	 * From html file
	 * 
	 * @param string $filename
	 * 
	 * @return static
	 */
	public static function fromHtmlFile(string $filename):static{

		return new self(Fs::cat($filename));
	}

	public function getMarkdown(){

		return $this->markdown;
	}
}