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
    
    public function sendInvite () {
        $email= $_POST['email'];
        $to=$email;
        $name = $_POST['Vardas'];
        $subject="Kvietimas prisijungti prie Padelio Teniso Klubo";
        $from = 'no-reply@padelioklubas.lt';
        $message = isset($_POST['msg']) && !empty($_POST['msg'])?' //  '.$_COOKIE['name'].' Jums parašė: '.$_POST['msg']:'';
        $body='Sveiki '.$name.', '.$_COOKIE['name'].' Jus kviečia užsiregistruoti Padelio Teniso Klube. Ten, Jūs galėsite planuoti būsimus padelio žaidimus, išsaugoti rezultatus, matyti žaidimų istoriją, konkuruoti su kitais žaidėjais Padelio Teniso Klubo reitingavimo sistemoje. Užsiregistruoti galite čia: http://padelioklubas.lt/?view=users&action=new  '.$message;
        $headers = "From:".$from;

        mail($to,$subject,$body,$headers);
        
	echo ('<br/><div class="text-center" style="color:grey">Pakvietimas buvo išsiųstas į jūsų draugo elektroninį paštą.</div><br/>');
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
    
    public function createVerificationCode () {
        $code=substr(md5(mt_rand()),0,15);
        
        $email= isset($_GET['adress'])?$_GET['adress']:$_POST['email'];
        $to=$email;
        $subject="Elektroninio pašto patvirtinimas.";
        $from = 'no-reply@padelioklubas.lt';
        $body='Sveikiname Jus užsiregistravus Padelio Teniso Klube. Tam, kad prisijungutmėte jum reikia patvirtinti savo elektroninio pašto adresą. Jūsų patvirtinimo kodas yra '.$code.'. Paspauskite šią nuorodą norėdami aktyvuoti prisijungimą: http://www.padelioklubas.lt/?view=verify&action=email&adress='.$email.'&code='.$code.' Jūsų prisijungimo vardas: '.$email.' Jūsų slaptažodis: '.$_POST['password2'];
        $headers = "From:".$from;

        mail($to,$subject,$body,$headers);
        
        (new Users())->createVerificationCode($code, $email);
            
	echo ('<br/><div class="text-center" style="color:grey">Patvirtinimo nuoroda buvo išsiųsta į jūsų elektroninį paštą. <br/>Jeigu per 5 min. negavote - patikrinkite šlamšto aplanke.</div><br/>');
    }

    public function checkIsVeryfied() {
        if (isset($_POST)) {
            $model = new Users();
            $result = $model->checkIsVeryfied($_POST['email']);
            foreach ($result as $item) {
                if ($item['verified'] != 1) {
                    echo '<br/><form method="POST" action="?view=verify&action=again&adress='.$_POST['email'].'"><input type="submit" class="btn btn-secondary" value="Pakartotinai atsiųsti kodą."></form><br/>';
                    die('<br/><div class="text-center" style="color:red">Patvirtinkite savo elektroninio pašto adresą ir tada galėsite prisijungti.</div><br/>');
                }
            }
        }
    }
    
    public function verifyEmail () {
            $model = new Users();
            $result = $model->checkVerificationCode($_GET['adress']);
            foreach ($result as $item) {
                if ($item['verification_code'] == $_GET['code']) {
                    ($model->verifyCode($_GET['adress']));
                    echo ('<br/><div class="text-center" style="color:green">Jūsų elektroninio patšto adresas patvirtintas. Galite prisijungti.</div><br/>');
                }
                else {
                    die('<br/><div class="text-center" style="color:red">Patvirtinimo kodas netinka.</div><br/>');
                }
            }
        
    }
    
    public function newPassCompare ($data) {
        if(!isset($data['newpassword']) || strlen($data['newpassword']) < 4) {
            die('<br/><div class="text-center" style="color:red">Naujas slaptažodis per trumpas</div><br/>');
        }else {
            if($data['newpassword'] != $data['new2password']){
            die('<br/><div class="text-center" style="color:red">Slaptažodžiai nesutampa</div><br/>');
            }
            $email = $_POST['email'];
            $to = $email;
            $subject = "www.padelioklubas.lt slaptažodžio keitimas";
            $from = 'no-reply@padelioklubas.lt';
            $body = 'Puslapyje www.padelioklubas.lt Jūs pakeitėte slaptažodį. Jūsų naujas slaptažodis yra: '.$data['newpassword'];
            $headers = "From:".$from;
            mail($to,$subject,$body,$headers);
            
            $data['password'] = sha1($data['newpassword'] . SALT);
            (new Users())->updatePassword($data);
            echo ('<br/><div class="text-center" style="color:green">Slaptažodis pakeistas sėkmingai</div><br/>');

        } 
    }
    
    public function passCheck () {
        $data = $_POST;
        $data['password'] = sha1($data['password'] . SALT);

        $model = new Users();
        $result = $model->auth($data);

        if ($result->num_rows != 1) {
            die('<div class="text-center" style="color:red"><br/>Neteisingas slaptažodis</div><br/>');
        }else{
            (new UsersController())->newPassCompare($data);
        }
    }
    
    public function comparePasswords () {
        if(!isset($_POST['password']) || strlen($_POST['password2']) < 4) {
            die('<br/><div class="text-center" style="color:red">Slaptažodis per trumpas</div><br/>');
        }else {
            if($_POST['password'] != $_POST['password2']){
            die('<br/><div class="text-center" style="color:red">Slaptažodžiai nesutampa</div><br/>');
            }
        }
    }

    public function store() {

        (new Users())->isEmptyForm();
        (new UsersController())->checkEmail();
        (new UsersController())->comparePasswords();
        
        $data = $_POST;
        $data['password'] = sha1($data['password'] . SALT);
        unset($data['password2']);
        
        $model = new Users();
        $model->create($data);
                
        $this->createVerificationCode();
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
                    $header .= '<th title="Pergalės / Viso žaista (Pergalių santykis %)">Statistika</th>';   
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
                if ($key == 'Paskutinis' && $value > 0) {
                    $value = "+".$value;
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
        (new UsersController())->checkIsVeryfied();
        foreach ($result as $value) {
            setcookie('user', $value['id'], time() + 360000);
            setcookie('nickname', $value['Vardas']." ".$value['Pavardė'], time() + 360000);
            setcookie('name', $value['Vardas'], time() + 360000);
        }
        header('Location:?view=match_plan&action=new');
    }

    public function isLogged() {
        if (isset($_COOKIE['user'])) {

            $model = new Users();
            $result = $model->find($_COOKIE['user']);

            if ($result->num_rows != 1) {
                (new UsersController())->login();
                die('<div class="text-center" style="color:red">Patikrinkite prisijungimo vardą arba slaptažodį...</div><br/>');
            }
            setcookie('user', $_COOKIE['user'], time() + 360000);
            setcookie('nickname', $_COOKIE['nickname'], time() + 360000);
            setcookie('name', $_COOKIE['name'], time() + 360000);

        } else {
            (new UsersController())->login();
            die('<div class="text-center" style="color:red">Turite būti prisijungęs...</div><br/>');
        }
    }

    public function logout() {
        if (isset($_COOKIE['user'])) {
            setcookie('user', $_COOKIE['user'], time() - 360000);
            setcookie('nickname', $_COOKIE['nickname'], time() - 360000);
            setcookie('name', $_COOKIE['name'], time() + 360000);

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
            if($value['Reitingas'] == 0){$value['Reitingas'] = 1000;}
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
        //$template->set('Slapyvardis', $record['Slapyvardis']);
        $template->set('email', $record['email']);
        $template->set('password', $record['password']);
        $template->set('Reitingas', $record['Reitingas']);
        $template->set('Paskutinis', $record['Paskutinis']);
        $template->set('win', $record['win']);
        $template->set('lose', $record['lose']);

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
        $template->set('email', $record['email']);
        $template->set('Reitingas', $record['Reitingas']);
        $template->set('Paskutinis', $record['Paskutinis'] > 0 ? '+'.$record['Paskutinis'] : $record['Paskutinis']);
        $template->set('win', $record['win']);
        $template->set('played', $record['win']+$record['lose']);
        $template->set('winPerc', $record['lose'] == 0 && $record['win'] == 0 ? '0%' : round($record['win']/($record['win']+$record['lose'])*100) . '%');

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
