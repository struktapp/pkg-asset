<?php

use Strukt\Env;

ini_set('display_errors', '1');
ini_set("date.timezone", "Africa/Nairobi");

error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

$loader = require __DIR__.'/vendor/autoload.php';

Env::withFile(".env");
env("root_dir", getcwd());

Strukt\Core\Registry::getSingleton();
$assetProvider = new App\Provider\Asset();
$assetProvider->register();