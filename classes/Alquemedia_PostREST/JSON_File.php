<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/5/16
 * Time: 8:33 PM
 */

namespace Alquemedia_PostREST;


class JSON_File {

    /**
     * @var \stdClass
     */
    private $jsonData;

    /**
     * @var string File full path
     */
    private $filePath = '';

    /**
     * JSON_File constructor.
     * @param $fileName
     */
    public function __construct( $fileName ) {

        $this->filePath = new Root()."/config/$fileName.json";

        if ( $this->exists() )

            $this->jsonData = json_decode(file_get_contents($this->filePath));

    }

    /**
     * @return string File path
     */
    public function filePath(){ return $this->filePath; }

    /**
     * @return bool true if file exists
     */
    public function exists(){ return file_exists($this->filePath); }

    /**
     * @param $key
     * @return mixed
     */
    public function get( $key ){

        return isset( $this->jsonData->$key )? $this->jsonData->$key : null;

    }

}