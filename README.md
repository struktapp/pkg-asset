Strukt Asset
===

## Installation

```sh
composer require strukt/pkg-asset:v1.0.8-alpha
```

If need be you need to install the middlewares, providers and commands:

```sh
./xcli publish:package pkg-asset
```

## Usage

### Environment Variables

You may put a reference in `.env` for your static directory.

```env
rel_static_dir = static
```

You will also need to make sure you bootstrap.

```php
Env::withFile(".env");
env("root_dir", getcwd());
```

### Simple Asset Manager

```php
// $finder = new \Strukt\Asset($root_dir, $static_dir);
// $finder = asset($root_dir, $static_dir);
$finder = asset();
$finder->exists("/js/script.js");
$finder->getInfo("/js/script.js");//SplFileInfo
$finder->get("/js/script.js");//returns contents of file
```

### Image Resize

```php
$image = new \Gumlet\ImageResize();
$image = new \Gumlet\ImageResize('image.jpg');
$image->scale(50);
$image->save('image2.jpg')

$image = new \Gumlet\ImageResize('image.jpg');
$image->resizeToHeight(500);
$image->save('image2.jpg')
```

## Credits

For more on `Gumlet` see [Gumlet/ImageResize](https://github.com/gumlet/php-image-resize) on Github.