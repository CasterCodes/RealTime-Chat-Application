<?php 
      
       include_once 'includes/header.php';
  ?>
  <body>
    <div class="wrapper">
      <section class="form login">
        <header>Messager App</header>
        <form action="">
          <div class="error-text">This is an error message</div>

          <div class="field">
            <label for="">Email</label>
            <input type="text" placeholder="Email" id='email' />
          </div>
          <div class="field">
            <label for="">Password</label>
            <input
              type="password"
              class="password"
              placeholder="Enter your password"
              id='password'
            />
            <i class="fas fa-eye pass-icon"></i>
          </div>

          <div class="button">
            <input type="submit" value="Continue to Chat" id='submit'/>
          </div>
        </form>
        <div class="link">
          Not yet signed up ? <a href="index.php">Register now</a>
        </div>
      </section>
    </div>
    <script src="./js/password.js"></script>
     <script src="./js/login.js"></script>
  </body>
</html>
