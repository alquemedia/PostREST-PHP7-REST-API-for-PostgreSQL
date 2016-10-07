<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/6/16
 * Time: 10:06 PM
 */

namespace Alquemedia_PostREST\Components\SQL;


use Alquemedia_PostREST\String_Object;

/**
 * Class Select_Statement
 * @package Alquemedia_PostREST\Components\SQL
 *
 * A SELECT Statement
 */
class Select_Statement extends String_Object{

    /**
     * Select_Statement constructor.
     * @param string $modelName
     */
    public function __construct( $modelName ) {

        $this->stringRepresentation = "SELECT * FROM $modelName WHERE TRUE LIMIT ". (new SQL_Settings())

            ->selectLimit();
    }
}