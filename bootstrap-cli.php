<?php

ini_set('display_errors', '1');
ini_set("date.timezone", "Africa/Nairobi");

error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

$loader = require __DIR__.'/vendor/autoload.php';
$loader->add('App', __DIR__.'/package/lib/');
$loader->add('Strukt', __DIR__.'/package/src/');

Strukt\Env::set("root_dir", __DIR__);
Strukt\Env::set("rel_static_dir", "fixtures");

$core = Strukt\Core\Registry::getSingleton();

$assetProvider = new App\Provider\Asset();
$assetProvider->register();

// new App\Middleware\Asset();