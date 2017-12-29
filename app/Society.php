<?php

namespace app;


use app\controller\ProductController;
use app\controller\UsersController;

class Society
{
    public function __construct()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method == 'GET' && (!isset($_GET['view']) || !isset($_GET['action']))){
            (new UsersController())->login();
        die();
    }

        $view = $_GET['view'];
        $action = $_GET['action'];

        if ($method == 'GET') {

            switch ($view) {
                case 'product':
                    (new UsersController())->isLogged();
                    if ($action == 'new')
                        (new ProductController())->create();
                    elseif ($action == 'list')
                        (new ProductController())->list();
                    elseif ($action == 'edit')
                        (new ProductController())->edit();
                    break;
                case 'match_history':
                    (new UsersController())->isLogged();
                    if ($action == 'new') {
                        (new MatchController())->create();
                    } elseif ($action == 'list') {
                        (new MatchController())->list();
                    }
                    break;
                case 'users':
                    if ($action == 'new') {
                        (new UsersController())->create();
                    } elseif ($action == 'list') {
                        (new UsersController())->isLogged();
                        (new UsersController())->list();
                    } elseif ($action == 'edit') {
                        (new UsersController())->isLogged();
                        (new ProductController())->edit();
                        break;
                    }

            }
        } elseif
        ($method == 'POST') {

            switch ($view) {
                case 'product':
                    (new UsersController())->isLogged();
                    if ($action == 'create') {
                        (new ProductController())->store();
                        break;
                    }
                    if ($action == 'update') {
                        (new ProductController())->update();
                        break;
                    }
                    if ($action == 'delete') {
                        (new ProductController())->delete();
                        break;
                    }
                    break;
                case 'match_history':
                    (new UsersController())->isLogged();
                    if ($action == 'create') {
                        (new UsersController())->calcNewRanks();
                        (new MatchController())->store();
                        break;
                    }
                    break;
                case 'users':
                    if ($action == 'create') {
                        (new UsersController())->store();
                    }
                    elseif ($action == 'auth')   {
                        (new UsersController())->auth();
                        break;
                    }
                    if ($action == 'delete') {
                        (new UsersController())->isLogged();
                        (new UsersController())->delete();
                        break;
                    }
                    if ($action == 'update') {
                        (new UsersController())->isLogged();
                        (new ProductController())->update();
                        break;
                    }
                    break;
            }
        }
    }
}
