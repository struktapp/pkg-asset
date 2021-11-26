<?php

namespace Strukt\Middleware;

use Strukt\Contract\ResponseInterface;
use Strukt\Http\Response;
use Strukt\Http\Request;
use Strukt\Asset as AssetFinder;
use Strukt\Core\Registry;
use Strukt\Contract\MiddlewareInterface;
use Strukt\Contract\AbstractMiddleware;
use Strukt\Env;

class Asset extends AbstractMiddleware implements MiddlewareInterface{

	private $finder;

	public function __construct(){

		$root_dir = Env::get("root_dir");
		$static_dir = Env::get("rel_static_dir");

		$this->finder = new AssetFinder($root_dir, $static_dir);

		$this->core()->set("assets", $this->finder);
	}

	public function __invoke(Request $request, ResponseInterface $response, callable $next){

		$uri = $request->getRequestUri();

		if($this->finder->exists($uri)){

			$contents = $this->finder->get($uri);

			$headers = $response->headers->all();

			return new Response($contents, 200, $headers);
		}

		return $next($request, $response);
	}
}