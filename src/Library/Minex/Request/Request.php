<?php

namespace Minex\Request;

/**
 * Class Request
 */
class Request
{

    private $routing    = null;

    private $autoloader = null;

    private $listener   = null;

    public function __construct()
    {
        $this->initAutoloader()
             ->initListener()
             ->initRouting();

        //$this->getListener()->checkListener();

    }

    public function initListener()
    {
        if ( is_null($this->listener) ) {
            $this->listener = new \Minex\Listener\RegisterListener();

            $this->listener
                 ->addListener(new \Listener\IsConnected());
        }

        return $this;
    }

    public function initRouting()
    {
        if ( is_null($this->routing) ) {

            $this->routing = new \Minex\Request\Routing();
            try{
                $this->routing->callClassMethod($this);
            } catch (\Exception $e) {
                echo 'Exception: ' . $e->getMessage();
                exit;
            }

        }

        return $this;
    }

    public function initAutoloader()
    {
        if ( is_null($this->autoloader) )
        {
            $this->autoloader = new \Minex\Autoloader();
        }

        return $this;
    }

    static function redirect($uri)
    {
        header('Location: ' . $uri);
    }

    /**
     * @param null $autoloader
     */
    public function setAutoloader($autoloader)
    {
        $this->autoloader = $autoloader;
    }

    /**
     * @return null
     */
    public function getAutoloader()
    {
        return $this->autoloader;
    }

    /**
     * @param null $routing
     */
    public function setRouting($routing)
    {
        $this->routing = $routing;
    }

    /**
     * @return null
     */
    public function getRouting()
    {
        return $this->routing;
    }

    /**
     * @param null $listener
     */
    public function setListener($listener)
    {
        $this->listener = $listener;
    }

    /**
     * @return null
     */
    public function getListener()
    {
        return $this->listener;
    }
}