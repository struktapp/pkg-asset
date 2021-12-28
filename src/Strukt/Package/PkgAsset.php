<?php

namespace Strukt\Package;

use Strukt\Contract\Package as Pkg;

class PkgAsset implements Pkg{

	private $manifest;

	public function __construct(){

		$this->manifest = array(

			"cmd_name"=>"Asset",
			"package"=>"pkg-asset",
			"files"=>array(

				"lib/App/Provider/Asset.php",
				"lib/App/Middleware/Asset.php"
			)
		);
	}

	public function getSettings($type){

		$settings = array(

			"App:Cli"=>array(

				"providers"=>array(

					App\Provider\Asset::class
				),
				"middlewares"=>array(

					App\Middleware\Asset::class
				)
			),
			"App:Idx"=>array(

				"providers"=>array(

					App\Provider\Asset::class
				),
				"middlewares"=>array(

					App\Middleware\Asset::class
				)
			)
		);

		return $settings[$type];
	}

	public function getName(){

		return $this->manifest["package"];
	}

	public function getCmdName(){

		return $this->manifest["cmd_name"];
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