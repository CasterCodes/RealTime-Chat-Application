  <?php 
       include_once 'includes/header.php';
       if(isset($_SESSION['unique_id'])){
           header('Location: users.php');
       }
  ?>
  <body>
    <div class="wrapper">
      <section class="form signup">
        <header>Messager App</header>
        <form action=""  enctype="multipart/form-data">
          <div class="error-text">This is an error message</div>
          <div class="name-details">
            <div class="field">
              <label for="">First Name</label>
              <input type="text"  id='first-name' placeholder="First Name" />
            </div>
            <div class="field">
              <label for="">Last Name</label>
              <input type="text" placeholder="Last Name" id='last-name' />
            </div>
          </div>
          <div class="field">
            <label for="">Email</label>
            <input type="text" placeholder="Email"  id='email'/>
          </div>
          <div class="field">
            <label for="">Password</label>
            <input
              type="password"
              placeholder="Your password"
              class="password"
              id='password'
            />
            <i class="fas fa-eye pass-icon"></i>
          </div>
          <div class="field">
            <label for="">Confirm Password</label>
            <input
              type="password"
              placeholder="Confirm your password"
              class="confirm-password"
              id='confirm-password'
            />
            <i class="fas fa-eye confirm-pass-icon"></i>
          </div>
          <div class="image">
            <label for="">Choose file</label>
            <input type="file"  id='photo'/>
          </div>
          <div class="button">
            <input type="submit" value="Continue to Chat" id='submit' />
          </div>
        </form>
        <div class="link">
          Already signed up ? <a href="login.php">Login now</a>
        </div>
      </section>
    </div>
    <script src="./js/password.js"></script>
    <script src="./js/register.js"></script>
  </body>
</html>
