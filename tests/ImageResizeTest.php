<?php

use Gumlet\ImageResize;
use Strukt\Fs;

class ImageResizeTest extends PHPUnit\Framework\TestCase{

	public function testImageScale(){

		$success = true;

		try{

			$image = new ImageResize('fixtures/static/images/logo.png');
			$image->scale(50);
			$image->save("fixtures/static/images/logo-resized.png");

			$this->assertTrue($success);
		}
		catch(\Exception $e){

			$this->assertFalse(!$success);
		}
		finally{

			Fs::rm("fixtures/static/images/logo-resized.png");
		}
	}
}