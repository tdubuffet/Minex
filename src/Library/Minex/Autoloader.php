<?php

namespace Minex;

class Autoloader{

    public function __construct()
    {
        $this->setIncludePath();
    }

    public function init()
    {
        \Minex\Autoloader::register();
    }

    public function getIncludePath()
    {
        return get_include_path();
    }

    public function setIncludePath()
    {
        $src = __DIR__ . '/../../';
        $minex = $src . 'Library/';

        if (!defined('_PATH_SRC_')) {
            define('_PATH_SRC_', $src);
        }

        set_include_path(implode(':', array(
            get_include_path(),
            $src,
            $minex
        )));

        return $this;
    }

    static public function register()
    {
        spl_autoload_register(array(__CLASS__, '__autoload'));
    }

    static function __autoload($class)
    {

        $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

        $filePath =  $class . '.php';

        require_once $filePath;

    }

    static function ifClassExist($class)
    {
        $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

        $filePath =  $class . '.php';

        if (\file_exists(_PATH_SRC_ . $filePath)) {
            return true;
        }

        return false;
    }

}