<?php
session_start();
include_once 'config.php';
$outgoing_id  = $_SESSION['unique_id'];

$query = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id  }";

$sql2 = mysqli_query($connection, $query);

$rowCount = mysqli_num_rows($sql2);

$output = '';

if($rowCount === 0){
        $output .= 'There are currently no users to chat with !';
}elseif($rowCount > 0) {
   while($row = mysqli_fetch_assoc($sql2)) {
      
         $query = "SELECT * FROM messages WHERE (incoming_id = {$row['unique_id']} OR outgoing_Id ={$row['unique_id']}) AND  
         (outgoing_Id = {$outgoing_id} OR incoming_id = {$outgoing_id}) ORDER BY id DESC  LIMIT 1 ";

          $sql = mysqli_query($connection, $query);

          $message = mysqli_fetch_assoc($sql);

          if(mysqli_num_rows($sql) > 0){
              $result = $message['message'];
          }else{
              $result ="No message available";
          }

        (strlen($result) > 28) ? $lastMessage = substr($result, 0, 28) . "..." : $lastMessage = $result;
       
        ($row['status'] == "Offline") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="chat.php?user='. $row['unique_id'] .'">
        <div class="content">
      
        <div class="details">
            <span>'. $row['first_name']. " " . $row['last_name'] .'</span>
            <p>'. $lastMessage .'</p>
        </div>
        </div>
        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
    </a>';

         
   }

  
}

echo $output;






