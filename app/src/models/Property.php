<?php

namespace nsreinc\models;

use nsreinc\DBConnection;


class Property {
    private $conn;
    private $link;
    private $sql;

    public function __construct(){
        $this->conn = new DBConnection();
        $this->link = $this->conn->connection();
    }

    public function all(){
        $this->sql = "SELECT * FROM property";
        return $this->results();
    }

    public function find($property_id){
        $this->sql = "SELECT * FROM property WHERE id = " . $property_id;
        return $this->results()->fetch_assoc();
    }

    private function results(){
        $result = $this->link->query($this->sql);

        return $result;
    }
}