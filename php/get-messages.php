<?php
    session_start();
   if(isset($_SESSION['unique_id'])) {
    include_once 'config.php';
     $outgoing = mysqli_real_escape_string($connection, $_POST['outgoing']);
     $incoming = mysqli_real_escape_string($connection, $_POST['incoming']);
     $output = '';

     $query = "SELECT * FROM messages WHERE (outgoing_Id = '{$outgoing}' AND incoming_id = '{$incoming}') 
               OR  (outgoing_Id = '{$incoming}' AND incoming_id = '{$outgoing}') ORDER BY id";
     $sql = mysqli_query($connection, $query);

     $rowCount = mysqli_num_rows($sql);

     if($rowCount > 0 ) {
             while($message = mysqli_fetch_assoc($sql)) {
                    if($message['outgoing_Id'] === $outgoing){
                      $output .= ' <div class="chat outgoing">
                                    <div class="details">
                                        <p>
                                            '. $message['message'].'
                                        </p>
                                    </div>
                                    </div>';
                    }else {
                        $output .= ' <div class="chat incoming">
                                        <div class="details">
                                        <p>
                                        '. $message['message'].'
                                        </p>
                                        </div>
                                        </div>';
                    }
             }
     }
     echo $output;
   }
 ?>