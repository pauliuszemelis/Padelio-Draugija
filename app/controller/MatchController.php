<?php


namespace app;

use app\controller\TemplateEngineController;
use app\model\MatchHistory;
//use app\model\Product;
use app\model\Users;

class MatchController
{
    public function create()
    {
        $template = new TemplateEngineController('match-history');

        $menu = $this->getUsersOptions();
        $date = date('Y-m-d');
        $template->set('menu', $menu);
        $template->set('date', $date);

        $template->echoOutput();
    }

    public function getUsersOptions()
    {
        $result = (new Users())->listall();
        $menu = '';

        foreach ($result as $key => $item) {
            $menu .= '<option value="' . $item['id'] . '">' . $item['Slapyvardis'] . '</option>';
        }
        $menu .= '<option selected value="">Pasirinkite žaidėją</option>';
        return $menu;
    }


    public function store()
    {

        $model = new MatchHistory();
        $model->create($_POST);

        header('Location:?view=match_history&action=table');

        exit;
    }

    public function table()
    {
        $model = new MatchHistory();
        $result = $model->matchHistory();
        $data = '';
        $header = '<th>Nr</th><th>Data</th><th colspan=2>Komanda 1</th><th colspan=2>Pirmas setas</th><th colspan=2>Antras setas</th><th colspan=2>Trečias setas</th><th colspan=2>Komanda 2</th>';
        foreach ($result as $item) {
            $data .= '<tr>';
            foreach ($item as $key => $value) {
                if($key == 'teammate1' || $key == 'teammate2' || $key == 'oponent1' || $key == 'oponent2'){
                    $value = (new Users())->findUserNick($value);
                    }
                $data .= '<td>' . $value . '</td>';
            }
            $data .= '</tr>';
        }
        $template = new TemplateEngineController('table-listall');
        $template->set('header', $header);
        $template->set('data', $data);


        $template->echoOutput();

    }
    public function listall()
    {
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
            $data .= '<tr>';
            foreach ($item as $key => $value) {
                $data .= '<td>' . $value . '</td>';

            }
            $data .= '</tr>';
        }
        $template = new TemplateEngineController('table-listall');
        $template->set('header', $header);
        $template->set('data', $data);


        $template->echoOutput();

    }
}
