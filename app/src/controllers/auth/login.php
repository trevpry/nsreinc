<?php namespace nsreinc\auth;
session_start();

require('../../../vendor/autoload.php');

use nsreinc\models\User;

$email = $_POST['email'];
$password = md5($_POST['password']);
$auth = false;

$user = new User();
//$status = $user->findByEmail(mysql_real_escape_string($email));
$status = $user->findByEmail($email);

if ($status === 'success'){
    $user_data = $user->get_user_data();

    if ($password === $user_data['password']){
        $auth = true;
        $_SESSION['logged_in'] = true;
    }

    //echo json_encode('test');
    echo json_encode(array('found' => 'success', 'auth' => $auth, 'userData' => $user_data, 'password' => $password));
} else {
    //echo $_POST['username'];
    echo json_encode(array('found' => $status, 'query' => $user->get_query()));
}

//echo json_encode($user->get_query());
//echo 'test';
