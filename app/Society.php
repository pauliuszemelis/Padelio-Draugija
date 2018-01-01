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
                    if ($action == 'new') {
                        (new ProductController())->create();
                    } elseif ($action == 'listall') {
                        (new ProductController())->listall();
                    } elseif ($action == 'edit') {
                        (new ProductController())->edit();
                    }
                    break;
                case 'match_history':
                    (new UsersController())->isLogged();
                    if ($action == 'new') {
                        (new MatchController())->create();
                    } elseif ($action == 'listall') {
                        (new MatchController())->listall();
                    } elseif ($action == 'table') {
                        (new MatchController())->table();
                    } elseif ($action == 'edit') {
                        (new MatchController())->edit();
                    }
                    break;
                case 'users':
                    if ($action == 'new') {
                        (new UsersController())->create();
                    }
                    if ($action == 'listall') {
                        (new UsersController())->isLogged();
                        (new UsersController())->listall();
                    }
                    if ($action == 'table') {
                        (new UsersController())->isLogged();
                        (new UsersController())->table();
                    }
                    if ($action == 'edit') {
                        (new UsersController())->isLogged();
                        (new UsersController())->edit();
                    }
                    if ($action == 'logout') {
                        (new UsersController())->logout();                      
                    }
                    if ($action == 'login') {                      
                        (new UsersController())->login();
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
                    if ($action == 'update') {
                        (new MatchController())->update();
                        break;
                    }
                    if ($action == 'delete') {
                        (new MatchController())->delete();
                    }
                    break;
                case 'users':
                    if ($action == 'create') {
                        (new UsersController())->store();
                    }
                    if ($action == 'auth')   {
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
                        (new UsersController())->update();
                        break;
                    }
                    break;
            }
        }
    }
}
