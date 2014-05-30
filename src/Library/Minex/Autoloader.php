<?php

namespace Minex;

class Autoloader{

    static $ExceptionLoad = array();

    public function __construct()
    {
        $this->setIncludePath();
    }

    static function addExceptionLoad($value)
    {
        self::$ExceptionLoad[] = $value;
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

        if (!defined('_PATH_ROOT_')) {
            define('_PATH_ROOT_', $src . '../');
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
        $loadFile = true;

        if (count(self::$ExceptionLoad) > 0) {
            $stringRegex = implode('|', self::$ExceptionLoad);

            if ( preg_match('#('.$stringRegex.')#', $class) ) {
                $loadFile = false;
            }
        }
        if ( $loadFile ) {

            $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

            $filePath =  $class . '.php';

            require_once $filePath;
        }

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