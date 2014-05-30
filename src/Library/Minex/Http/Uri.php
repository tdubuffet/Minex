<?php
/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 16:03
 */

namespace Minex\Http;


class Uri {

    private $uri;
    private $controller;
    private $action;
    private $get;

    function __construct()
    {

        $this->pattern();


    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $get
     */
    public function setGet($get)
    {
        $this->get = $get;
    }

    /**
     * @return mixed
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }



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
}