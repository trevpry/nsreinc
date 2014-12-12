<?php namespace nsreinc;
session_start();

require('../../../vendor/autoload.php');

use nsreinc\models\User;

if ($_SESSION['logged_in']){
    $user = new User();
    $user->find($_POST['id']);
    $destroyed = $user->destroy();

    //echo $property_data;


    //echo json_encode($user->get_user_data());
    echo json_encode(array('destroyed' => $destroyed));
} else {
    echo json_encode(array('error' => 'User not logged in'));
}

//echo json_encode($_POST['id']);
//echo json_encode($_FILES);
