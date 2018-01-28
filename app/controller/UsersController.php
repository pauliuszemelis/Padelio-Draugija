<?php

namespace app\controller;

use app\controller\TemplateEngineController;
use app\model\Users;

class UsersController {

    public function login() {
        (new TemplateEngineController('login'))->echoOutput();
    }

    public function invitePlayer() {
        $template = new TemplateEngineController('invite-player');
        $template->echoOutput();
    }

    public function create() {
        $template = new TemplateEngineController('new-users');
        $template->echoOutput();
    }

    public function checkEmail() {
        $model = new Users();
        $result = $model->checkEmail();
        foreach ($result as $item) {
            if (isset($item['email']) && $item['email'] == $_POST['email']) {
                die('<div class="text-center" style="color:red">Toks el.pašto adresas jau yra duomenų bazėje...</div><br/>');
            }
        }
    }

    public function store() {

        (new Users())->isEmptyForm();
        (new UsersController())->checkEmail();
        $data = $_POST;
        $data['password'] = sha1($data['password'] . SALT);

        $model = new Users();
        $model->create($data);
        if (isset($_COOKIE['user'])) {
            header('Location:?view=users&action=table');
            exit;
        } else {
            header('Location:?view=users&action=login');
            echo "Sėkmingai užsiregistravote. Galite prisijungti.";
        }
    }

    public function table() {
        $model = new Users();
        $result = $model->playersList();
        $header = '';
        $data = '';
        $nr = 1;
        foreach ($result as $item) {

            if ($header == '') {
                foreach ($item as $key => $value) {
                    if($key == 'win'){}
                    elseif($key == 'lose'){
                    $header .= '<th title="Pergalės / Viso žaista (Santykis %)">Statistika</th>';   
                    }
                    else{
                    $header .= '<th>' . $key . '</th>';
                    }
                }
            }
            $data .= '<tr>';
            foreach ($item as $key => $value) {
                if ($key == 'Nr') {
                    $value = $nr;
                    $nr++;
                }
                if ($key == 'Reitingas' && $value == 0) {
                    $value = "-";
                }
                if ($key == 'win') {
                    $win = $value;
                }
                if ($key == 'lose') {
                    $lose = $value;
                    if($item['win'] ==0 && $item['lose'] == 0){
                    $value = $win . '/' . $lose . ' (0%)';    
                    }
                    else {
                    $value = $win . '/' . ($win+$lose) . ' (' . round($win/($win+$lose)*100) . '%)';
                    }
                }
                if ($key == 'win') {
                }else{
                $data .= '<td>' . $value . '</td>';
                }
            }
            $data .= '</tr>';
        }

        $template = new TemplateEngineController('table-list');
        $template->set('header', $header);
        $template->set('data', $data);

        $template->echoOutput();
    }

