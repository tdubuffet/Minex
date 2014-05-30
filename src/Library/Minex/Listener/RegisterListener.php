<?php

namespace Minex\Listener;

/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 11:37
 */

/**
 * Class RegisterListener
 * Permet d'enregistrer des Listener
 */
class RegisterListener
{

    private $listener = array();

    public function addListener($obj)
    {
        $this->listener[] = $obj;
    }

    public function checkListener()
    {
        foreach($this->listener as $listener) {
            $listener->checkListener();
        }
    }

}