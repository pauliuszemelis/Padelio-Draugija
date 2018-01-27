<?php

namespace app\model; // jeigu palieku namespace - niekas neveikia

use app\model\interfaces\Destroyable;
use app\model\interfaces\Manageable;

class Users extends CoreModel implements Manageable, Destroyable
{

    protected $table = 'club_users';
    public function create(array $data)
    {

        $query = $this->generateInsertQuery($data, true);
        $this->query($query);
    }
    public function destroy() {
    }

    public function echoOutput() {
    }

    public function auth ($data) {
        $query = "SELECT * FROM `".$this->table ."` WHERE `deleted_at` IS NULL 
                                            AND `email` ='" . $data['email'] . "' 
                                            AND `password` ='" . $data['password'] . "'";
        return $this->query($query);
    }

    public function getRank ($id) {
            $query = "SELECT `Reitingas` FROM `" . $this->table . "` WHERE `deleted_at` IS NULL AND `id`= '$id'";
            return $this->query($query);
    }

    public function updateRanks ($rank, $progress, $id, $win, $lose)
    {
        $query = "UPDATE `" . $this->table . "` SET `Reitingas`=" . $rank . ", `win`=" . $win . ", `lose`=" . $lose . ", `Paskutinis`='" . $progress . "' WHERE `id`='$id'";
        return $this->query($query);
    }
    public function checkEmail () {
        $query = "SELECT `email` FROM `" . $this->table . "`";
        return $this->query($query);
    }

    public function findUser ($id) {
        $query = "SELECT `Vardas`, `Pavardė` FROM `" . $this->table . "` WHERE `deleted_at` IS NULL AND `id`= '$id'";
        return $this->query($query);
    }
    public function playersList () {
        $query = "SELECT `Nr`, `Vardas`, `Pavardė`, `Slapyvardis`, `Reitingas`, `Paskutinis`, `win`, `lose` FROM `club_users` WHERE `deleted_at` IS NULL ORDER BY `club_users`.`Reitingas` DESC";
        return $this->query($query);
    }
    public function selfupdate ($id) {
        if(!empty($_POST['password'])){  
            $_POST['password'] = sha1($_POST['password'] . SALT);
        }
        else {
            unset($_POST['password']);
        }
        $data = $_POST;
        $options = '';
        foreach ($data as $key => $value) {
            $options .= "`$key` = '$value', ";
        }
        $options = rtrim($options, ", ");
        $query = "UPDATE `" . $this->table . "` SET " . $options . " WHERE `id`='$id'";
        return $this->query($query);
    }
    public function find($id){
        $query = "SELECT * FROM `" . $this->table . "` WHERE `deleted_at` IS NULL AND `id`= '$id'";
        return $this->query($query);
    }
}
?>