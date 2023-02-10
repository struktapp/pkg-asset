<?php

namespace App\Middleware;

use Strukt\Contract\Http\ResponseInterface;
use Strukt\Contract\Http\RequestInterface;
use Strukt\Http\Response\Plain as Response;
use Strukt\Contract\Middleware\MiddlewareInterface;
use Strukt\Contract\Middleware\AbstractMiddleware;

/**
* @Name(asset)
* @Requires(strukt.asset)
*/
class Asset extends AbstractMiddleware implements MiddlewareInterface{

	private $finder;

	public function __construct(){

		$this->finder = $this->core()->get("strukt.asset");
	}

	public function __invoke(RequestInterface $request, 
								ResponseInterface $response, 
								callable $next){

		$uri = $request->getRequestUri();

		if($this->finder->exists($uri)){

			$contents = $this->finder->get($uri);
			$fileinfo = $this->finder->getInfo($uri);

			if($fileinfo->getExtension() == "css")
				$headers = array("Content-type"=>"text/css");
			else
				$headers = $response->headers->all();

			return new Response($contents, 200, $headers);
		}

		return $next($request, $response);
	}
}