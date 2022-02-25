<?php

use CRUD\Controller\MovieController;

include ("loader.php");

if (preg_match("/^\/movie/i", $_SERVER['REQUEST_URI'])) {
    $controller = new MovieController();
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        $controller->switcher($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'], json_decode(file_get_contents('php://input')));
    } else {
        $controller->switcher($_SERVER['REQUEST_METHOD'], json_decode(file_get_contents('php://input')));
    }
}
