<?php 
   $connection = mysqli_connect('localhost', 'root', '', 'chatone');

   if(!$connection) {
    echo "error" . mysqli_connect_error();
   }

?>
