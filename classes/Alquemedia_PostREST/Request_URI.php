<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/5/16
 * Time: 9:14 PM
 */

namespace Alquemedia_PostREST;


class Request_URI {

    /**
     * @param $partNumber
     * @return string Part number
     */
    public function part( $partNumber ){

        return (string) @explode('/',$_SERVER['REQUEST_URI'])[$partNumber];

    }

}