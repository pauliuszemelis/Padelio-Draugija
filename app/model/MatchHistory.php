<?php

namespace app\model;

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

    public function matchHistory() {
        $query = "SELECT `Nr`, `Data`, `teammate1`, `teammate2`, `team1_result1`, `team2_result1`, `team1_result2`, `team2_result2`, `team1_result3`, `team2_result3`, `oponent1`, `oponent2` FROM `match_history` WHERE `deleted_at` IS NULL ORDER BY `match_history`.`Data` DESC";
        return $this->query($query);
    }

    public function matchPlayers($id) {
        $query = "SELECT `teammate1`, `teammate2`, `oponent1`, `oponent2` FROM `match_history` WHERE `id`= '$id'";
        return $this->query($query);
    }

}
