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
   <?php validate_user_registration() ?>
   <?php display_message(); ?>
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
        <label for="name"><b>Your Name</b></label>
        <input type="text" placeholder="Enter  Name" name="firstname" required>
        <label for="lastname"><b>Your Lastname</b></label>
        <input type="text" placeholder="Enter Lastname" name="lastname" required>
        <label for="username"><b>Your Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Confirm Password" name="conf_password" required>
    <hr>
    <button type="submit" name="signup" class="registerbtn">Register</button>
</div>
<div class="container signin">
    <p>Already have an account? <a href="login.php">Log in</a>.</p>
</div>
</form>
</body>
</html>