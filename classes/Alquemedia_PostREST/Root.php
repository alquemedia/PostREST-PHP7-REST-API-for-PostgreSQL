<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/5/16
 * Time: 8:34 PM
 */

namespace Alquemedia_PostREST;


/**
 * Class Root
 * @package Alquemedia_PostREST
 *
 * Root of Application
 */
class Root extends String_Object{

    public function __construct() {

        $this->stringRepresentation = $_SERVER['DOCUMENT_ROOT'];

    }
}