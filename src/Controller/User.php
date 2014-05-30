<?php
/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 14:35
 */

namespace Controller;

use \Minex\Core\Core as Core;

class User extends Core{

    /**
     * Action Login
     *
     * @return \Minex\Response\Twig
     */
    public function login()
    {


        return new \Minex\Response\Twig('login.twig');
    }

    public function test()
    {

    }

} 