<?php
  session_start();

  include 'includes/db.php';

  include 'includes/functions.php';

  if (array_key_exists('register', $_POST)) {
    # error caching
    $errors = [];
    

    if (empty('email')) {
      $errors['email'] = "please enter your email";
    }
    if (empty('password')) {
      $errors['password'] = "please enter your password";
    }

    if (empty($errors)) {
      # select from db

      #remove unwanted vakues from the array $_POST
      $clean = array_map('trim', $_POST);

      $chk = userLogin($conn, $clean);
          if($chk[0]){
            $_SESSION['id'] = $chk[1]['user_id'];
            $_SESSION['email'] = $chk[1]['email'];
            //print_r($_SESSION); exit();
            useredirect("index.php");
    } else{
       useredirect("log.php?msg=invalid email or password");
    }
  }
}








?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style/styles.css">
    <title>Login</title>
</head>
<body id="login">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->

  <!-- top bar starts here -->
  <div class="top-bar">
    <div class="top-nav">
      <a href="index.php"><h3 class="brand"><span>B</span>rain<span>F</span>ood</h3></a>
      <ul class="top-nav-list">
        <li class="top-nav-listItem Home"><a href="index.php">Home</a></li>
        <li class="top-nav-listItem catalogue"><a href="catalogue.php">Catalogue</a></li>
        <li class="top-nav-listItem login"><a href="log.php">Login</a></li>
        <li class="top-nav-listItem register"><a href="reg.php">Register</a></li>
        <li class="top-nav-listItem cart">
          <div class="cart-item-indicator">
            <p>12</p>
          </div>
          <a href="cart.php">Cart</a>
        </li>
      </ul>
      <form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>
    </div>
  </div>
  <!-- main content starts here -->
  <div class="main">
    <div class="login-form">
      <form class="def-modal-form" id="register" action="log.php" method="POST">
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Login</h3></label>
        
        <input type="text" name="email" class="text-field email" placeholder="Email">
        <p class="form-error"></p>
       
        <input type="password"  name="password" class="text-field password" placeholder="Password">
        <!--clear the error and use it later just to show you how it works -->
        <p class="form-error"></p>
        <input type="submit" name="register" class="def-button login" value="Login">
      </form>
    </div>
  </div>
  <!-- footer starts here-->
  <div class="footer">
    <p class="copyright">&copy; copyright 2017</p>
  </div>
</body>
</html>
