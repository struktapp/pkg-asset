<?php

namespace Strukt\Package;

/**
* @author Moderator <pitsolu@gmail.com>
*/
class PkgAsset implements \Strukt\Framework\Contract\Package{

	private $manifest;

	public function __construct(){

		$this->manifest = array(

			"cmd_name"=>"Asset",
			"package"=>"pkg-asset",
			"files"=>array(

				"lib/App/Provider/Asset.php",
				"lib/App/Middleware/Asset.php",
				"lib/App/Command/Asset/MarkdownToHtml.php"
			)
		);
	}

	/**
	 * @return void
	 */
	public function preInstall():void{
		
		//
	}

	/**
	 * @param string $type
	 * 
	 * @return array
	 */
	public function getSettings(string $type):array{

		$settings = array(

			"App:Cli"=>array(

				"providers"=>array(

					\App\Provider\Asset::class
				),
				"middlewares"=>array(

					\App\Middleware\Asset::class
				),
				"commands"=>array(

					\App\Command\Asset\MarkdownToHtml::class
				)
			),
			"App:Idx"=>array(

				"providers"=>array(

					\App\Provider\Asset::class
				),
				"middlewares"=>array(

					\App\Middleware\Asset::class
				)
			)
		);

		return $settings[$type];
	}

	/**
	 * @return string
	 */
	public function getName():string{

		return $this->manifest["package"];
	}

	/**
	 * @return string
	 */
	public function getCmdName():string{

		return $this->manifest["cmd_name"];
	}

	/**
	 * @return array|null
	 */
	public function getFiles():array|null{

		return $this->manifest["files"];
	}

	/**
	 * @return array|null
	 */
	public function getModules():array|null{

		return null;
	}

	/**
	* Use php's class_exists function to identify a class that indicated your package is installed
	* 
	* @return bool
	*/
	public function isPublished():bool{

		return class_exists(\App\Command\Asset\MarkdownToHtml::class);
	}

	/**
	 * @return array|null
	 */
	public function getRequirements():array|null{

		return null;
	}

	/**
	 * @return void
	 */
	public function postInstall():void{

		//
	}

	/**
	 * @return bool
	 */
	public function remove():bool{

		raise("Unimplemented!");
	}
}