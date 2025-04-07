<?php

use Gumlet\ImageResize;

use App\Provider\Asset as AssetProvider;
use Strukt\Core\Registry;
use Strukt\Fs;
use Strukt\Env;

class AssetProviderTest extends PHPUnit\Framework\TestCase{

	public function setUp():void{

		$assetProvider = new AssetProvider();
		$assetProvider->register();
	}

	public function testAssetCoreFinder(){

		$provider = event("provider.asset")->exec();
		$asset_ls = $provider->ls();

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

		$service = event("service.asset")->applyArgs([env("root_dir"), "package"])->exec();
		$asset_ls = $service->ls();

		$ls = [

	     	"/lib/App/Provider/Asset.php",
	     	"/lib/App/Middleware/Asset.php",
	     	"/lib/App/Command/Asset/MarkdownToHtml.php",
	   	];

		sort($asset_ls);
		sort($ls);

		$this->assertEquals($asset_ls, $ls);
	}
}