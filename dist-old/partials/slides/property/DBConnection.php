<?php

namespace nsreinc;


class DBConnection {


    //Database Connection: local
//    private $host = 'localhost';
//    private $user = 'root';
//    private $password = 'root';
//    private $db = 'nsreinc';

    //Database Connection: production
//    private $host = 'mysql.trevpry.com';
//    private $user = 'trevpry';
//    private $password = 'rootroot';
    //private $db = 'nsreinc';
    private $host = 'nsreinccom.ipagemysql.com';
    private $user = 'nsreinc';
    private $password = 'rootroot';
    private $db = 'nsreinc';


    private $status = 'not connected';
    private $conn;



    public function __construct(){
        try {
            $this->conn = new \mysqli(
                $this->host,
                $this->user,
                $this->password,
                $this->db
            );

            if (mysqli_connect_error()){
                $this->status = 'error';
                //$this->error = $this->conn->connect_error;
                die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
            } else {
                $this->status = 'ok';
            }
        } catch (Exception $e){
            $this->status = 'error';
            echo $e;
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
