<?php

namespace Strukt\Package;

use Strukt\Contract\Package as Pkg;

class PkgAsset implements Pkg{

	private $manifest;

	public function __construct(){

		$this->manifest = array(

			"package"=>"pkg-asset",
			"files"=>array(

				"lib/App/Provider/Asset.php",
				"lib/App/Middleware/Asset.php"
			)
		);
	}

	public function getName(){

		return $this->manifest["package"];
	}

	public function getFiles(){

		return $this->manifest["files"];
	}

	public function getModules(){

		return null;
	}

	public function isPublished(){

		return class_exists(\Strukt\Asset::class);
	}
}