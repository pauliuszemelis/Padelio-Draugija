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
        $menu = '';

        foreach ($result as $item) {
            $menu .= '<option value="' . $item['id'] . '">' . $item['Slapyvardis'] . '</option>';
        }
        $menu .= '<option selected value="">Pasirinkite žaidėją</option>';
        return $menu;
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
    
}
