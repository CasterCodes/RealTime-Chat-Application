<?php
   session_start();
   if(isset($_SESSION['unique_id'])) {
     include_once 'config.php';
     $outgoing = mysqli_real_escape_string($connection, $_POST['outgoing']);
     $incoming = mysqli_real_escape_string($connection, $_POST['incoming']);
     $message = mysqli_real_escape_string($connection, $_POST['message']);
     if(!empty($message)) {
        $query = "INSERT INTO messages (outgoing_Id, incoming_id, message) 
        VALUES ('{$outgoing}', '{$incoming}', '{$message}')" ;
          if(!mysqli_query($connection, $query)){
              die();
          }else {
              echo 'success';
          }
     }
    
   }else {
       header('Location:../login.php');
   }
 ?>