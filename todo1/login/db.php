<?php
$connection = mysqli_connect('localhost', 'root', '','todo');
if(!$connection){
	die("Failed" . mysqli_error($connection));
}
?>