<?php namespace nsreinc;
session_start();

require('../../../vendor/autoload.php');

use nsreinc\models\User;

if ($_SESSION['logged_in']){
    $user = new User();
    $found = $user->find($_POST['id']);
    $status = $user->update($_POST);
    //$status = 'success';
    $user_data = $user->get_user_data();

    //echo json_encode('test');
    //echo json_encode($_POST);
    //echo json_encode([$_POST, $found, $status]);
    echo json_encode(array('saved' => $status, 'userData' => $user_data));
} else {
    echo json_encode(array('error' => 'User not logged in'));
    //echo json_encode($_SESSION);
}


//echo json_encode($_FILES);
//echo json_encode($_FILES);
