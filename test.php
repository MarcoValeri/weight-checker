<?php
// Require initialize.php and related code
require_once('./private/initialize.php');

// Includes classes and related code
include_once('./private/classes/Person.php');
include_once('./private/classes/User.php');
include_once('./private/db/Database.php');

// Create an obj
$db = new Database();
$connection = $db->dbStartConnection();
$sql = $db->getSqlUsers();
$db->createDb($connection, $sql);