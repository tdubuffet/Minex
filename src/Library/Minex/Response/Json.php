<?php
/**
 * Created by PhpStorm.
 * User: tdubuffet
 * Date: 30/05/14
 * Time: 17:17
 */

namespace Minex\Response;


class Json {


    function __construct($jsonData = array())
    {

        $this->sendHeaders()
             ->arrayToJson($jsonData);

        exit;

    }

    public function arrayToJson($jsonData)
    {
        echo \json_encode($jsonData);

        return $this;
    }

    public function sendHeaders()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        return $this;
    }
}