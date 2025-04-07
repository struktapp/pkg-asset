<?php

namespace App\Provider;

use Strukt\Asset as AssetFinder;
use Strukt\Event;
use Strukt\Contract\ProviderInterface;
use Strukt\Env;

/**
* @Name(strukt.asset)
*/
class Asset implements ProviderInterface{ 

	public function __construct(){

		event("provider.asset", fn()=>new AssetFinder(env("root_dir"), env("rel_static_dir")));
	}

	/**
	* @return void
	*/
	public function register():void{

		event("service.asset", function($root_dir, $static_dir){

			return new AssetFinder($root_dir, $static_dir);
		});	
	}
}

