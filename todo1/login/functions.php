<?php 
function escape($string){
	       global $connection;
	       return mysqli_real_escape_string($connection, $string);
}

function clean($string){
	       return htmlspecialchars($string);
}

function set_message($message){
      if(!empty($message)){
          $_SESSION['message'] = $message;
         }
   else {
         $message = "";
      }
}

function display_message(){
      if(isset($_SESSION['message'])){
		     echo $_SESSION['message'];
		     unset($_SESSION['message']);
    	}
}

function token_generator(){
	$token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
	         return $token;
}

function email_exists($email){
  	     global $connection;
         $query = "SELECT user_id FROM users WHERE email = '$email' ";
         $result = mysqli_query($connection, $query);
     if(!$result){
	       die("Failed" . mysqli_error($connection));
        }
        $count = mysqli_num_rows($result);
     if($count == 1){
	      return true;
       }
    else {
	      return false;
      }
}

function username_exists($username){
	       global $connection;
         $query = "SELECT user_id FROM users WHERE username = '$username' ";
         $result = mysqli_query($connection, $query);
     if(!$result){
         die("Failed" . mysqli_error($connection));
       }
         $count = mysqli_num_rows($result);
      if($count == 1){
	       return true;
        }
    else {
 	       return false;
        }
}

function send_email($email, $subject, $msg, $headers){
	       return mail($email, $subject, $msg, $headers);
}
//validate sign up
function validate_user_registration(){
	       global $connection;
	       $errors = [];
	       $min = 3;
	       $max = 30;
if($_SERVER['REQUEST_METHOD'] == "POST"){
		     $firstname = clean($_POST['firstname']);
		     $lastname = clean($_POST['lastname']);
		     $username = clean($_POST['username']);
		     $email = clean($_POST['email']);
		     $password = clean($_POST['password']);
		     $conf_password = clean($_POST['conf_password']);
  if(strlen($firstname) < $min){
			   $errors[] = "Firstname cannot be less than {$min} ";
		}
	if(strlen($firstname) > $max){
			   $errors[] = "Firstname cannot be more than {$max} ";
		}
  if(strlen($lastname) < $min){
			   $errors[] = "Lastname cannot be less than {$min} ";
		}
  if(strlen($lastname) > $max){
			   $errors[] = "Lastname cannot be more than {$max} ";
		}
  if (!preg_match('/^[a-zA-Z0-9]+$/', $firstname) || !preg_match('/^[a-zA-Z0-9]+$/', $lastname)){
          $errors[]="Firstame and Latname can only contain letters, numbers";
      }
        
  if(username_exists($username)){
        	$errors[] = "Sorry, username exists";
     } 
  if(strlen($username) < $min){
			    $errors[] = "username cannot be less than {$min} ";
		}
	if(strlen($username) > $max){
			    $errors[] = "username cannot be more than {$max} ";
		}
  if (!preg_match('/^[a-zA-Z0-9]+$/', $username)){
          $errors[]=" Username can only contain letters, numbers";
      }
  if(email_exists($email)){
        	$errors[] = "Sorry, email exists";
      }
  if(strlen($email) < $min){
			    $errors[] = "Email cannot be more than {$min} ";
		}
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Invalid Email';
     }
  if(empty($email)){
    $errors[] = "Your email field cannot be empty ";
   }   
	if(strlen($password) < 6){
			    $errors[] = "Password cannot be less than 6";
		}
  if(empty($password)){
    $errors[] = "Your password field cannot be empty ";
  } 
	if($password !== $conf_password){
			    $errors[] = "Your password fields are not the same";
		}
  if (preg_match("/\\s/", $email)) {
        $errors[] = "<script>alert('Your email field cannot have white spaces')</script>";
   }
  if (preg_match("/\\s/", $password)) {
        $errors[] = "Your password field cannot have white spaces ";
   }   
   if(!empty($errors)){
			 foreach ($errors as  $error) {
				  echo $error;
        }
		}
   else {
           register_user($firstname, $lastname, $username, $email, $password);
           set_message("<p>Please Check your email for activation link</p>");
         }
  }
}
//register user
function register_user($firstname, $lastname, $username, $email, $password){
         global $connection;
         $firstname = escape($firstname);
         $lastname = escape($lastname);
         $username = escape($username);
         $email = escape($email);
         $password = escape($password);
    if(email_exists($email)){
         return false;
        } 
     else if(username_exists($username)){
	       return false;
         }
  else {
         $password = md5($password);
         $validation_code = md5(uniqid(rand()));;
         $query = "INSERT INTO users(username, password, firstname, lastname, email, user_role, validation_code, active) ";
         $query .=" VALUES('$username', '$password', '$firstname', '$lastname', '$email', 'admin', '$validation_code', 0) ";
         $result = mysqli_query($connection, $query);
     if(!$result){
           die("Failed" . mysqli_error($connection));
         }
         $subject = "Activate Account";
         $msg = "Please click the link below to activate your Account
                http://localhost/todo1/login/active.php?email=$email&code=$validation_code";
         $headers = "FROM:noreply@renatoshkulaku.com";        
           send_email($email, $subject, $msg, $headers);
           return true;
      }
}
//activateuser
function activate_user(){
	        global $connection;
	    if($_SERVER['REQUEST_METHOD'] == "GET"){
		   if(isset($_GET['email'])){
			    $email = clean($_GET['email']);
			    $validation_code = clean($_GET['code']);
          $query = "SELECT user_id FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' ";
			    $result = mysqli_query($connection, $query);
			if(!$result){
			 	  die("Failed" . mysqli_error($connection));
			 }
			    $count = mysqli_num_rows($result);
			 if($count == 1 ){
                 $update_query = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."' ";
                 $update_result = mysqli_query($connection, $update_query);
             if(!$update_result){
                 die("Failed update query");
                }
         set_message("<p>Your account has been activated</p>");
			 	 header("Location:login.php");
			 }
        }
    }
}
//validation user function
function validate_user_login(){
	       global $connection;
	       $errors = [];
	       $min = 3;
	       $max = 30;
 if($_SERVER['REQUEST_METHOD'] == "POST"){
         $email = clean($_POST['email']);
         $password = clean($_POST['password']);
 if(empty($email)){
    	   $errors[] = "Email field cannot be empty";
    }
 if(empty($password)){
    	   $errors = "Password field cannot be empty";
    }
 if (preg_match("/\\s/", $email)) {
        $errors[] = "<script>alert('Your email field cannot have white spaces')</script>";
   }
  if (preg_match("/\\s/", $password)) {
        $errors[] = "Your password field cannot have white spaces ";
     } 
      else { 
            if(user_login($email, $password)){
            	       header("Location:../tasks/show_task.php");
                  }
            else {
            	echo "<script type='text/javascript'>alert('Check your email or password');
                     window.location='login.php';
                    </script>";;
              }
         }
    }
}


//login user function

function user_login($email, $password){
         global $connection;
	       $login_query = "SELECT password, user_id FROM users WHERE email = '".escape($email)."' AND active = 1 ";
	       $login_result = mysqli_query($connection, $login_query);
	   if(!$login_result){
		     die("Login query Failed");
	     }
	       $count_users = mysqli_num_rows($login_result);
	    if($count_users == 1){
         $row = mysqli_fetch_assoc($login_result);
         $db_password = $row['password'];
       if(md5($password) === $db_password){
              $_SESSION["user_id"]=$row["user_id"];
              $_SESSION['email'] = $email;
              return true;
             }
    else {
      	return false;
      }
        return true;
	}
	else {
		return false;
	}
}

function logged_in(){
	if(!isset($_SESSION['email'])){
	    return false;
	}
	else {
       return true;
    }
}
?>