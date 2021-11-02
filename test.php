<?php

// Includes classes and related code
include_once('./private/classes/Person.php');
include_once('./private/classes/User.php');

// Create an obj
$marco = new User("Marco", "Valeri", "23/01/1984", "Male", "info@marcovaleri.net", "Password1234", 104, 115);
echo $marco->getUserData();
echo "\n";

// Create an obj
$caterina = new User("Caterina", "Giordo", "01/02/1986", "Female", "caterinagiordo@gmail.com", "Password1234", 50, 60);
echo $caterina->getUserData();
echo "\n";