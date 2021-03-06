<?php

ob_start();

/**
 * Assign file paths to PHP constants
 * __FILE__ returns the current path to this file
 * dirname() returns the path to the parent directory
 */
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/');
define("INCLUDES_PATH", PRIVATE_PATH . '/includes');

/**
 * Assign the root URL to a PHP constant
 * Do not need to include the domain
 * Use same document root as webserver
 * Can set hardcoded value:
 * dfine('WWW_ROOT', '/xampp/htdocs/weightchecker/');
 * define('WWW_ROOT', '');
 * Can dynamically find everything in URL up to "/"
 */
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/') + 14;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

/**
 * Require MainFunction and related code
 */
require_once('function.php');

/**
 * Require FormValidation and related code
 */
require_once('src/Form/FormValidation.php');

/**
 * Require Database and related code
 */
require_once('db/Database.php');

/**
 * Require Person and related code
 */
require_once('classes/Person.php');

/**
 * Require User and related code
 */
require_once('classes/User.php');