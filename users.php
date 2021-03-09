<?php 
      
       include_once 'includes/header.php';
       include_once 'php/config.php';
       if(!isset($_SESSION['unique_id'] )) {
         header('Location:login.php');
       }
  ?>
  <body>
    <div class="wrapper">
      <section class="users">
        <header>
           <?php 
           
            $query = "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'";
            $result = mysqli_query($connection, $query);
            if(mysqli_num_rows($result) > 0){
              $user = mysqli_fetch_assoc($result);
          }
           
           ?>
          <div class="content">
            <img src="./uploads/<?php echo $user['image'];?>"  alt="<?php echo $user['image'];?>"/>
            <div class="details">
              <span><?php echo $user['first_name'] . ' ' .$user['last_name']; ?></span>
              <p><?php echo $user['status']; ?></p>
            </div>
          </div>
          <a href="php/logout.php?user=<?php echo $user['unique_id'];?>" class="logout">Logout</a>
        </header> 
        <div class="search">
          <span class="text">Select any user to start chating</span>
          <input type="text" placeholder="Enter name to search..." />
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
        </div>
      </section>
    </div>
    <script src="./js/users.js"></script>
  </body>
</html>
