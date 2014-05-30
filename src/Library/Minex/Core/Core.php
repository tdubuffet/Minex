<?php
/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 14:32
 */

namespace Minex\Core;


abstract class Core {

    private $request = null;

    private $uri     = null;

    public function __construct()
    {
        $this->initUri();
    }

    public function initUri()
    {
        if ( is_null($this->uri) ) {
            $this->uri = new \Minex\Http\Uri();
        }

        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Récupére un paramètre GET ou POST
     *
     * @param $name nom de la valeur
     * @param null $defaultValue valeur par default
     * @return null
     */
    public function getParam($name, $defaultValue = null)
    {
        $param = $defaultValue;

        if ( isset($_GET[$name]) ) {
            $param = $_GET[$name];
        }

        $getRouting = $this->getRequest()->getRouting()->getGet();

        if ( isset($getRouting[$name]) ) {
            $param = $getRouting[$name];
        }

        if ( isset($_POST[$name]) ) {
            $param = $_POST[$name];
        }

        return $param;
    }

    /**
     * Retourne tous les paramètes (GET|POST)
     *
     * @return array
     */
    public function getAllParams()
    {
        $params = array();

        foreach($_GET as $key => $get) {
            $params[$key] = $get;
        }

        $getRouting = $this->getRequest()->getRouting()->getGet();

        foreach($getRouting as $key => $get) {
            $params[$key] = $get;
        }

        foreach($_POST as $key => $get) {
            $params[$key] = $get;
        }

        return $params;
    }

    /**
     * @param null $request
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return null
     */
    public function getRequest()
    {
        return $this->request;
    }



} 