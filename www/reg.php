<?php

  include 'includes/db.php';

  include 'includes/functions.php';

  

 
  $errors= [];

 if (array_key_exists('register', $_POST)) {
  # cache errors
  


  # validate first name
  if (empty($_POST['fname'])) {
    $errors['fname'] = "please enter a first name";
  }
  # validate last name
  if (empty($_POST['lname'])) {
    $errors['lname'] = "please enter a last name";
  }
  # validate email address
  if (empty($_POST['email'])) {
    $errors['email'] = "please enter an email address";

  }
  



  # validate password
  if (empty($_POST['password'])) {
    $errors['password'] = "please enter a password";

  }
  # confirm password
  if ($_POST['pword'] != $_POST['password']) {
    $errors['pword'] = "passwords do not match";

  }

 
 if (empty($errors)) {
  // do database stuff

  # eliminate unwanted spaces from values in the $_POST array
  $clean = array_map('trim', $_POST);

  
  doUserRegister($conn, $clean);
  
  

     } 

  
}










?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style/styles.css">
    <title>Registration</title>
</head>
<body id="registration">
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
            <p>0</p>
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
    <div class="registration-form">
      <form id="register" class="def-modal-form" action="reg.php" method="POST">
        <div class="cancel-icon close-form"></div>
        <label for="registration-from" class="header"><h3>User Registration</h3></label>

        <input type="text" name="fname" class="text-field first-name" placeholder="Firstname">

        <input type="text" name="lname" class="text-field last-name" placeholder="Lastname">

        <input type="email" name="email" class="text-field email" placeholder="Email">

        <input type="text" name="username" class="text-field username" placeholder="Username">

        <input type="password" name="password" class="text-field password" placeholder="Password">

        <input type="password" name="pword" class="text-field confirm-password" placeholder="Confirm Password">

        <input type="submit" name="register" class="def-button" value="Register">
        <p class="login-option">Have an account already? Login</p>
      </form>
    </div>
  </div>
  <!-- footer starts here-->
  <div class="footer">
    <p class="copyright">&copy; copyright 2017</p>
  </div>
</body>
</html>
