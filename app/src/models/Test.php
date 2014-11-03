<?php
namespace nsreinc\models;

use nsreinc\DBConnection;

class Test {

    private $conn;
    private $link;
    private $sql;

    public function __construct(){
        $this->conn = new DBConnection();
        $this->link = $this->conn->connection();
    }

    public function all(){
        $this->sql = "SELECT * FROM test";
        return $this->results();
    }

    public function body($value){
        $this->sql = "SELECT * FROM test WHERE body='" . $value . "'";
        return $this->results($value);
    }

    private function results(){
        $result = $this->link->query($this->sql);

        return $result;
    }
}

