<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/5/16
 * Time: 9:27 PM
 */

namespace Alquemedia_PostREST;


/**
 * Class Data_Source_Name
 * @package Alquemedia_PostREST
 *
 * Data Source Name to connect to DB
 */
class Data_Source_Name extends String_Object{

    /**
     * Data_Source_Name constructor.
     * @param JSON_File $dbConfig
     */
    public function __construct( JSON_File $dbConfig ) {

        $this->stringRepresentation = "pgsql:host=$dbConfig->hostname;port=5432;dbname=$dbConfig->database";

    }
}