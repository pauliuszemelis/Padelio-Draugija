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
    
    public function createVerificationCode ($code, $email) {
        $query = "UPDATE `$this->table` SET `verification_code` = '$code' WHERE `$this->table`.`email` = '$email';";
        return $this->query($query);
    }
    
    public function createNewPassword ($newPass, $email) {
        $newPass = sha1($newPass . SALT);
        $query = "UPDATE `$this->table` SET `password` = '$newPass' WHERE `$this->table`.`email` = '$email';";
        return $this->query($query);
    }
    
    public function updatePassword ($data) {
        $query = "UPDATE `$this->table` SET `password` = '".$data['password']."', `updated_at` = '".date('Y-m-d H:i:s')."'  WHERE `$this->table`.`id` = '".$_COOKIE['user']."';";
        return $this->query($query);
    }
    
    public function checkVerificationCode ($email) {
        $query = "SELECT `verification_code` FROM `$this->table` WHERE `$this->table`.`email` = '$email';";
        return $this->query($query);
    }
    
    public function verifyCode ($email) {
        $query = "UPDATE `$this->table` SET `verified` = '1', `verification_code` = '0' WHERE `$this->table`.`email` = '$email';";
        return $this->query($query);
    }

    public function checkIsVeryfied ($email) {
        $query = "SELECT `verified` FROM `" . $this->table . "` WHERE `deleted_at` IS NULL AND `email`= '$email';";
        return $this->query($query);
    }

    public function findUser ($id) {
        $query = "SELECT `Vardas`, `Pavardė` FROM `" . $this->table . "` WHERE `deleted_at` IS NULL AND `id`= '$id';";
        return $this->query($query);
    }
    public function playersList () {
        $query = "SELECT `Nr`, `Vardas`, `Pavardė`, `Reitingas`, `Paskutinis`, `win`, `lose` FROM `club_users` WHERE `deleted_at` IS NULL ORDER BY `club_users`.`Reitingas` DESC";
        return $this->query($query);
    }
    public function selfupdate ($id) {
        
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
    public function find($id){
        $query = "SELECT * FROM `" . $this->table . "` WHERE `deleted_at` IS NULL AND `id`= '$id'";
        return $this->query($query);
    }
    
    public function updateLastMsg ($msg) {
        $query = "UPDATE `$this->table` SET `lastSeenMsg` = '".$msg."' WHERE `$this->table`.`id` = '".$_COOKIE['user']."';";
        //$query = "UPDATE `padelioklu_padelclub`.`club_users` SET  `lastSeenMsg` =  'juozas' WHERE  `club_users`.`id` =  '5a51da7dbde45';";
        return $this->query($query);  
    }
    
    public function checkLastMsg () {
        $query = "SELECT `lastSeenMsg` FROM `" . $this->table . "` WHERE `id`= '" .$_COOKIE['user']. "'";
        return $this->query($query);
    }
}
?>