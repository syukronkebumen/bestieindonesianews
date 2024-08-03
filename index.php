<?php

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// Ensure the current directory is pointing to the front controller's directory
chdir(__DIR__);

$vendor = FCPATH . 'vendor/autoload.php';

if (is_file($vendor)) require_once $vendor;
// Load our paths config file
// This is the line that might need to be changed, depending on your folder structure.
require realpath(FCPATH . 'framework/Dee.php') ?: FCPATH . 'framework/Dee.php';
// ^^^ Change this if you move your application folder

// Location of the framework bootstrap file.
$bootstrap = rtrim(FCPATH . 'protected/config/main.php');
$config       = require realpath($bootstrap) ?: $bootstrap;

$app = new dee\base\Application($config);
/*
 *---------------------------------------------------------------
 * LAUNCH THE APPLICATION
 *---------------------------------------------------------------
 * Now that everything is setup, it's time to actually fire
 * up the engines and make this app do its thang.
 */
$app->run();
