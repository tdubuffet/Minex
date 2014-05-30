<?php

    ini_set('display_errors', 1);
    error_reporting(~0);

    require __DIR__ . '/../src/Library/Minex/Autoloader.php';

    $autoloader = new \Minex\Autoloader();

    $autoloader->init();

    $request = new \Minex\Request\Request();
