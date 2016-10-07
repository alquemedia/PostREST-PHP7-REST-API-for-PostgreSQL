<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/6/16
 * Time: 10:45 PM
 */

namespace Alquemedia_PostREST\Components\SQL;


use Alquemedia_PostREST\Components\Models\Primary_Key;
use Alquemedia_PostREST\String_Object;

/**
 * Class WHERE_Clause
 * @package Alquemedia_PostREST\Components\SQL
 *
 * Gets a SQL Where Clause
 */
class WHERE_Clause extends String_Object{

    /**
     * WHERE_Clause constructor.
     * @param $modelName
     * @param int $primaryKey
     */
    public function __construct( $modelName, $primaryKey = 0 ) {

        $clause = "TRUE";

        if ( $primaryKey )

            $clause = new Primary_Key($modelName ). ' = '. $primaryKey;

        $this->stringRepresentation = $clause;

    }
}