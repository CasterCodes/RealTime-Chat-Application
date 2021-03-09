<?php 
       
       include_once 'includes/header.php';
       include_once 'php/config.php';
       if(!isset($_SESSION['unique_id'] )) {
         header('Location:login.php');
       }
  ?>
  <body>
    <div class="wrapper">
      <section class="chat-area">
        <header>
        <?php 

            $userId = '';
            if(isset($_GET['user'])) {
              $userId = mysqli_real_escape_string($connection, $_GET['user']);   
            }else {
                 header('Location:users.php');
            }
            $query = "SELECT * FROM users WHERE unique_id = '{$userId}'";
            $result = mysqli_query($connection, $query);
            if(mysqli_num_rows($result) > 0){
              $user = mysqli_fetch_assoc($result);
          }
           
        ?>
          <a href="users.php" class="back-icon"
            ><i class="fas fa-arrow-left"></i
          ></a>
          <img src="./uploads/<?php echo $user['image'];?>"  alt="<?php echo $user['image'];?>"/>
          <div class="details">
          <span><?php echo $user['first_name'] . ' ' .$user['last_name']; ?></span>
          <p><?php echo $user['status']; ?></p>
          </div>
        </header>
        <div class="chat-box">
          
         
        </div>
        <form action="" class="typing-area">
          <input type="hidden" name="" id='outgoing' value="<?php echo $_SESSION['unique_id'];?>">
          <input type="hidden" name="" id='incoming' value="<?php echo $userId;?>">
          <input type="text" placeholder="Type your message here"  id="message"/>
          <button id="send_btn"><i class="fab fa-telegram-plane"></i></button>
        </form>
      </section>
    </div>
    <script src="./js/sendChat.js"></script>
  </body>
</html>
