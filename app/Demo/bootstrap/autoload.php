<?php
/**
 * Created by hisune.com
 * Date: 2014/12/3
 * Time: 15:43
 * Email: hi@hisune.com
 */
// System Start Time
define('START_TIME', microtime(true));

// System Start Memory
define('START_MEMORY_USAGE', memory_get_usage());

// zip output
ini_set('zlib.output_compression', 4096);

require(__DIR__ . '/../../../vendor/autoload.php');

// Global Config
\Tiny\Config::$application = APPLICATION;
\Tiny\Config::$configDir = __DIR__ . '/../config/';
\Tiny\Config::$varDir = __DIR__ . '/../var/';
\Tiny\Config::$viewDir = __DIR__ . '/../view/';
\Tiny\Config::$controller = array('Controller', 'app/Controller');
\Tiny\Config::$authPurview = true;
\Tiny\Config::$authPurviewMethod = [ucfirst(APPLICATION) . '\\' . 'Model' . '\\Purview', 'updateGroupPurview'];

// show errors
ini_set('display_errors', 'off');

// timezone
date_default_timezone_set(Tiny\Config::config()->timezone);

// Enable global error handling
register_shutdown_function(array('\Tiny\Exception', 'fatal'));