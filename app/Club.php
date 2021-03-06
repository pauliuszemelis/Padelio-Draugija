<?php

namespace app;

use app\controller\UsersController;

class Club
{
    public function __construct() {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == 'GET' && isset($_GET['view']) && isset($_GET['action'])) {
            $view = $_GET['view'];
            $action = $_GET['action'];
            switch ($view) {
                case 'match_plan':
                    (new UsersController())->isLogged();
                    if ($action == 'new') {
                        (new UsersController())->isLogged();
                        (new MatchPlanController())->table();
                        (new MatchPlanController())->create();
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
                    if ($action == 'new') {
                        (new UsersController())->isLogged();
                        (new MatchHistoryController())->tablePlan();
                        (new MatchHistoryController())->create();
                    } elseif ($action == 'listall') {
                        (new UsersController())->isLogged();
                        (new MatchHistoryController())->listall();
                    } elseif ($action == 'table') {
                        (new MatchHistoryController())->table();
                    } elseif ($action == 'edit') {
                        (new UsersController())->isLogged();
                        (new MatchHistoryController())->edit();
                    }
                    break;
                case 'users':
                    if ($action == 'new') {
                        (new UsersController())->create();
                    }
                    if ($action == 'invite') {
                        (new UsersController())->isLogged();
                        (new UsersController())->invitePlayer();
                    }
                    if ($action == 'listall') {
                        (new UsersController())->isLogged();
                        (new UsersController())->listall();
                    }
                    if ($action == 'table') {
                        (new UsersController())->table();
                    }
                    if ($action == 'forgotpassword') {
                        (new UsersController())->forgotPassword();
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
                case 'verify':
                    if ($action == 'email') {
                        (new UsersController())->verifyEmail();
                    }
                case 'chat':
                    if ($action == 'session') {
                        (new UsersController())->isLogged();
                        (new UsersController())->updateLastMsg();
                        include 'chat.php';
                    }
                    break;

            }
        } else if ($method == 'POST' && $_GET['view'] && $_GET['action']) {
            $view = $_GET['view'];
            $action = $_GET['action'];
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
                        (new MatchHistoryController())->checkEmptyPlayers();
                        (new MatchHistoryController())->checkOneSet();
                        (new UsersController())->calcNewRanks();
                        (new MatchHistoryController())->store();
                    }
                    if ($action == 'createfromplan') {
                        (new MatchHistoryController())->checkEmptyPlayers();
                        (new MatchHistoryController())->checkOneSet();
                        (new MatchPlanController())->permDelete();
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
                    if ($action == 'auth') {
                        (new UsersController())->auth();
                    }
                    if ($action == 'sendinvite') {
                        (new UsersController())->isLogged();
                        (new UsersController())->sendInvite();
                    }
                    if ($action == 'sendNewPassword') {
                        (new UsersController())->sendNewPassword();
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
                    if ($action == 'passchange') {
                        (new UsersController())->isLogged();
                        (new UsersController())->passCheck();
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
                case 'verify':
                    if ($action == 'again') {
                        (new UsersController())->createVerificationCode();
                    }
            }
        }
        else {
            if(isset($_COOKIE['user'])) {
                (new UsersController())->isLogged();
                header('Location:?view=match_plan&action=new');
            }
            else {
                (new UsersController())->login();
            }
        }
    }
}
