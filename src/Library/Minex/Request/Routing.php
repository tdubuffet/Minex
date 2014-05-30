<?php

namespace Minex\Request;

class Routing {

    private $uri        = null;
    private $controller = null;
    private $action       = null;
    private $get        = array();

    public function __construct()
    {
        $this->pattern();

    }

    /**
     * @param null $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return null
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param null $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return null
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param array $get
     */
    public function setGet($get)
    {
        $this->get = $get;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @param null $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return null
     */
    public function getUri()
    {
        return $this->uri;
    }


    /**
     * Découpe l'url pour récupérer le controller, l'action et les gets
     * @return $this
     */
    public function pattern()
    {
        $uri = explode('/', substr($_SERVER['REQUEST_URI'],1));

        $this->uri          = $uri;

        $this->controller   = ( (isset($uri[0]) && $uri[0] == "") || (!isset($uri[0]) ) ) ? 'home' : $uri[0];
        $this->action       = ( (isset($uri[1]) && $uri[1] == "") || (!isset($uri[1]) ) ) ? 'index' : $uri[1];

        if (count($uri) > 2) {
            for($i=2; $i<count($uri); $i = $i+2) {

                if (isset($uri[$i]) && isset($uri[$i+1])) {
                    $this->get[$uri[$i]] = $uri[$i+1];
                }

            }
        }

        return $this;
    }


    /**
     * Appel la classe et la méthod en fonction de l'uri
     *
     * @return $this
     * @throws \Exception
     */
    public function callClassMethod($context)
    {

        $nameClass = "\Controller\\" . ucfirst($this->controller) ;

        if (\Minex\Autoloader::ifClassExist($nameClass)) {
            $loadClass = new $nameClass();

            if (method_exists($loadClass, $this->action))
            {

                $loadClass->setRequest($context);

                call_user_func_array(array($loadClass, $this->action), array());
            } else {
                throw new \Exception('Method not exist - #\Model\Routing - callClassMethod()- Controller: ' . $this->controller . ' Action: ' . $this->action);
            }

        } else {
            throw new \Exception('Class not exist - #\Model\Routing - callClassMethod() - Controller: ' . $this->controller);
        }

        return $this;
    }

}