<?php include "../login/init.php" ?>
<?php include "list_functions.php" ?>
<?php include "navbar.css"; ?>
<?php 
if(!isset($_SESSION['email'])){
   header("Location:../login/login.php");
}
?> 
<div class="topnav">
        <a  href="show_task.php">Home</a>
        <a  href="add_task.php">Add Lists</a>
        <a href="add_list.php">Add List</a>
        <div class="topnav-right">
        <a href="../login/logout.php">Log Out:  <?php echo $_SESSION['email'] ?></a>
        </div>
</div>