<?php


namespace app\controller;

use app\model\Users;

class UsersController
{
    public function login()
    {
        (new TemplateEngineController('login'))->echoOutput();
    }

    public function create()
    {
        $template = new TemplateEngineController('new-users');
        $template->echoOutput();
        //(new TemplateEngineController('new-product'))->echoOutput;
    }

    public function store()
    {
        $data = $_POST;
        foreach ($data as $value) {
            if (empty($value)) {
                (new UsersController())->create();
                die('<div class="text-center" style="color:red">Užpildykite visus duomenis...</div>');
            }
        }
        $data['password'] = sha1($data['password'] . SALT);

        $model = new Users();
        $model->create($data);

        header('Location:?view=users&action=list');
        exit;

    }

    public function list()
    {
        $model = new Users();
        $result = $model->list();
        $header = '';
        $data = '';

        foreach ($result as $item) {


            if ($header == '') {
                foreach ($item as $key => $value) {
                    $header .= '<th>' . $key . '</th>';

                }
            }
            $data .= '<tr>';
            foreach ($item as $key => $value) {
                $data .= '<td>' . $value . '</td>';

            }
            $data .= '</tr>';
        }

        $template = new TemplateEngineController('table-list');
        $template->set('header', $header);
        $template->set('data', $data);

        $template->echoOutput();
    }

    public function auth()
    {
        $data = $_POST;

        $data['password'] = sha1($data['password'] . SALT);
        $model = new Users();

        $result = $model->auth($data);

        if ($result->num_rows != 1) {
            (new UsersController())->login();
            die('<div class="text-center" style="color:red">Patikrinkite prisijungimo vardą arba slaptažodį...</div>');
        }
        foreach ($result as $key => $value)
            setcookie('user', $value['id'], time() + 3600);
        header('Location:?view=match_history&action=new');
    }

    public function loggedUser()
    {
        if (isset($_COOKIE['user'])) {
            $model = new Users();
            $id = $_COOKIE['user'];
            $sessionUser = $model->sessionUser($id);
            foreach ($sessionUser as $value) {
                $record = $value;
                $sessionNickname = ($record['nickname']);
                return $sessionNickname;
            }
        }
    }


public
function isLogged()
{
    if (isset($_COOKIE['user'])) {

        $model = new Users();
        $result = $model->find($_COOKIE['user']);

        if ($result->num_rows != 1) {
            (new UsersController())->login();
            die('<div class="text-center" style="color:red">Patikrinkite prisijungimo vardą arba slaptažodį...</div>');
        }
        setcookie('user', $_COOKIE['user'], time() + 3600);
    } else {
        (new UsersController())->login();
        die('<div class="text-center" style="color:red">Turite būti prisijungęs...</div>');
    }
}

public
function logout()
{
    if (isset($_COOKIE['user']))
    setcookie('user', $_COOKIE['user'], time() - 3600);
}

public
function delete()
{
    $model = new Users();
    $model->delete($_GET['id']);

    header('Location: ?view=users&action=list');

    exit();
}

public
function ranks()
{
    $data = $_POST;
    $ranks = [];
    $model = new UsersController();
    $playersID = [$data['teammate1'], $data['teammate2'], $data['oponent1'], $data['oponent2']];
    foreach ($playersID as $id) {
        $ranks[] = $model->getRanking($id);
    }
    return ($ranks);
}

public
function getRanking($id)
{

    $model = new Users();
    $playersRanks = $model->find($id);
    foreach ($playersRanks as $key => $value) {
        $record = $value;
        return ($record['ranking']);
    }
    die;
}

public
function calcWinners()
{
    $data = $_POST;
    $winners = [0, 0];

    if ($data['team1_result1'] > $data['team2_result1']) {
        $winners[0]++;
    } elseif ($data['team1_result1'] < $data['team2_result1']) {
        $winners[1]++;
    }
    if ($data['team1_result2'] > $data['team2_result2']) {
        $winners[0]++;
    } elseif ($data['team1_result2'] < $data['team2_result2']) {
        $winners[1]++;
    }
    if ($data['team1_result3'] > $data['team2_result3']) {
        $winners[0]++;
    } elseif ($data['team1_result3'] < $data['team2_result3']) {
        $winners[1]++;
    }
    return ($winners);
}

public
function calcNewRanks()
{
    $model = new UsersController();
    $ranks = $model->ranks();
    $winners = $model->calcWinners();
    $average1 = ($ranks[0] + $ranks[1]) / 2;
    $average2 = ($ranks[2] + $ranks[3]) / 2;
    $rankDiff = $average1 > $average2 ? $average1 - $average2 : $average2 - $average1;
    if ($winners[0] > $winners[1]) {
        $newRank1 = 0 + round($average2 * 0.02) - round($rankDiff * 0.04);
        $newRank2 = 0 - round($average1 * 0.02) + round($rankDiff * 0.04);
    } else {
        $newRank1 = 0 - round($average2 * 0.02) - round($rankDiff * 0.04);
        $newRank2 = 0 + round($average1 * 0.02) + round($rankDiff * 0.04);
    }
    $ranks[0] += $newRank1;
    $ranks[1] += $newRank1;
    $ranks[2] += $newRank2;
    $ranks[3] += $newRank2;

    $model = new Users();
    $data = $_POST;
    $playersID = [$data['teammate1'], $data['teammate2'], $data['oponent1'], $data['oponent2']];
    foreach ($playersID as $key => $id) {
        $model->updateRanks($ranks[$key], $id);
    }
}

}