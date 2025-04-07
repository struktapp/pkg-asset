<?php

use Strukt\Env;

$loader = require __DIR__.'/vendor/autoload.php';

Env::withFile(".env");
env("root_dir", getcwd());

// Strukt\Core\Registry::getSingleton();
$assetProvider = new App\Provider\Asset();
$assetProvider->register();