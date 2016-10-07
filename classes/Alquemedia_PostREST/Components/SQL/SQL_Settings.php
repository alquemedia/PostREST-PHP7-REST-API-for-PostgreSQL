<?php
/**
 * Created by PhpStorm.
 * User: dgreenberg
 * Date: 10/6/16
 * Time: 10:10 PM
 */

namespace Alquemedia_PostREST\Components\SQL;


use Alquemedia_PostREST\JSON_File;

class SQL_Settings {

    /**
     * @var array
     */
    private $settings;

    public function __construct() {

        $this->settings = (new JSON_File('postrest'))->get('sql-settings');

    }

    /**
     * @return int Select Limit
     */
    public function selectLimit(){ return (int) $this->settings->select_limit; }

}