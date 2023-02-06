<?php

namespace App\Provider;

use Strukt\Asset as AssetFinder;
use Strukt\Event;
use Strukt\Contract\Provider\AbstractProvider;
use Strukt\Contract\Provider\ProviderInterface;
use Strukt\Env;

/**
* @Name(strukt.asset)
*/
class Asset extends AbstractProvider implements ProviderInterface{ 

	public function __construct(){

		$root_dir = Env::get("root_dir");
		$static_dir = Env::get("rel_static_dir");

		$this->core()->set("strukt.asset", new AssetFinder($root_dir, $static_dir));
	}

	public function register(){

		$this->core()->set("strukt.service.asset", new Event(function($root_dir, $static_dir){

			return new AssetFinder($root_dir, $static_dir);
		}));	
	}
}

