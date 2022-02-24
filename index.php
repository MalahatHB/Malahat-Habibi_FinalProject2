<?php

use CRUD\Controller\MovieController;

include ("loader.php");

if (preg_match("/^\/movie/i", $_SERVER['REQUEST_URI'])) {
    $controller = new MovieController();
    $controller->switcher($_SERVER['REQUEST_METHOD'], json_decode(file_get_contents('php://input')));
}
