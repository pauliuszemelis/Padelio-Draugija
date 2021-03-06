<?php

namespace app\model; // jeigu palieku namespace - niekas neveikia

use app\model\interfaces\Destroyable;
use app\model\interfaces\Manageable;

class MatchHistory extends CoreModel implements Manageable, Destroyable {

    protected $table = 'match_history';

    public function create(array $data) {

        $query = $this->generateInsertQuery($data, true);
        print_r($this->query($query));
    }

    public function destroy() {
        
    }
    
    public function matchPlanForHistory() {
        $query = "SELECT `Nr`, `Data`, `Laikas`, `teammate1`, `teammate2`, `oponent1`, `oponent2`, `Lygis`, `id` FROM `match_plan` WHERE `deleted_at` IS NULL AND `Data` <= CURDATE() ORDER BY `match_plan`.`Data` ASC, `Nr`";
        return $this->query($query);
    }

    public function matchHistory() {
        $query = "SELECT `Nr`, `Data`, `teammate1`, `teammate2`, `team1_result1`, `team2_result1`, `team1_result2`, `team2_result2`, `team1_result3`, `team2_result3`, `oponent1`, `oponent2` FROM `match_history` WHERE `deleted_at` IS NULL ORDER BY `match_history`.`Data` DESC, `Nr` DESC";
        return $this->query($query);
    }

    public function matchPlayers($id) {
        $query = "SELECT `teammate1`, `teammate2`, `oponent1`, `oponent2` FROM `match_history` WHERE `id`= '$id'";
        return $this->query($query);
    }
    public function update ($id) {
        $_POST['updeated_by'] = $_SESSION['user'];
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

}
