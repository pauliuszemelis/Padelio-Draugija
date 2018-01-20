<?php

namespace app; 

use app\controller\TemplateEngineController;
use app\model\MatchHistory;
use app\model\MatchPlan;
use app\model\Users;

class MatchPlanController {
    
        public function create() {
                
        $template = new TemplateEngineController('match-plan');

        $menu = $this->getUsersOptions();
        $date = date('Y-m-d');
        $template->set('menu', $menu);
        $template->set('date', $date);

        $template->echoOutput();
    }
    
    public function getUsersOptions() {
        $result = (new Users())->getMenu();
        $menu = '<option value="">Ieškomas žaidėjas</option>';
        foreach ($result as $item) {
            $menu .= '<option value="' . $item['id'] . '">' . $item['Slapyvardis'] . '</option>';
        }
        $menu .= '<option selected disabled hidden value="">Pasirinkite žaidėją</option>';
        return $menu;
    }
    
    public function table() {
        $model = new MatchPlan();
        $result = $model->matchPlan();
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
                    $value = "<button onclick=\"window.location.href='?view=match_plan&action=edit&id=$value'\">Žaisiu</button>";
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
    
    public function store() {

        $model = new MatchPlan();
        $_POST['created_by'] = $_COOKIE['user'];
        $model->create($_POST);

        header('Location:?view=match_plan&action=new');

        exit;
    }
    
    public function listall() {
        $model = new MatchPlan();
        $result = $model->listall();
        $header = '';
        $data = '';

        foreach ($result as $item) {

            if ($header == '') {
                foreach ($item as $key => $value) {
                    $header .= '<th>' . $key . '</th>';
                }
            }
            $data .= '<tr onclick="window.location=\'?view=match_plan&action=editall&id=' . $item['id'] . '\'">';
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
        $model = new MatchPlan();
        $model->update($_GET['id']);

        header('Location: ?view=match_plan&action=new');

        exit();
    }

    public function edit() {
        $model = new MatchPlan();
        $result = $model->findAll($_GET['id']);
        $record = null;

        foreach ($result as $value) {
            $record = $value;
        }
        if (!$record) {
            die('Record not found');
        }
        $template = new TemplateEngineController('edit-match-plan');
        $template->set('date', $record['Data']);
        $template->set('Laikas', substr($record['Laikas'], 0, -3));
        $template->set('Lygis', $record['Lygis']);
        $template->set('id', $record['id']);
        $menu = $this->getUpdateMatchPlayers();
        $template->set('menu1', $menu[0]);
        $template->set('menu2', $menu[1]);
        $template->set('menu3', $menu[2]);
        $template->set('menu4', $menu[3]);

        $template->echoOutput();
    }
    
    public function editall() {
        $model = new MatchPlan();
        $result = $model->findAll($_GET['id']);
        $record = null;

        foreach ($result as $value) {
            $record = $value;
        }
        if (!$record) {
            die('Record not found');
        }
        $template = new TemplateEngineController('editall-match-plan');
        $template->set('date', $record['Data']);
        $template->set('Laikas', substr($record['Laikas'], 0, -3));
        $template->set('Lygis', $record['Lygis']);
        $template->set('id', $record['id']);
        $menu = $this->getUpdateMatchPlanPlayers();
        $template->set('menu1', $menu[0]);
        $template->set('menu2', $menu[1]);
        $template->set('menu3', $menu[2]);
        $template->set('menu4', $menu[3]);

        $template->echoOutput();
    }
    
    public function getUpdateMatchPlanPlayers() {

        $menu = array();
        $result = (new MatchPlan())->matchPlayers($_GET['id']);  
        foreach ($result as $players) {
            foreach ($players as $id) { 
                $nickname = (new Users())->findUserNick($id);
                $menu[] = $this->updateMatchMenu().'<option selected hidden value="' . $id . '">' . $nickname . '</option>';  
            }
        }
        return $menu;
    }
    
    public function getUpdateMatchPlayers() {

        $menu = array();
        $result = (new MatchPlan())->matchPlayers($_GET['id']);  
        foreach ($result as $players) {
            foreach ($players as $id) { 
                $nickname = (new Users())->findUserNick($id);
                If (isset($nickname)){
                    $menu[] = '<option selected value="' . $id . '">' . $nickname . '</option>';  
                }
                else{
                    $menu[] = $this->updateMatchMenu();  
                }
            }
        }
        return $menu;
    }
    
    public function updateMatchMenu () {
        $res = (new Users())->getMenu();
        $menu = '';
        $menu .= '<option value="">Ieškomas žaidėjas</option>';
             foreach ($res as $item) {
                
                $menu .= '<option value="' . $item['id'] . '">' . $item['Slapyvardis'] . '</option>';
                }
        return $menu;
    }

    public function delete() {
        $model = new MatchPlan();
        $model->delete($_GET['id']);
        
    }
    public function undelete() {
        $model = new MatchPlan();
        $model->undelete($_GET['id']);

        header('Location: ?view=match_plan&action=table');
    }
    public function permDelete() {
        $model = new MatchPlan();
        $model->permDelete($_GET['id']);

        header('Location: ?view=match_plan&action=table');
    }

    
}
