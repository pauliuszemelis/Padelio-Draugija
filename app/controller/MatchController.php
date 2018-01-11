<?php

namespace app; 

use app\controller\TemplateEngineController;
use app\model\MatchHistory;
use app\model\Users;

class MatchController {

    public function create() {
        $template = new TemplateEngineController('match-history');

        $menu = $this->getUsersOptions();
        $date = date('Y-m-d');
        $template->set('menu', $menu);
        $template->set('date', $date);

        $template->echoOutput();
    }

    public function getUsersOptions() {
        $result = (new Users())->getMenu();
        $menu = '';

        foreach ($result as $item) {
            $menu .= '<option value="' . $item['id'] . '">' . $item['Slapyvardis'] . '</option>';
        }
        $menu .= '<option selected value="">Pasirinkite žaidėją</option>';
        return $menu;
    }

    public function store() {

        $model = new MatchHistory();
        $_POST['created_by'] = $_COOKIE['user'];
        $model->create($_POST);

        header('Location:?view=match_history&action=table');

        exit;
    }

    

    public function table() {
        $model = new MatchHistory();
        $result = $model->matchHistory();
        $data = '';
        $header = '<th>Nr</th><th>Data</th><th colspan=2>Komanda 1</th><th colspan=2>Pirmas setas</th><th colspan=2>Antras setas</th><th colspan=2>Trečias setas</th><th colspan=2>Komanda 2</th>';
        foreach ($result as $item) {
            $data .= '<tr>';
            foreach ($item as $key => $value) {
                if ($key == 'teammate1' || $key == 'teammate2' || $key == 'oponent1' || $key == 'oponent2') {
                    $value = (new Users())->findUserNick($value);
                }
                $data .= '<td>' . $value . '</td>';
            }
            $data .= '</tr>';
        }
        $template = new TemplateEngineController('table-list');
        $template->set('header', $header);
        $template->set('data', $data);


        $template->echoOutput();
    }

    public function listall() {
        $model = new MatchHistory();
        $result = $model->listall();
        $header = '';
        $data = '';

        foreach ($result as $item) {

            if ($header == '') {
                foreach ($item as $key => $value) {
                    $header .= '<th>' . $key . '</th>';
                }
            }
            $data .= '<tr onclick="window.location=\'?view=match_history&action=edit&id=' . $item['id'] . '\'">';
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

    public function update() {
        $model = new MatchHistory();
        $model->update($_GET['id']);

        header('Location: ?view=match_history&action=table');

        exit();
    }

    public function edit() {
        $model = new MatchHistory();
        $result = $model->findAll($_GET['id']);
        $record = null;

        foreach ($result as $value) {
            $record = $value;
        }
        if (!$record) {
            die('Record not found');
        }
        $template = new TemplateEngineController('edit-match-history');
        $template->set('Data', $record['Data']);
        $template->set('team1_result1', $record['team1_result1']);
        $template->set('team1_result2', $record['team1_result2']);
        $template->set('team1_result3', $record['team1_result3']);
        $template->set('team2_result1', $record['team2_result1']);
        $template->set('team2_result2', $record['team2_result2']);
        $template->set('team2_result3', $record['team2_result3']);
        $template->set('id', $record['id']);
        $menu = $this->getUpdateMatchPlayers();
        $template->set('menu1', $menu[0]);
        $template->set('menu2', $menu[1]);
        $template->set('menu3', $menu[2]);
        $template->set('menu4', $menu[3]);

        //$template->set('unit_' . $record['unit'], 'selected');

        $template->echoOutput();
    }
    public function getUpdateMatchPlayers() {

        $menu = array();
        $result = (new MatchHistory())->matchPlayers($_GET['id']);  
        foreach ($result as $players) {
            foreach ($players as $id) { 
                $nickname = (new Users())->findUserNick($id);
                $menu[] = $this->updateMatchMenu().'<option selected value="' . $id . '">' . $nickname . '</option>';  
            }
        }
        return $menu;
    }
    
    public function updateMatchMenu () {
        $res = (new Users())->getMenu();
        $menu = '';
        foreach ($res as $item) {
                $menu .= '<option value="' . $item['id'] . '">' . $item['Slapyvardis'] . '</option>';
                }
        return $menu;
    }

    public function delete() {
        $model = new MatchHistory();
        $model->delete($_GET['id']);

        header('Location: ?view=match_history&action=table');
    }
    public function undelete() {
        $model = new MatchHistory();
        $model->undelete($_GET['id']);

        header('Location: ?view=match_history&action=table');
    }
    public function permDelete() {
        $model = new MatchHistory();
        $model->permDelete($_GET['id']);

        header('Location: ?view=match_history&action=table');
    }

}
