Strukt Asset
===

### Simple Asset Manager

```php
$finder = new Asset($root_dir, $static_dir);
$finder->exists("/js/script.js");
$finder->getInfo("/js/script.js");//SplFileInfo
$finder->get("/js/script.js");//returns contents of file
```

### Image Resize

```php
$image = new \Gumlet\ImageResize();
$image = new ImageResize('image.jpg');
$image->scale(50);
$image->save('image2.jpg')

$image = new ImageResize('image.jpg');
$image->resizeToHeight(500);
$image->save('image2.jpg')
```

For more on `Gumlet` see [Gumlet/ImageResize](https://github.com/gumlet/php-image-resize) on Github.