<?php

/**
 * This file contains the main functions of the
 * webapplication.
 * The file is included inside the initialize.php the 
 * allows to use the following functions through all
 * the pages of the application
 */

// Require initialize.php and related code
require_once('initialize.php');

/**
 * Create a function that return the right path of a page.
 * The function get a 
 * @parameter string $page that is the name of the 
 * page and 
 * @return the exact path
 */
function getUrl(string $page): string {
    return WWW_ROOT . $page;
}

/**
 * Create a function that cleans the input field
 * from empty spaces and html tags
 * @param string $value
 * @return string $value
 */
function clearInput(string $value): string {

    $check_value = trim($value);
    $check_value = strip_tags($value);
    return $check_value;

}