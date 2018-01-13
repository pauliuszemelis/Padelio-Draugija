<?php

namespace app\model; // jeigu palieku namespace - niekas neveikia

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

    public function matchHistory() {
        $query = "SELECT `Nr`, `Data`, `teammate1`, `teammate2`, `team1_result1`, `team2_result1`, `team1_result2`, `team2_result2`, `team1_result3`, `team2_result3`, `oponent1`, `oponent2` FROM `match_history` WHERE `deleted_at` IS NULL ORDER BY `match_history`.`Data` DESC";
        return $this->query($query);
    }

    public function matchPlayers($id) {
        $query = "SELECT `teammate1`, `teammate2`, `oponent1`, `oponent2` FROM `match_history` WHERE `id`= '$id'";
        return $this->query($query);
    }
    public function update ($id) {
        $_POST['updeated_by'] = $_COOKIE['user'];
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
