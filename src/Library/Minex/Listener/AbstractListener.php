<?php

namespace Minex\Listener;

/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 11:38
 */

class AbstractListener {


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
        if (!$this->action() ) {

            $this->notCheked();

            return false;
        }

        return true;
    }

} 