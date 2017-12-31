<?php

namespace app\model;


use app\model\interfaces\Destroyable;
use app\model\interfaces\Manageable;

class Users extends CoreModel implements Manageable, Destroyable
{

    protected $table = 'association_users';
    public function create(array $data)
    {

        $query = $this->generateInsertQuery($data, true);
        $this->query($query);
    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }

    public function echoOutput()
    {
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

    public function updateRanks ($rank, $progress, $id)
    {
        $query = "UPDATE `" . $this->table . "` SET `Reitingas`=" . $rank . ", `Paskutinis`='" . $progress . "' WHERE `id`='$id'";
        return $this->query($query);
    }

    public function findUser ($id) {
        $query = "SELECT `Slapyvardis` FROM `association_users` WHERE `deleted_at` IS NULL AND `id`= '$id'";
        return $this->query($query);
    }
    public function playersList () {
        $query = "SELECT `Nr`, `Slapyvardis`, `Vardas`, `Pavardė`, `Reitingas`, `Paskutinis` FROM `association_users` WHERE `deleted_at` IS NULL ORDER BY `association_users`.`Reitingas` DESC";
        return $this->query($query);
    }
}
