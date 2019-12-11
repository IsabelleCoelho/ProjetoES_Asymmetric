<?php
    session_start();
    if (isset($_SESSION['usrId'])) {
        unset($_SESSION['usrId']);
        header("Location: ../View/login.php");
    }
    if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        header("Location: ../View/login.php");
    }
?>