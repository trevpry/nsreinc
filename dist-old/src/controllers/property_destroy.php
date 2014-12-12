<?php namespace nsreinc;
session_start();

require('../../vendor/autoload.php');

use nsreinc\models\Property;

if ($_SESSION['logged_in']){
    $property = new Property();
    $property->find($_POST['id']);
    $destroyed = $property->destroy();

    //echo $property_data;


    //echo json_encode($uploaded);
    echo json_encode($destroyed);
} else {
    echo json_encode(array('error' => 'User not logged in'));
}

//echo json_encode($_POST['id']);
//echo json_encode($_FILES);
