<?php

namespace App\Provider;

use Strukt\Asset as AssetFinder;
use Strukt\Event;
use Strukt\Contract\AbstractProvider;
use Strukt\Contract\ProviderInterface;
use Strukt\Env;

class Asset extends AbstractProvider implements ProviderInterface{ 

	public function __construct(){

		$root_dir = Env::get("root_dir");
		$static_dir = Env::get("rel_static_dir");

		$this->core()->set("app.asset", new AssetFinder($root_dir, $static_dir));
	}

	public function register(){

		$this->core()->set("app.service.asset", new Event(function($root_dir, $static_dir){

			return new AssetFinder($root_dir, $static_dir);
		}));	
	}
}

