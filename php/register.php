<?php
session_start();
include_once 'config.php';

if(isset($_POST['submit'])){
      registerUser();
}else {
    header('location:../index.php');
}
function registerUser() {
      global $connection;
      $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
      $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $password = mysqli_real_escape_string($connection, $_POST['password']);
      $confirmPassword = mysqli_real_escape_string($connection, $_POST['confirmPassword']);
      $photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;

      if(empty($firstName) || empty($lastName) || empty($email)|| empty($password)) {
            echo 'Please fill all the fields';
      }else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Your email is not valid";
         }else {
            $query = "SELECT * FROM users WHERE email = '{$email}'";

            $emailExits = mysqli_query($connection,$query );
      
            if(mysqli_num_rows($emailExits) > 0 ) {
                    echo 'Email is alreay taken';
            }else {
                if($password != $confirmPassword) {
                    echo 'The two passwords do not match';
                }else {
                    if(empty($photo)) {
                        echo 'Please choose a an image';
                   }else {
                    $fileName = uploadUserImage($photo);
                    if(!empty($fileName)) {
                           $randomId = rand(time(), 50000);
                           $status = 'Online';
                           $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                           $query = "INSERT INTO users(unique_id,first_name,last_name,email,password, image, status) 
                             VALUES('{$randomId}', '{$firstName}','{$lastName}', '{$email}', '{$hashedPassword}', '{$fileName}', '{$status}')";
             
                           if(mysqli_query($connection, $query)) {
                              $query =  "SELECT * FROM users WHERE email = '{$email}'";
                              $result = mysqli_query($connection, $query);
                              if(mysqli_num_rows($result) > 0 ) {
                                  $user = mysqli_fetch_assoc($result);
                                  $_SESSION['unique_id'] = $user['unique_id'];
                                  echo 'success';
                              }
                              
                              
                           }else {
                               echo 'There was an error in creating you account';
                           }
                    }     
                   }
                }
            }
         }
      }  
}


function uploadUserImage($file) {
    $fileSize = $file['size'];
    $temporaryName = $file['tmp_name'];
    $fileName = $file['name'];
    $fileError = $file['error'];
    $fileExt = strtolower(explode('.', $fileName)[1]);
    $allowedExts = array('jpg', 'png', 'jpeg');
    $newFileName = '';

   if(!in_array($fileExt,$allowedExts)){
         echo 'File not allowed! Upload jpg, jpeg or png';
   }else {
    if($fileError != 0) {
        echo 'Sorry an error occured! Please try again';
        }else {
            if($fileSize > 500000){
                echo 'Your file is to big';
          }else {
            $newFileName = uniqid('', true) . "." . $fileExt;

            if(!move_uploaded_file($temporaryName, '../uploads/'.$newFileName)) {
                  return false;
            }
          }
        }
   }

   return $newFileName;

}
