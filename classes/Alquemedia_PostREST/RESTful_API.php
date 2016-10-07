<?php namespace Alquemedia_PostREST;
use Alquemedia_PostREST\Components\Database\Database;
use Alquemedia_PostREST\Components\Models\Model;
use Alquemedia_PostREST\Components\SQL\Select_Statement;

/**
 * Class RESTful_API
 * @package Alquemedia_PostREST
 *
 * A RESTful API
 */
class RESTful_API {

    /**
     * @var JSON_File configuration
     */
    private $config;

    /**
     * @var \PDO
     */
    private $db;

    /**
     * @var array result from API operation
     */
    private $result = [];

    /**
     * RESTful_API constructor.
     */
    public function __construct() {

        // if Connected to database
        if ( ($this->config = $this->configure()) &&

            ( $this->db = $this->connect() ) )

                $this->processRequest();

    }

    /**
     * @return bool true if configured
     */
    private function configure(){

        return $this->loadJSON('postrest');

    }

    /**
     * process the request
     */
    private function processRequest(){

        $apiRoot = $this->config->get('api-root');

        $uriPart1 = $this->uriPart(1);

        if ( $uriPart1 != $this->config->get('api-root'))

            $this->setError("Expected API root /$apiRoot, but got $uriPart1");

        $this->processModel( $this->uriPart(2) );

        $this->result['metaData'] = $this->metaData();

    }

    /**
     * @param string $modelName
     */
    private function processModel( $modelName ){

        if ( ! $modelName )

            $this->setError("Expected a model name in the URL");

        $recordId = $this->uriPart(3);

        if ( !$recordId)

            $this->result['models'] = $this->getModels( $modelName );

        else

            $this->result[ $modelName ] = (new Model($modelName,$recordId))->asArray();

    }

    /**
     * @param $modelName
     * @return array
     */
    private function getModels( $modelName ){

        $result = (new Database())->query((string) new Select_Statement($modelName) );

        return $result->fetchAll( \PDO::FETCH_ASSOC );

    }

    /**
     * @return array of meta data
     */
    private function metaData(){

        $metaData = [ 'api-root' => $this->config->get('api-root'),];

        if ( $this->config->get('show-server-vars'))

            $metaData['server-vars'] = $_SERVER;

        return $metaData;
    }

    /**
     * @return \PDO
     */
    private function connect(){

        $dbConfig = $this->loadJSON('database');

        $db = new \PDO((string) new Data_Source_Name($dbConfig),$dbConfig->username,$dbConfig->password);

        return $db;

    }


    /**
     * @param $jsonKey
     * @return JSON_File|null
     */
    private function loadJSON( $jsonKey ){

        $jsonFile = new JSON_File($jsonKey);

        if ( ! $jsonFile->exists() ){

            $this->result = [

                'result' => 'error',

                'error' => $jsonFile->filePath(). ": JSON file not found."

            ];

            return null;
        }

        return $jsonFile;

    }

    /**
     * Show as JSON
     */
    public function toJSON(){

        header('Content-Type: application/json');

        echo json_encode( $this->result );

    }

    /**
     * @param $partNumber
     * @return string
     */
    private function uriPart( $partNumber ){

        return (new Request_URI())->part( $partNumber );

    }

    /**
     * Set API error
     * @param string $error
     */
    private function setError( $error ){

        $this->result['result'] = 'error';

        $this->result['error'] = $error;

    }
}