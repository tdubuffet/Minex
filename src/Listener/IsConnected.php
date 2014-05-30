<?php

namespace Listener;

/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 11:36
 */
use Minex\Listener\AbstractListener;

/**
 * Class IsConnected
 * @package Listener
 *
 * Permet de tester si l'utilisateur est connecté sinon il est redirigé
 */
class IsConnected extends AbstractListener
{
    /**
     * Vérifie le listener
     * @return bool
     */
    public function action()
    {

        $uri = new \Minex\Http\Uri();

        if ( !isset($_SESSION['admin_id']) && $uri->getController() != 'user' && $uri->getAction() != 'login') {
            return true;
        }

        return false;
    }

    /**
     *  Action si invalide
     */
    public function notCheked()
    {
        \Minex\Request\Request::redirect("/user/login");
        exit;
    }

}