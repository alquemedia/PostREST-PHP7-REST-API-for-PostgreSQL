<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/5/16
 * Time: 8:22 PM
 */

namespace Alquemedia_PostREST;


class RESTful_API {

    /**
     * @var JSON_File configuration
     */
    private $config;

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

        // No specific model?
        if ( ! $this->uriPart(3))

            $this->getModels( $modelName );
    }

    private function getModels( $modelName ){


    }

    /**
     * @return array of meta data
     */
    private function metaData(){

        return [

            'api-root' => $this->config->get('api-root'),

        ];
    }

    /**
     * @return JSON_File|null
     */
    private function connect(){

        $dbConfig = $this->loadJSON('database');

        $this->db = new \PDO();

        return $dbConfig;

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