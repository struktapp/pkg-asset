<?php

namespace Strukt\Html;

use Strukt\Type\Str;
use Strukt\Fs;

/**
 * HtmlXpath
 */
class Xpath extends AbstractQuery{

	private $html;

	public function __construct(string $html){

		$this->html = $html;

		$this->doc = new \DOMDocument();
		$this->doc->loadHTML($this->html);
	}

	public static function create(string $html){

		return new self($html);
	}

	/**
	 * From HTML Snippet
	 */
	public static function withSnip(string $html){

		return new self(sprintf("<html>%s</html>", $html));
	}

	/**
	 * From Markdown File
	 */
	public static function fromMarkFile(string $filename){

		$pd = new \Parsedown();
		$html = $pd->text(mb_convert_encoding(Fs::cat($filename), "HTML-ENTITIES", 'UTF-8'));

		return new self($html);
	}

	/**
	 * From Markdown File - No Encoding
	 */
	public static function fromMarkFileNoEnc(string $filename){

		$pd = new \Parsedown();
		$html = $pd->text(Fs::cat($filename));

		return new self($html);
	}

	public function rawHtml(){

		return (string)$this->html;
	}

	public function html(){

		return str_replace(array("<html>", "</html>"), "", $this->rawHtml());
	}
}