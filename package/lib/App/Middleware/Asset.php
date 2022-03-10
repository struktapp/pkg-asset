<?php

namespace App\Middleware;

use Strukt\Contract\ResponseInterface;
use Strukt\Contract\RequestInterface;
use Strukt\Http\Response\Plain as Response;
use Strukt\Http\Request;
use Strukt\Core\Registry;
use Strukt\Contract\Middleware\MiddlewareInterface;
use Strukt\Contract\Middleware\AbstractMiddleware;
use Strukt\Env;

class Asset extends AbstractMiddleware implements MiddlewareInterface{

	private $finder;

	public function __construct(){

		$this->finder = $this->core()->get("app.asset");
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