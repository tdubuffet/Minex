<?php

namespace Minex\Listener;

/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 11:38
 */

class AbstractListener {

    private $request = null;

    /**
     * @param null $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return null
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function notCheked()
    {
        return null;
    }

    public function action()
    {
        return false;
    }

    public function checkListener()
    {

        if ( $this->action() ) {

            $this->notCheked();
        }
    }

} 