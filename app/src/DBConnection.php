<?php

namespace nsreinc;


class DBConnection {

    //Database Connection: local
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'root';
    private $db = 'nsreinc';

    //Database Connection: production
//    private $host = 'mysql.trevpry.com';
//    private $user = 'trevpry';
//    private $password = 'rootroot';
//    private $db = 'nsreinc';


    private $status = 'not connected';
    private $conn;



    public function __construct(){
        $this->conn = new \mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->db
        );

        if ($this->conn->connect_error){
            $this->status = 'error';
        } else {
            $this->status = 'ok';
        }
    }

    public function connection(){
        if ($this->status == 'ok'){
            return $this->conn;
        } else {
            return $this->status;
        }
    }

    public function status(){
        return $this->status;
    }
}
