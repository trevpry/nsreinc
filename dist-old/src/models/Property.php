<?php namespace nsreinc\models;
session_start();

use nsreinc\DBConnection;


class Property {
    private $conn;
    private $link;
    private $sql;

    private $status;
    private $price;
    private $property_type;
    private $location;
    private $highlights;
    private $property_data = array();

    public function __construct(){
        $this->conn = new DBConnection();
        $this->link = $this->conn->connection();
    }

    public function get_property_data(){
        return $this->property_data;
    }

    private function updates($form_data){
        $updates = '';

        foreach($form_data as $key => $value){
            if ($value != '' && $key != 'id'){
                if ($key == 'highlights'){
                    $value = $this->highlights_markup($value);
                }
                if ($key == 'listing_price'){
                    $value = (float) $value;
                }
                $this->property_data[$key] = $value;

                if (is_int($value) || is_float($value)){
                    $updates .= $key . '=' . $value . ',';
                } else {
                    $updates .= $key . "='" . $value . "',";
                }
            }
        }

        return rtrim($updates, ',');
    }

    private function highlights_markup($highlights){
        $markup = explode("\n", $highlights);
        $new_highlights = '';

        foreach($markup as $line){
            if (substr($line, 0, 2) == '||'){
                //$new_highlights .= '<li class="bold">' . substr($line, 2, strlen($line)) . '</li>';
                $new_highlights .= '<li><strong>' . substr($line, 2, strlen($line)) . '</strong></li>';
            } else {
                $new_highlights .= '<li>' . $line . '</li>';
            }
        }

        return $new_highlights;
    }
    
    public function create($property){
        //$data = [];
        $this->property_data['status'] = (!empty($property["status"])) ? $property["status"] : '';
        $this->property_data['price'] = (!empty($property["listing_price"])) ? (float) $property["listing_price"] : '';
        $this->property_data['property_type'] = (!empty($property["property_type"])) ? $property["property_type"] : '';
        $this->property_data['location'] = (!empty($property["city"])) ? $property["city"] : '';
        $this->property_data['highlights'] = (!empty($property["highlights"]))
            ? $this->highlights_markup($property["highlights"]) : '';
        if (!empty($property["id"])){
            $this->property_data['id'] = (int) $property["id"];
        }
//        $this->property_data[] = $data;
    }

    public function save(){
        $this->sql = "INSERT INTO comm_properties (status, listing_price, property_type, city, highlights)
                      VALUES (" . '"' . join('","',$this->property_data) . '")';

        if ($this->results() == true){
            //echo "New Record Created Successfully";
            $this->property_data['id'] = $this->link->insert_id;
            return 'success';
        } else {
            return "Error: " . $this->sql . "<br>" . $this->link->error;
        }
    }

    public function update($form_data){
        $form_data['highlights'] =

        $this->sql =    'UPDATE comm_properties SET ' .
                        $this->updates($form_data) .
                        ' WHERE id=' . $this->property_data['id'];

        //return $this->sql;
        if ($this->results()){
            //echo "New Record Created Successfully";
            return 'success';
        } else {
            return "Error: " . $this->sql . "<br>" . $this->link->error;
        }
    }

    public function destroy(){
            $this->sql = "DELETE FROM comm_properties WHERE id=" . $this->property_data['id'];
            return $this->results();
        //return $this->execute($query);
    }

    public function all($options){
        $this->sql = "SELECT * FROM comm_properties ORDER BY id " . $options['sort'];
        return $this->results();
    }

    public function find($property_id){
        //global $sql;

        $this->sql = "SELECT * FROM comm_properties WHERE id = " . $property_id;
        $results= $this->results();

        if ($results != null) {
            $this->create($results->fetch_assoc());
            return 'success';
        } else {
            return 'Record not found';
        }

//        self::$sql = "SELECT * FROM comm_properties WHERE id = " . $property_id;
//        $results =  self::results()->fetch_assoc();
//        return self::results();
//        $property = new Property();
//        $property->create($results);
//        return $property;
    }

    public function findByPropertyType($property_type, $options) {
        $this->sql = "SELECT * FROM comm_properties WHERE property_type = '$property_type' ORDER BY id " . $options['sort'];
        //$results= $this->results();
        //$results = $this->execute($query);

        return $this->results();
//        if ($results != null) {
//            $this->create($results->fetch_assoc());
//            return 'success';
//        } else {
//            return 'Record not found';
//        }
    }

    private function execute($query){
        $results = $this->link->query($query);

        if ($results != null) {
            foreach($results as $result){
                $this->create($result);
            }
            //return 'success';

        }
        //return $results->fetch_assoc();
        return $results;

        //return 'Record not found';
    }

    private function results(){
        $result = $this->link->query($this->sql);

        return $result;
    }
}