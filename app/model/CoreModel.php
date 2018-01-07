<?php

namespace app\model;

class CoreModel
{
    private $servername = '127.0.0.1';
    private $username = 'root';
    private $password = '';
    private $dbname = 'pz_padelclub';

    private $conn;

    protected $table;

    public function __construct()
    {
        if (!$this->table) {
            die("No table name provided.");
        }
    }

    private function connect()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        if (!$this->conn) {
            die("Not so much success connecting...");
        }

        $this->conn->set_charset('utf8mb4');

    }

    protected function query($query)
    {
        $this->connect();
        $result = $this->conn->query($query);
        if ($result) {
            $this->conn->close();
            return $result;
        }
        print_r($this->conn);
        $this->conn->close();
        die();
    }

    protected function generateInsertQuery(array $data, $uuid = false)
    {

        if ($uuid) {
            $data['id'] = uniqid();
        }

        $keys = $values = '';

        foreach ($data as $key => $value) {
            $keys .= "`$key`, ";
            $values .= "'$value', ";
        }
        $keys = rtrim($keys, ", ");
        $values = rtrim($values, ", ");

        $query = "INSERT INTO `".$this->table ."` ($keys) VALUES ($values)";

        return ($query);

    }
    public function getMenu (){
        $query = "SELECT `id`, `Slapyvardis` FROM `".$this->table ."` WHERE `deleted_at` IS NULL ORDER BY `club_users`.`Slapyvardis` ASC";
        return $this->query($query);
    }

    public function listall (){
        $query = "SELECT * FROM `".$this->table ."`";
        return $this->query($query);
    }
    public function findAll($id){
        $query = "SELECT * FROM `" . $this->table . "` WHERE `id`= '$id'";
        return $this->query($query);
    }

    public function find($id){
        $query = "SELECT * FROM `" . $this->table . "` WHERE `deleted_at` IS NULL AND `id`= '$id'";
        return $this->query($query);
    }
    
    public function update ($id) {
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
    
    public function delete ($id)
    { 
        $query = "UPDATE `" . $this->table . "` SET `deleted_at` = CURRENT_TIMESTAMP WHERE `id`='$id'";
        return $this->query($query);
    }
    public function undelete ($id)
    { 
        $query = "UPDATE `" . $this->table . "` SET `deleted_at` = NULL WHERE `id`='$id'";
        return $this->query($query);
    }
    
    public function permDelete ($id)
    {
        $query = "DELETE FROM `" . $this->table . "` WHERE `id`='$id'";
        return $this->query($query);
    }
    
    public function findUserNick ($id) {
            $model = new Users();
            $findUser = $model->findUser($id);
            foreach ($findUser as $value) {
                $record = $value;
                $echoNickname = ($record['Slapyvardis']);
                return $echoNickname;
            }
    }
    
    public function isEmptyForm () {
        foreach ($_POST as $value) {
            if (empty($value)) {
                die('<div class="text-center" style="color:red">Būtina užpildyti visus duomenis...</div>');
            }
        } 
    }
    
    
    
}

