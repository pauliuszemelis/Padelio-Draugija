<?php

namespace app\model;

use app\model\interfaces\Destroyable;
use app\model\interfaces\Manageable;

class MatchPlan extends CoreModel implements Manageable, Destroyable {

    protected $table = 'match_plan';

    public function create(array $data) {

        $query = $this->generateInsertQuery($data, true);
        print_r($this->query($query));
    }

    public function destroy() {
        
    }

    public function matchPlan() {
        $query = "SELECT `Nr`, `Data`, `Laikas`, `teammate1`, `teammate2`, `oponent1`, `oponent2`, `Lygis`, `id` FROM `match_plan` WHERE `deleted_at` IS NULL AND `Data` >= CURDATE() ORDER BY `match_plan`.`Data` ASC";
        return $this->query($query);
    }
    
    public function matchPlayers($id) {
        $query = "SELECT `teammate1`, `teammate2`, `oponent1`, `oponent2` FROM `match_plan` WHERE `id`= '$id'";
        return $this->query($query);
    }
    public function update ($id) {
        $_POST['updeated_by'] = $_COOKIE['user'];
        $_POST['updated_at'] = date('Y-m-d H:i:s');
        $data = $_POST;
        $options = '';
        foreach ($data as $key => $value) {
            $options .= "`$key` = '$value', ";
        }
        $options = rtrim($options, ", ");
        $query = "UPDATE `" . $this->table . "` SET " . $options . " WHERE `id`='$id'";
        return $this->query($query);
    }
    public function delete ($id)
    { 
        $query = "UPDATE `" . $this->table . "` SET `deleted_at` = CURRENT_TIMESTAMP WHERE `id`='$id'";
        return $this->query($query);
    }
    
    public function findAll($id){
        $query = "SELECT * FROM `" . $this->table . "` WHERE `id`= '$id'";
        return $this->query($query);
    }

}
