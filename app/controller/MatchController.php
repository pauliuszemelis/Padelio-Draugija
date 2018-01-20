<?php

namespace app; 

use app\controller\TemplateEngineController;
use app\model\MatchHistory;
use app\model\MatchPlan;
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
    
    public function planToHistory () {
        $model = new MatchPlan();
        $result = $model->findAll($_GET['id']);
        $record = null;

        foreach ($result as $value) {
            $record = $value;
        }
        if (!$record) {
            die('Record not found');
        }
        $template = new TemplateEngineController('match-plan-history');
        $template->set('date', $record['Data']);
        $model2 = new MatchPlanController();
        $menu = $model2->getUpdateMatchPlayers();
        $template->set('id', $_GET['id']);
        $template->set('menu1', $menu[0]);
        $template->set('menu2', $menu[1]);
        $template->set('menu3', $menu[2]);
        $template->set('menu4', $menu[3]);

        $template->echoOutput();
    }
    
    public function tablePlan() {
        $model = new MatchHistory();
        $result = $model->matchPlanForHistory();
        $data = '';
        $nr = 1;
        $header = '<th>Nr</th><th>Data</th><th>Laikas</th><th>Pirmas žaidėjas</th><th>Antras žaidėjas</th><th>Trečias žaidėjas</th><th>Ketvirtas žaidėjas</th><th>Lygis</th><th></th>';
        foreach ($result as $item) {
            $data .= '<tr>';
            foreach ($item as $key => $value) {
                if ($key == 'teammate1' || $key == 'teammate2' || $key == 'oponent1' || $key == 'oponent2') {
                    $value = (new Users())->findUserNick($value);
                }
                if ($key == 'id'){
                    $value = "<button onclick=\"window.location.href='?view=match_plan&action=plantohistory&id=$value'\">Suvesti rezultatus</button>";
                }
                if ($key == 'Laikas'){
                    $value = substr($value, 0, -3);
                }
                if ($key == 'Nr'){
                    $value = $nr;
                    $nr++;
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

    public function getUsersOptions() {
        $result = (new Users())->getMenu();
        $menu = '';

        foreach ($result as $item) {
            $menu .= '<option value="' . $item['id'] . '">' . $item['Slapyvardis'] . '</option>';
        }
        $menu .= '<option disabled selected hidden value="">Pasirinkite žaidėją</option>';
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
        $nr = $result->num_rows;
        
        $header = '<th>Nr</th><th>Data</th><th colspan=2>Komanda 1</th><th colspan=2>Pirmas setas</th><th colspan=2>Antras setas</th><th colspan=2>Trečias setas</th><th colspan=2>Komanda 2</th>';
        foreach ($result as $item) {
            $data .= '<tr>';
            foreach ($item as $key => $value) {
                if ($key == 'teammate1' || $key == 'teammate2' || $key == 'oponent1' || $key == 'oponent2') {
                    $value = (new Users())->findUserNick($value);
                }
                if ($key == 'Nr'){
                    $value = $nr;
                    $nr--;
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
        $template->set('date', $record['Data']);
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

        $template->echoOutput();
    }
    public function getUpdateMatchPlayers() {

        $menu = array();
        $result = (new MatchHistory())->matchPlayers($_GET['id']);  
        foreach ($result as $players) {
            foreach ($players as $id) { 
                $nickname = (new Users())->findUserNick($id);
                $menu[] = $this->updateMatchMenu().'<option selected hidden value="' . $id . '">' . $nickname . '</option>';  
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
