<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 15:42
 * Email: hi@hisune.com
 */
// define application name
define('APPLICATION', 'demo');

// Require bootstrap
require __DIR__ . '/../app/' . ucfirst(APPLICATION) . '/bootstrap/autoload.php';

// Run
try{

    $dispatch = new \Tiny\Dispatch(\Tiny\Config::route());
    $dispatch->controller();

}catch (Exception $e){

    \Tiny\Exception::exception($e);

}