<?php namespace Alquemedia_PostREST\Components\Models;
use Alquemedia_PostREST\Components\Database\Database;
use Alquemedia_PostREST\Components\SQL\Select_Statement;


/**
 * Class Model
 * @package Alquemedia_PostREST\Components\Models
 *
 * A Model is a single instance of a data record
 */
class Model {

    /**
     * @var array of data members
     */
    private $members = [];

    /**
     * Model constructor.
     * @param $modelName
     * @param int $recordId
     */
    public function __construct( $modelName, $recordId = 0 ) {

        $this->members = (new Database())->query( new Select_Statement($modelName,$recordId))

            ->fetchAll( \PDO::FETCH_ASSOC );

    }

    /**
     * @return array of members
     */
    public function asArray(){ return $this->members; }

}