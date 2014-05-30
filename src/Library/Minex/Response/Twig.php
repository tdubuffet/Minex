<?php
/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 15:37
 */

namespace Minex\Response;


class Twig {

    private $twig           = null;
    static  $dirTemplate    = array();

    public function __construct($templateName, $params = array())
    {

        $uri = new \Minex\Http\Uri();

        \Minex\Autoloader::addExceptionLoad('Twig');

        self::addDirTemplate(_PATH_ROOT_. 'src' .DIRECTORY_SEPARATOR .'View' .  DIRECTORY_SEPARATOR . ucfirst($uri->getController()) . DIRECTORY_SEPARATOR);
        self::addDirTemplate(_PATH_ROOT_. 'src' .DIRECTORY_SEPARATOR .'View' .  DIRECTORY_SEPARATOR . 'Layout' . DIRECTORY_SEPARATOR);

        $this->initTwig()
             ->render($templateName, $params);

    }

    static function addDirTemplate($dirPath)
    {
        if (file_exists($dirPath)) {
            self::$dirTemplate[] = $dirPath;
        }
    }

    static function getDirTemplate()
    {
        return self::$dirTemplate;
    }

    public function initTwig()
    {
        if (is_null($this->twig)) {

            require_once 'Twig/Autoloader.php';

            \Twig_Autoloader::register();

            $loader = new \Twig_Loader_Filesystem(self::$dirTemplate);

            $this->twig = new \Twig_Environment($loader, array(
                'cache' => _PATH_ROOT_ . "cache",
                'debug' => true
            ));

        }

        return $this;
    }

    public function render($templateName, $params = array())
    {
        echo $this->twig->render($templateName, $params);
    }

} 