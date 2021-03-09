<?php
session_start();
include_once 'config.php';
  $searchTerm = mysqli_real_escape_string($connection, $_POST['search']);

  $query = "SELECT * FROM users WHERE NOT unique_id = {$_SESSION['unique_id']} AND (first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%')";

  $sql = mysqli_query($connection, $query);

  $rowCount = mysqli_num_rows($sql);
  $output = '';

  if($rowCount > 0){
    while($row = mysqli_fetch_assoc($sql)) {
         
      $query = "SELECT * FROM messages WHERE (incoming_id = {$row['unique_id']} OR outgoing_Id ={$row['unique_id']}) AND  
      (outgoing_Id = {$_SESSION['unique_id']} OR incoming_id = {$_SESSION['unique_id']}) ORDER BY id LIMIT 1";

      $sql = mysqli_query($connection, $query);

      $rowCount = mysqli_num_rows($sql);

      $message = mysqli_fetch_assoc($sql);

      if($rowCount > 0) {
          $result = $message['message'];
      }else {
           $result = 'No message available';
      }
     (strlen($result) > 28) ? $lastMessage = substr($result, 0, 28) . "...": $lastMessage = $result;

     ($_SESSION['unique_id'] === $row['unique_id']) ? $you = 'You' :$you = '';

        $output .= ' <a href="chat.php?user='.$row['unique_id'].'">
        <div class="content">
          <img src="./uploads/'.$row['image'].'" alt="" />
          <div class="details">
            <span>'. $row["first_name"]. " " . $row['last_name'] .' </span>
            <p <p>'. $you ."  ". $lastMessage.'</p>
          </div>
        </div>
        <div class="status-dot"><i class="fas fa-circle"></i></div>
      </a>';
 }
  }else {
       $output .= 'No user with your search term sorry';
  }

  echo $output;

?>