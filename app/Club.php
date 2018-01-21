<?php

namespace app;

use app\controller\UsersController;

class Club
{
    public function __construct() {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method == 'GET' && (!isset($_GET['view']) || !isset($_GET['action']))){
            (new UsersController())->login();
        die();
    }

        $view = $_GET['view'];
        $action = $_GET['action'];

        if ($method == 'GET') {
            switch ($view) {
                case 'match_plan':
                    (new UsersController())->isLogged();
                    if ($action == 'new') {
                        (new MatchPlanController())->create();
                        (new MatchPlanController())->table();
                    } elseif ($action == 'plantohistory') {
                        (new MatchHistoryController())->planToHistory();
                    } elseif ($action == 'listall') {
                        (new MatchPlanController())->listall();
                    } elseif ($action == 'editall') {
                        (new MatchPlanController())->editall();
                    } elseif ($action == 'table') {
                        (new MatchPlanController())->table();
                    } elseif ($action == 'edit') {
                        (new MatchPlanController())->edit();
                    }
                    break;
                case 'match_history':
                    (new UsersController())->isLogged();
                    if ($action == 'new') {
                        (new MatchHistoryController())->create();
                        (new MatchHistoryController())->tablePlan();
                    } elseif ($action == 'listall') {
                        (new MatchHistoryController())->listall();
                    } elseif ($action == 'table') {
                        (new MatchHistoryController())->table();
                    } elseif ($action == 'edit') {
                        (new MatchHistoryController())->edit();
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
                    if ($action == 'self') {
                        (new UsersController())->isLogged();
                        (new UsersController())->selfedit();
                    }
                    if ($action == 'logout') {
                        (new UsersController())->logout();                      
                    }
                    if ($action == 'login') {                      
                        (new UsersController())->login();
                    }
                case 'info':
                    if ($action == 'about') {
                        (new UsersController())->about();
                    }
                case 'chat':
                    if ($action == 'session') {
                        (new UsersController())->isLogged();
                        include 'chat.php';
                    }
                    break;

            }
        } elseif
        ($method == 'POST') {

            switch ($view) {
                case 'match_plan':
                    (new UsersController())->isLogged();
                    if ($action == 'create') {
                        (new MatchPlanController())->store();
                    }
                    if ($action == 'update') {
                        (new MatchPlanController())->update();
                    }
                    if ($action == 'delete') {
                        (new MatchPlanController())->delete();
                    }
                    if ($action == 'permdelete') {
                        (new MatchPlanController())->permDelete();
                    }
                    if ($action == 'undelete') {
                        (new MatchPlanController())->undelete();
                    }
                    break;
                case 'match_history':
                    (new UsersController())->isLogged();
                    if ($action == 'create') {
                        (new UsersController())->calcNewRanks();
                        (new MatchHistoryController())->store();
                    }
                    if ($action == 'createfromplan') {
                        (new MatchPlanController())->delete();
                        (new UsersController())->calcNewRanks();
                        (new MatchHistoryController())->store();
                    }
                    if ($action == 'update') {
                        (new MatchHistoryController())->update();
                    }
                    if ($action == 'delete') {
                        (new MatchHistoryController())->delete();
                    }
                    if ($action == 'permdelete') {
                        (new MatchHistoryController())->permDelete();
                    }
                    if ($action == 'undelete') {
                        (new MatchHistoryController())->undelete();
                    }
                    break;
                case 'users':
                    if ($action == 'create') {
                        (new UsersController())->store();
                    }
                    if ($action == 'auth')   {
                        (new UsersController())->auth();
                    }
                    if ($action == 'delete') {
                        (new UsersController())->isLogged();
                        (new UsersController())->delete();
                    }
                    if ($action == 'update') {
                        (new UsersController())->isLogged();
                        (new UsersController())->update();
                    }
                    if ($action == 'selfupdate') {
                        (new UsersController())->isLogged();
                        (new UsersController())->selfupdate();
                    }
                    if ($action == 'undelete') {
                        (new UsersController())->isLogged();
                        (new UsersController())->undelete();
                    }
                    if ($action == 'permdelete') {
                        (new UsersController())->isLogged();
                        (new UsersController())->permDelete();
                    }
                    break;
            }
        }
    }
}
