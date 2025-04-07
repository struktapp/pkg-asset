<?php

namespace Strukt\Html;

use Strukt\Type\Str;
use Strukt\Fs;

/**
 * HtmlXpath
 */
class Xpath extends AbstractQuery{

	private $html;

	/**
	 * @param string $html
	 */
	public function __construct(string $html){

		$this->html = $html;

		$this->doc = new \DOMDocument();
		$this->doc->loadHTML($this->html);
	}

	/**
	 * @param string $html
	 * 
	 * @return static
	 */
	public static function create(string $html):static{

		return new self($html);
	}

	/**
	 * From HTML Snippet
	 * 
	 * @param string $html
	 * 
	 * @return static
	 */
	public static function withSnip(string $html):static{

		return new self(sprintf("<html>%s</html>", $html));
	}

	/**
	 * From Markdown File
	 * 
	 * @param string $filename
	 * 
	 * @return static
	 */
	public static function fromMarkFile(string $filename):static{

		$pd = new \Parsedown();
		$html = $pd->text(mb_convert_encoding(Fs::cat($filename), "HTML-ENTITIES", 'UTF-8'));

		return new self($html);
	}

	/**
	 * From Markdown File - No Encoding
	 * 
	 * @param string $filename
	 * 
	 * @return static
	 */
	public static function fromMarkFileNoEnc(string $filename):static{

		$pd = new \Parsedown();
		$html = $pd->text(Fs::cat($filename));

		return new self($html);
	}

	/**
	 * @return string
	 */
	public function rawHtml(){

		return (string)$this->html;
	}

	/**
	 * @return string
	 */
	public function html(){

		return str_replace(array("<html>", "</html>"), "", $this->rawHtml());
	}
}