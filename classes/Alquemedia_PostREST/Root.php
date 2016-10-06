<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/5/16
 * Time: 8:34 PM
 */

namespace Alquemedia_PostREST;


class Root {

    /**
     * @return string Root
     */
    public function __toString() {

        return $_SERVER['DOCUMENT_ROOT'];

    }
}