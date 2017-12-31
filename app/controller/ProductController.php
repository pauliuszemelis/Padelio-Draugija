<?php


namespace app\controller;

use app\model\Product;
use app\model\Users;

class ProductController
{
    public function create()
    {
        $template = new TemplateEngineController('new-product');
        $template->echoOutput();
        //(new TemplateEngineController('new-product'))->echoOutput;
    }

    public function store()
    {
        /*print_r($_POST);
        print_r($_FILES['picture']);*/

        $data = $_POST;

        $destination = 'uploads/' . $_FILES['picture']['name'];

        move_uploaded_file($_FILES['picture']['tmp_name'], $destination);

        $data['picture'] = $destination;

        $model = new Product();
        $model->create($data);

        header('Location:?view=product&action=listall');
        exit;

    }

    public function listall()
    {
        $model = new Product();
        $result = $model->listall();
        $header = '';
        $data = '';

        foreach ($result as $item) {


            if ($header == '') {
                foreach ($item as $key => $value) {
                    $header .= '<th>' . $key . '</th>';

                }
            }
            $data .= '<tr onclick="window.location=\'?view=product&action=edit&id=' . $item['id'] . '\'">';
            foreach ($item as $key => $value) {
                if ($key == 'picture') {
                    $data .= '<td><img src ="' . $value . '" width="200px"></td>';
                } else {
                    $data .= '<td>' . $value . '</td>';
                }
            }
            $data .= '</tr>';
        }

        $template = new TemplateEngineController('table-listall');
        $template->set('header', $header);
        $template->set('data', $data);

        $template->echoOutput();

    }

    public function edit()
    {
        $model = new Product();
        $result= $model->find($_GET['id']);
        $record = null;

        foreach($result as $value) {
            $record = $value;
        }
        if (!$record) {
            die('Record not found');
        }

        $template = new TemplateEngineController('edit-product');
        $template->set('id', $record['id']);
        $template->set('ean', $record['ean']);

        $template->set('name', $record['name']);
        $template->set('weight', $record['weight']);
        $template->set('prime_cost', $record['prime_cost']);
        $template->set('sale_price', $record['sale_price']);
        $template->set('picture', $record['picture']);

        $template->set('unit_' . $record['unit'], 'selected');


        $template->echoOutput();

    }

    public  function update()
    {
        $model = new Product();
        $model->update($_GET['id']);


        header('Location: ?view=product&action=listall');

        exit();

    }
    public function delete()
        {$model = new Product();
        $model->find($_GET['id']);

        header('Location: ?view=product&action=listall');

        exit();



    }
}