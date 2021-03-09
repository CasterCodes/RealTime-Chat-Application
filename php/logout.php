<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once 'config.php';
    if(isset($_GET['user'])) {
        $logoutId = mysqli_real_escape_string($connection, $_GET['user']);
        echo $logoutId;
        $status = 'Offline';
        $sql = "UPDATE users SET status ='{$status}' WHERE unique_id = {$logoutId}";
        $query = mysqli_query($connection, $sql);
        if($query) {
            session_destroy();
            session_unset();
            header('Location:../login.php');
        }else {
            echo 'Error';
        }

    }else {
        header('Location:..login.php');
    }
}else {
       header('Location:..login.php');
}