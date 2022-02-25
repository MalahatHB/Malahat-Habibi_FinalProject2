<?php

namespace CRUD\Controller;

use CRUD\Helper\MovieHelper;
use CRUD\Model\Actions;
use CRUD\Model\Movie;

class MovieController
{
    public function switcher($method, $request)
    {
        switch ($method) {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                if ($_REQUEST['id']) {
                    $this->readAction($_REQUEST['id']);
                } else if ($_REQUEST['filter']) {
                    $this->readFilterAction($_REQUEST['filter']);
                } else {
                    $this->readAllAction($request);
                }
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    public function createAction($request)
    {
        $movie = new Movie();
        $request = json_decode(file_get_contents("php://input"));
        $movie->setName($request->name->name);
        $movie->setImage($request->name->image);
        $movie->setYear($request->name->year);
        $movie->setDescription($request->name->description);
        $movieHelper = new MovieHelper();
        if($movieHelper->insert($movie)) {
            http_response_code(200);
        } else {
            http_response_code(401);
        }
    }

    public function updateAction($request)
    {
        $movie = new Movie();
        $request = json_decode(file_get_contents("php://input"));
        $movie->setId($request->name->id);
        $movie->setName($request->name->name);
        $movie->setImage($request->name->image);
        $movie->setYear($request->name->year);
        $movie->setDescription($request->name->description);
        $movieHelper = new MovieHelper();
        $movieHelper->update($movie);
    }

    public function readAction($request)
    {
        $movieHelper = new MovieHelper();
        $movies = $movieHelper->fetch($request);
        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($movies);
    }

    public function readFilterAction($request)
    {
        $movieHelper = new MovieHelper();
        $movies = $movieHelper->fetchByNameOrYear($request);
        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($movies);
    }

    public function readAllAction($request)
    {
        $movieHelper = new MovieHelper();
        $movies = $movieHelper->fetchAll();
        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($movies);
    }

    public function deleteAction($request)
    {
        $movieHelper = new MovieHelper();
        $movieHelper->delete($_REQUEST['id']);
    }

}