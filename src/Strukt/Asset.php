<?php

namespace Strukt;

use RecursiveDirectoryIterator as RecDirItr;
use RecursiveIteratorIterator as RecItrItr;

use Strukt\Fs;

class Asset{

	private $files;

	/**
	 * @param string $base_dir -- root/base directory
	 * @param string $dir_path -- relative/static directory
	 */
	public function __construct(string $base_dir, string $dir_path){

		$abs_dir = sprintf("%s".DIRECTORY_SEPARATOR."%s", $base_dir, $dir_path);

		$dItr = new RecDirItr($abs_dir);
		$rItrItr  = new RecItrItr($dItr, RecItrItr::SELF_FIRST);

		foreach ($rItrItr as $file) {

		    if($file->isFile()){		    	

		    	$uri = str_replace(array($base_dir, $dir_path), "", $file->getRealPath());
		    	$uri = str_replace(array ("//", "\\"), DIRECTORY_SEPARATOR, $uri);
		    	// $uri = ltrim($uri, DIRECTORY_SEPARATOR); //remove leading slash

		    	$this->files[$uri] = $file; 
		    }
		}
	}

	/**
	 * @param string $filepath
	 * 
	 * @return bool
	 */
	public function exists(string $filepath):bool{

		return array_key_exists($filepath, $this->files);
	}

	/**
	 * Get file details
	 * 
	 * @param string $filepath
	 * 
	 * @return \SplFileInfo
	 */
	public function getInfo($filepath):\SplFileInfo{

		return $this->files[$filepath];
	}

	/**
	 * Get contents
	 * 
	 * @param string $filepath
	 * 
	 * @return string
	 */
	public function get(string $filepath):string{

		if($this->exists($filepath))
			return Fs::cat($this->files[$filepath]->getRealPath());

		throw new \Exception(sprintf("Asset: File [%s] does not exist!", $filepath));		
	}

	/**
	 * List paths
	 * 
	 * @param ?string $pattern
	 * 
	 * @return array
	 */
	public function ls(?string $pattern = null):array{

		if(!is_null($pattern)){

			$found = [];

			foreach($this->files as $key=>$value)
				if(preg_match(sprintf("/%s/", $pattern), $key))
					$found[] = $key;

			return $found;
		}

		return array_keys($this->files);
	}
}