<?php
namespace nsreinc\models;

use nsreinc\DBConnection;

class User {

    private $conn;
    private $link;
    private $sql;
    private $user_data = array();

    public function __construct(){
        $this->conn = new DBConnection();
        $this->link = $this->conn->connection();
    }

    public function get_user_data(){
        return $this->user_data;
    }

    public function get_query(){
        return $this->sql;
    }

    private function updates($form_data){
        $updates = '';

        foreach($form_data as $key => $value){
            if ($value != '' && $key != 'id'){
                $updates .= $key . "='" . $value . "',";
                $this->user_data[$key] = $value;
            }
        }

        //return $form_data;
        return rtrim($updates, ',');
    }

    public function all(){
        $this->sql = "SELECT * FROM users";
        return $this->results();
    }

    public function create($user){
        $this->user_data['first_name'] = (!is_null($user['first_name']) && !empty($user['first_name'])) ? $user['first_name'] : '';
        $this->user_data['last_name'] = (!is_null($user['last_name']) && !empty($user['last_name'])) ? $user['last_name'] : '';
        $this->user_data['email'] = (!empty($user['email'])) ? $user['email'] : '';
        $this->user_data['password'] = (!empty($user['password'])) ? $user['password'] : '';
        if (!empty($user["id"])){
            $this->user_data['id'] = (int) $user["id"];
        }
    }

    public function save(){
        $this->sql = "INSERT INTO users (first_name, last_name, email, password)
                      VALUES (" . '"' . join('","',$this->user_data) . '")';

        if ($this->results() == true){
            //echo "New Record Created Successfully";
            $this->user_data['id'] = $this->link->insert_id;
            return 'success';
        } else {
            return "Error: " . $this->sql . "<br>" . $this->link->error;
        }
    }

    public function update($form_data){
        //return $form_data;
        $this->sql =    'UPDATE users SET ' .
            $this->updates($form_data) .
            ' WHERE id=' . $this->user_data['id'];

        //return count($form_data);
        //return $this->updates($form_data);
        //return $this->sql;
        if ($this->results()){
            //echo "New Record Created Successfully";
            return 'success';
        } else {
            return "Error: " . $this->sql . "<br>" . $this->link->error;
        }
    }

    public function destroy(){
        $this->sql = "DELETE FROM users WHERE id=" . $this->user_data['id'];
        //$this->sql = "DELETE FROM users WHERE id='$this->user_data['id']'";

        //return $this->sql;
        return $this->results();
    }

    public function find($id){

        $this->sql = "SELECT * FROM users WHERE id='$id'";
        //return $id;
        $results= $this->results()->fetch_assoc();

        if ($results != null) {
            $this->create($results);

            return 'success';
        } else {
            return 'Record not found';
        }
    }

    public function findByEmail($email){

        $this->sql = "SELECT * FROM users WHERE email = '$email'";
        $results= $this->results()->fetch_assoc();

        //return $results['first_name'];
        if (!is_null($results)) {
            //return 'success';
            $this->create($results);

            return 'success';
        } else {
            return 'Record not found';
        }
    }

    private function results(){
        $result = $this->link->query($this->sql);

        return $result;
    }
}

