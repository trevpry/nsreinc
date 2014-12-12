<?php
session_start();
require('../../vendor/autoload.php');

$users = new nsreinc\models\User();
$rows = $users->all();
?>

<div class="slide-page" id="slide3">
    <div class="logout">Log out</div>

    <?php if ($_SESSION['logged_in']){
        echo
            '<div class="form-add-user">
            <h3 class="add-link">Add new User</h3> <br>

            <form class="user-form create form-dialog">
            <div class="validate-tips"></div>
                <div><input type="hidden" id="id" name="id"></div>
                <div><label for="first_name">First Name:</label><input type="text" id="first-name" name="first_name"></div>
                <div><label for="last_name">Last Name:</label><input type="text" id="last-name" name="last_name"></div>
                <div><label for="email">Email:</label><input type="text" id="email" name="email"></div>
                <div><label for="password">Password:</label><input type="text" id="password" name="password"></div>
                <div><label for="password_confirm">Confirm Password:</label><input type="text" id="password-confirm" name="password_confirm"></div>
                <div><input type="submit" id="submit"></div>
            </form>
            <form class="user-form update form-dialog">
            <div class="validate-tips"></div>
                <div><input type="hidden" id="id" name="id"></div>
                <div><label for="first_name">First Name:</label><input type="text" id="first-name" name="first_name"></div>
                <div><label for="last_name">Last Name:</label><input type="text" id="last-name" name="last_name"></div>
                <div><label for="email">Email:</label><input type="text" id="email" name="email"></div>
                <div><label for="password">Password:</label><input type="text" id="password" name="password"></div>
                <div><label for="password_confirm">Confirm Password:</label><input type="text" id="password-confirm" name="password_confirm"></div>
                <div><input type="submit" id="submit"></div>
            </form>
        </div>';
    }?>

    <div class="user-list">
        <?php



        foreach ($rows as $row){
            $admin = '';
            if ($_SESSION['logged_in']){
                $admin = '<div class="admin">
                <div id="edit">Edit</div>
                <div id="delete">Delete</div>
                </div>';
            }

            echo '<div class="user border-bottom" id="' . $row['id'] . '" user-id="' . $row['id'] . '">

                <div class="user-details">
                    <p class="user-name"><span class="label">User Name: </span><span class="detail">' . $row['first_name'] . ' ' . $row['last_name'] . '</span></p>
                    <p class="email"><span class="label">Email: </span><span class="detail">'. $row['email'] .'</span></p>
                    <p class="first-name hidden"><span class="detail">'. $row['first_name'] .'</span></p>
                    <p class="last-name hidden"><span class="detail">'. $row['last_name'] .'</span></p>
                </div>';

            echo $admin .
                '</div>';
        }

        ?>
    </div>

</div>


