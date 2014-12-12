<?php namespace nsreinc;
session_start();

require('../../../vendor/autoload.php');

use nsreinc\models\User;

if ($_SESSION['logged_in']){

    $user = new User();
    $_POST['password'] = md5($_POST['password']);
    $user->create($_POST);
    $status = $user->save();
    $user_data = $user->get_user_data();

//echo json_encode($uploaded);
    echo json_encode(array('saved' => $status, 'userData' => $user_data));
} else {
    echo json_encode(array('error' => 'User not logged in'));
}

