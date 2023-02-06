<?php

use Gumlet\ImageResize;

use App\Provider\Asset as AssetProvider;
use Strukt\Core\Registry;
use Strukt\Fs;
use Strukt\Env;

class AssetProviderTest extends PHPUnit\Framework\TestCase{

	public function setUp():void{

		$core = Registry::getSingleton();

		if(!$core->exists("strukt")){

			$assetProvider = new AssetProvider();
			$assetProvider->register();
		}
	}

	public function testAssetCoreFinder(){

		$core = Registry::getSingleton();

		$asset_ls = $core->get("strukt.asset")->ls();

		$ls = [
			
			"/errors/500.html",
			"/errors/404.html",
			"/errors/405.html",
			"/errors/403.html",
			"/static/index.html",
			"/static/images/logo.png",
			"/static/css/style.css",
			"/static/js/script.js"
	   ];

	   sort($asset_ls);
	   sort($ls);

		$this->assertEquals($asset_ls, $ls);
	}

	public function testAssetProvider(){

		$rootDir = Env::get("root_dir");

		$core = Registry::getSingleton();

		$asset_ls = $core->get("strukt.service.asset")->apply($rootDir, "package")->exec()->ls();

		$this->assertEquals($asset_ls, [

	     	"/lib/App/Provider/Asset.php",
	     	"/lib/App/Middleware/Asset.php",
	     	"/lib/App/Command/Asset/MarkdownToHtml.php"
	   	]);
	}
}