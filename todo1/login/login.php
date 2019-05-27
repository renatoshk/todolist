<?php include("init.php") ?>
<?php
if(isset($_SESSION['user_id'])){
  header("Location:../tasks/show_task.php");
} 
 ?>
<!DOCTYPE html>
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="style.css" rel="stylesheet">
</head>
<body>
<form action="" method="post">
<div class="container">
   <?php display_message(); ?>
   <?php validate_user_login(); ?>
   <?php logged_in()  ?>
    <h1>Log In</h1>
   <hr>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
   <hr>
    <button type="submit" name="login" class="registerbtn">Log In</button>
</div>
<div class="container signin">
    <p>Don't have an account? <a href="register.php">Sign Up</a>.</p>
</div>
</form>
</body>
</html>