    public function listall() {
        $model = new Users();
        $result = $model->listall();
        $header = '';
        $data = '';

        foreach ($result as $item) {

            if ($header == '') {
                foreach ($item as $key => $value) {
                    $header .= '<th>' . $key . '</th>';
                }
            }
            $data .= '<tr onclick="window.location=\'?view=users&action=edit&id=' . $item['id'] . '\'">';
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

    public function auth() {
        $data = $_POST;

        $data['password'] = sha1($data['password'] . SALT);
        $model = new Users();

        $result = $model->auth($data);

        if ($result->num_rows != 1) {
            (new UsersController())->login();
            die('<div class="text-center" style="color:red">Patikrinkite prisijungimo vardą arba slaptažodį...</div><br/>');
        }
        foreach ($result as $value) {
            setcookie('user', $value['id'], time() + 36000);
            setcookie('nickname', $value['Slapyvardis'], time() + 36000);
        }
        header('Location:?view=match_plan&action=new');
    }

    public function loggedUser() {
        if (isset($_COOKIE['user'])) {
            $model = new Users();
            $findUser = $model->findUser($_COOKIE['user']);
            foreach ($findUser as $value) {
                return ($value['Slapyvardis']);
            }
        }
    }

    public function isLogged() {
        if (isset($_COOKIE['user'])) {

            $model = new Users();
            $result = $model->find($_COOKIE['user']);

            if ($result->num_rows != 1) {
                (new UsersController())->login();
                die('<div class="text-center" style="color:red">Patikrinkite prisijungimo vardą arba slaptažodį...</div><br/>');
            }
            setcookie('user', $_COOKIE['user'], time() + 36000);
            setcookie('nickname', $_COOKIE['nickname'], time() + 36000);
        } else {
            (new UsersController())->login();
            die('<div class="text-center" style="color:red">Turite būti prisijungęs...</div><br/>');
        }
    }

    public function logout() {
        if (isset($_COOKIE['user'])) {
            setcookie('user', $_COOKIE['user'], time() - 36000);
            setcookie('nickname', $_COOKIE['nickname'], time() - 36000);
            header('Location: ?view=users&action=login');
        }
    }

    public function ranks() {
        $data = $_POST;
        $ranks = array();
        $model = new UsersController();
        $playersID = array($data['teammate1'], $data['teammate2'], $data['oponent1'], $data['oponent2']);
        foreach ($playersID as $id) {
            $ranks[] = $model->getRanking($id);
            $wins[] = $model->getWins($id);
            $lose[] = $model->getLose($id);
        }
        $all = array ($ranks, $wins, $lose);
        return ($all);
    }
    
    public function getLose($id) {
        $model = new Users();
        $playersRanks = $model->find($id);
        foreach ($playersRanks as $value) {
            $record = $value;
            return ($record['lose']);
        }
        die;
    }
    
    public function getWins($id) {
        $model = new Users();
        $playersRanks = $model->find($id);
        foreach ($playersRanks as $value) {
            $record = $value;
            return ($record['win']);
        }
        die;
    }

    public function getRanking($id) {
        $model = new Users();
        $playersRanks = $model->find($id);
        foreach ($playersRanks as $value) {
            if($value == 0){$value = 1000;}
            $record = $value;
            return ($record['Reitingas']);
        }
        die;
    }

    public function calcWinners() {
        $data = $_POST;
        $winners = array(0, 0);

        if ($data['team1_result1'] > $data['team2_result1']) {
            $winners[0] ++;
        } elseif ($data['team1_result1'] < $data['team2_result1']) {
            $winners[1] ++;
        }
        if ($data['team1_result2'] > $data['team2_result2']) {
            $winners[0] ++;
        } elseif ($data['team1_result2'] < $data['team2_result2']) {
            $winners[1] ++;
        }
        if ($data['team1_result3'] > $data['team2_result3']) {
            $winners[0] ++;
        } elseif ($data['team1_result3'] < $data['team2_result3']) {
            $winners[1] ++;
        }
        return ($winners);
    }

    public function calcNewRanks() {

        $model = new UsersController();
        $all = $model->ranks(); // ranks [0], wins [1], lose [2]

        $average1 = ($all[0][0] + $all[0][1]) / 2;
        $average2 = ($all[0][2] + $all[0][3]) / 2;

        $winPoints1 = round($average2 * 0.02);
        $winPoints2 = round($average1 * 0.02);

        $rankDiff = abs($average1 - $average2);
        $dif = round($rankDiff * 0.04);
        
        $winners = $model->calcWinners();
        if ($winners[0] > $winners[1]) {
            $newRank1 = 0 + $winPoints2;
            $newRank2 = 0 - $winPoints2;
            $all[1][0]++;
            $all[1][1]++;
            $all[2][2]++;
            $all[2][3]++;
        }
        if ($winners[0] < $winners[1]) {
            $newRank1 = 0 - $winPoints1;
            $newRank2 = 0 + $winPoints1;
            $all[2][0]++;
            $all[2][1]++;
            $all[1][2]++;
            $all[1][3]++;
        }
        
        if ($average1 > $average2) {
            $newRank1 -= $dif;
            $newRank2 += $dif;
        }

        if ($average1 < $average2) {
            $newRank1 += $dif;
            $newRank2 -= $dif;
        }
        $all[0][0] += $newRank1;
        $all[0][1] += $newRank1;
        $all[0][2] += $newRank2;
        $all[0][3] += $newRank2;
        $progress = array($newRank1, $newRank1, $newRank2, $newRank2);
        $othermodel = new Users();
        $data = $_POST;
        $playersID = [$data['teammate1'], $data['teammate2'], $data['oponent1'], $data['oponent2']];
        foreach ($playersID as $key => $id) {
            $othermodel->updateRanks($all[0][$key], $progress[$key], $id, $all[1][$key], $all[2][$key]);
        }
    }

    public function edit() {
        $model = new Users();
        $result = $model->findAll($_GET['id']);
        $record = null;

        foreach ($result as $value) {
            $record = $value;
        }
        if (!$record) {
            die('Record not found');
        }

        $template = new TemplateEngineController('edit-users');
        $template->set('id', $record['id']);
        $template->set('Vardas', $record['Vardas']);
        $template->set('Pavardė', $record['Pavardė']);
        $template->set('Slapyvardis', $record['Slapyvardis']);
        $template->set('email', $record['email']);
        $template->set('password', $record['password']);
        $template->set('Reitingas', $record['Reitingas']);
        $template->set('Paskutinis', $record['Paskutinis']);

        $template->echoOutput();
    }

    public function selfedit() {
        $model = new Users();
        $result = $model->findAll($_COOKIE['user']);
        $record = null;

        foreach ($result as $value) {
            $record = $value;
        }
        if (!$record) {
            die('Record not found');
        }

        $template = new TemplateEngineController('edit-self');
        $template->set('id', $record['id']);
        $template->set('Vardas', $record['Vardas']);
        $template->set('Pavardė', $record['Pavardė']);
        $template->set('Slapyvardis', $record['Slapyvardis']);
        $template->set('email', $record['email']);

        $template->echoOutput();
    }

    public function update() {
        $model = new Users();
        $model->update($_GET['id']);

        header('Location: ?view=users&action=table');
    }

    public function selfupdate() {
        $model = new Users();
        $model->selfupdate($_COOKIE['user']);

        header('Location: ?view=users&action=table');
    }

    public function delete() {
        $model = new Users();
        $model->delete($_GET['id']);

        header('Location: ?view=users&action=table');

        exit();
    }

    public function undelete() {
        $model = new Users();
        $model->undelete($_GET['id']);

        header('Location: ?view=users&action=table');
    }

    public function permDelete() {
        $model = new Users();
        $model->permDelete($_GET['id']);

        header('Location: ?view=users&action=table');
    }

    public function about() {
        (new TemplateEngineController('about'))->echoOutput();
    }

}
