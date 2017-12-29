<?php


namespace app;

use app\controller\TemplateEngineController;
use app\model\MatchHistory;
use app\model\Product;
use app\model\productHistory;
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

    public function getUsersOptions() : string
    {
        $result = (new Users())->list();
        $menu = '';

        foreach ($result as $key => $item) {
            $menu .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';

        }
        return $menu;
    }


    public function store()
    {

        $model = new MatchHistory();
        $model->create($_POST);

        header('Location:?view=match_history&action=list');

        exit;
    }

    public function list()
    {
        $model = new MatchHistory();
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
}
