<?php
session_start();

    unset($_SESSION["user_name"]);
    unset($_SESSION["unit"]);

    $_SESSION['message'] = "Successfully Logout!";
    header("Location: ./index.php");


?>