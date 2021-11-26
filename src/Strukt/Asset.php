<?php

namespace Strukt;

use RecursiveDirectoryIterator as RecDirItr;
use RecursiveIteratorIterator as RecItrItr;

use Strukt\Fs;

class Asset{

	public function __construct(string $base_dir, string $dir_path){

		$abs_dir = sprintf("%s".DIRECTORY_SEPARATOR."%s", $base_dir, $dir_path);

		$dItr = new RecDirItr($abs_dir);
		$rItrItr  = new RecItrItr($dItr, RecItrItr::SELF_FIRST);

		foreach ($rItrItr as $file) {

		    if($file->isFile()){		    	

		    	$dir_path = DIRECTORY_SEPARATOR.$dir_path;
		    	$uri = str_replace(array($base_dir, $dir_path), "", $file->getRealPath());

		    	$this->files[$uri] = $file; 
		    }
		}
	}

	public function exists($filepath){

		return array_key_exists($filepath, $this->files);
	}

	/**
	 * getObject
	 */
	public function getInfo($filepath){

		return $this->files[$filepath];
	}

	/**
	 * getContents
	 */
	public function get($filepath){

		return Fs::cat($this->get($filepath)->getRealPath());
	}
}