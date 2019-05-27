<?php
//delete lists
function delete_lists(){
         global $connection;
    if(isset($_GET['delete'])){
         $delete_list = $_GET['delete'];
         $query= "DELETE FROM tasks WHERE tasks_id = $delete_list ";
         $delete_res = mysqli_query($connection, $query);
         echo "<script type='text/javascript'>alert('Primary List Deleted');
                window.location='show_task.php';
               </script>";
         if(!$delete_res){
            die("Failed query" . mysqli_error($connection));
         }
        return true;
  }
      else {
          return false;
        }
}
//add lists
function add_lists(){
         global $connection;
    if(isset($_POST['add_tasks'])){
         $user_id = $_SESSION["user_id"];
         $lists_name = $_POST['tasks_name'];
        if (!preg_match('/^[a-zA-Z0-9]+$/', $lists_name)) {
           echo('Name can only contain letters, numbers');
          }
   else {
         $query  = "INSERT INTO tasks (user_id, tasks_name) ";
         $query .= "VALUES ('".$_SESSION["user_id"]."', '".$lists_name."') ";
         $create_lists_query = mysqli_query($connection, $query);
          if(!$create_lists_query){
              die("Query Failed".mysqli_error($connection));
            }
          echo '<script language="javascript">';
          echo 'alert("List Created")';
          echo '</script>';
        }
    }
}
//update lists
function update_lists(){
         global $connection;
  if(isset($_POST['update'])){
         $lists_name = $_POST['edit_tasks'];
    if (!preg_match('/^[a-zA-Z0-9]+$/', $lists_name)) {
           echo('Name can only contain letters, numbers');
          }
    else{
         $query = "UPDATE tasks SET tasks_name = '{$lists_name}' WHERE tasks_id = '".$_GET['edit']."' ";
         $update_lists_query = mysqli_query($connection, $query);
     if(!$update_lists_query){
              die("Query Failed".mysqli_error($connection));
            }
             echo '<script language="javascript">';
             echo 'alert("List Updated")';
             echo '</script>';
        }
    }
}

//add list
function add_list(){
         global $connection;
    if(isset($_POST['add_list'])){
         $user_id = $_SESSION['user_id'];
         $list_name = $_POST['task_name'];
         $list_description = $_POST['description'];
         $lists_id = $_POST['lists_id'];
          if (!preg_match('/^[a-zA-Z0-9]+$/', $list_name) || !preg_match('/^[a-zA-Z0-9]+$/', $list_description)){
              echo('Name and Description can only contain letters, numbers');
          }  
        else {
              $query = "INSERT INTO task (tasks_id, user_id, task_title, task_content, is_completed) ";
              $query.= "VALUES('".$lists_id."', '".$_SESSION['user_id']."', '".$list_name."', '".$list_description."', 'no') ";
              $list_res = mysqli_query($connection, $query);
            if(!$list_res){
                  die("Failed" . mysqli_error($connection));
                }
                echo '<script language="javascript">';
                echo 'alert("List Created")';
                echo '</script>';
          }
     }
}
//update list
function update_list(){
         global $connection;
    if(isset($_POST['edit_list'])){
         $list_name = $_POST['task_name'];
         $list_description = $_POST['description'];         
      if (!preg_match('/^[a-zA-Z0-9]+$/', $list_name) || !preg_match('/^[a-zA-Z0-9]+$/', $list_description)){
           echo('Name and Description can only contain letters, numbers');
          }  
       else {
             $query = "UPDATE task SET task_title = '{$list_name}', task_content = '{$list_description}'  WHERE task_id = '".$_GET['edit']."' ";
             $edit_list_query = mysqli_query($connection, $query);
            if(!$edit_list_query){
              die("Query Failed".mysqli_error($connection));
             }
              echo '<script language="javascript">';
              echo 'alert("List Updated")';
              echo '</script>';
            }         
      }
}
//delete list
function delete_list(){
         global $connection;
      if(isset($_GET['delete'])){
         $delete_list = $_GET['delete'];
         $delete_list_query = "DELETE FROM task WHERE task_id = $delete_list ";
         $delete_res = mysqli_query($connection, $delete_list_query);
         echo "<script type='text/javascript'>alert('List Deleted');
                window.location='show_task.php';
               </script>";
          if(!$delete_res){
              die("Failed" . mysqli_error($connection));
            }
             return true;
     }
         else {
            return false;
          }
}

//complete lists function
function complete_lists(){
         global $connection;
    if(isset($_GET['complete'])){
         $complete = $_GET['complete'];
         $com_query = "UPDATE task SET is_completed = 'yes' WHERE task_id = '".$complete."' ";
         $com_res = mysqli_query($connection, $com_query);
          echo "<script type='text/javascript'>alert('List Completed');
                window.location='uncompleted.php';
                </script>";
        if(!$com_res){
            die("Failed " . mysqli_error($connection));
        }
           return true;
   }
    else {
          return false;
        }
}
//incompleted lists function
function incomplete_lists(){
         global $connection;
    if(isset($_GET['incomplete'])){
         $incomplete = $_GET['incomplete'];
         $incom_query = "UPDATE task SET is_completed = 'no' WHERE task_id = '".$incomplete."' ";
         $incom_res = mysqli_query($connection, $incom_query);
         echo "<script type='text/javascript'>alert('List Incompleted');
                window.location='completed.php';
               </script>";
       if(!$incom_res){
            die("Failed" . mysqli_error($connection));
        }
         return true;
    }
    else {
         return false;
       }
} 
?>