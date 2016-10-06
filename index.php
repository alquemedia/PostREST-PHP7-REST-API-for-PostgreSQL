<?php


namespace Alquemedia_PostREST;

ini_set('display_errors',true);

spl_autoload_register(function($className){

    require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/'.preg_replace("/\\\\/",'/',$className).'.php';

});

// Execute API, show output as JSON
(new RESTful_API())->toJSON();

