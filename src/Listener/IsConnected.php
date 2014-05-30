<?php

namespace Listener;

/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 11:36
 */

/**
 * Class IsConnected
 * @package Listener
 *
 * Permet de tester si l'utilisateur est connecté sinon il est redirigé
 */
class IsConnected
{
    /**
     * Vérifie le listener
     * @return bool
     */
    public function action()
    {
        if ( isset($_SESSION['admin_id'])) {
            return true;
        }

        return false;
    }

    /**
     *  Action si invalide
     */
    public function notCheked()
    {
        \Minex\Request\Request::redirect("/page/login");
        exit;
    }

}