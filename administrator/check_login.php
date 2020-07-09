<?php
session_start();
include_once('../config.php');


$user_name = $_POST['user_name'];
$password = $_POST['password'];

if(!empty($user_name) && !empty($password)){

    $SQL = "SELECT * FROM `tb_user` WHERE `user_name`='$user_name' and `password`='$password' and `status`=1";

    $result = mysql_query($SQL);


        while ($row = mysql_fetch_array($result)) {

            $username = $row['user_name'];
            $unit = $row['unit'];

        }

        if ($username != ''){

            $_SESSION['user_name'] = $username;
            $_SESSION['unit'] = $unit;

            header("Location: ./admin_panel.php");

        }else{

            $_SESSION['exception'] = "Username/Password is wrong!";
            header("Location: ./index.php");

        }

}
?>