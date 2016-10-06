<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/5/16
 * Time: 9:28 PM
 */

namespace Alquemedia_PostREST;


class String_Object {

    /**
     * @var string representation of object
     */
    protected $stringRepresentation = '';

    /**
     * @return string representation
     */
    public function __toString() {

        return (string) $this->stringRepresentation;

    }

}