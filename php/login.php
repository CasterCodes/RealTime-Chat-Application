<?php
session_start();
include_once 'config.php';

if(isset($_POST['submit'])){
      loginUser();
}else {
    header('location:../index.php');
}
function loginUser() {
      global $connection;
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $password = mysqli_real_escape_string($connection, $_POST['password']);
      if(empty($email) || empty($password)) {
          echo 'Please fill all fields';
      }else {
           $query = "SELECT * FROM users WHERE email = '{$email}'";
           $result = mysqli_query($connection, $query);
           if(mysqli_num_rows($result) > 0){
               $user = mysqli_fetch_assoc($result);
               $isPasswordCorrect = password_verify($password,$user['password'] );
               if(!$isPasswordCorrect) {
                   echo 'Password or email is incorrect';
               }else {
                $status = 'Online';
                $sql = "UPDATE users SET status = '{$status}' WHERE unique_id = {$user['unique_id']}";
                $query = mysqli_query($connection, $sql);
                if($query) {
                    echo 'success';
                    $_SESSION['unique_id'] = $user['unique_id'];
                }
                 
               }
           }else {
               echo 'Password or email is incorrect';
           }
      }

}


