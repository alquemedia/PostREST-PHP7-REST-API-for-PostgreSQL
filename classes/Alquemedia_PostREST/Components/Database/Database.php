<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/6/16
 * Time: 10:35 PM
 */

namespace Alquemedia_PostREST\Components\Database;


use Alquemedia_PostREST\Data_Source_Name;
use Alquemedia_PostREST\JSON_File;

class Database {

    private $db;

    /**
     * Database constructor.
     */
    public function __construct() {

        $dbConfig = (new JSON_File('database'));

        $this->db = new \PDO((string) new Data_Source_Name($dbConfig),$dbConfig->username,$dbConfig->password);

    }

    /**
     * @param $querySQL
     * @return \PDOStatement
     */
    public function query( $querySQL ){

        return $this->db->query( $querySQL );

    }

}