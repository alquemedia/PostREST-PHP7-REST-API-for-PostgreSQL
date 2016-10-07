<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/6/16
 * Time: 10:48 PM
 */

namespace Alquemedia_PostREST\Components\Models;


use Alquemedia_PostREST\String_Object;

/**
 * Class Primary_Key
 * @package Alquemedia_PostREST\Components\Models
 *
 * Gets the column name that is the primary key
 */
class Primary_Key extends String_Object {

    /**
     * Primary_Key constructor.
     * @param $modelName
     */
    public function __construct( $modelName ) {

        $this->stringRepresentation = "$modelName"."_id";

    }
}