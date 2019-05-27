<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>TODO</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
 <h1>ALL COMPLETED LISTS</h1>    
<table class="table" id="tablelist">
    <thead>
        <tr>
            <th>Name</th><th>DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
<?php
      if(isset($_SESSION['user_id'])){
             $user_id = $_SESSION['user_id'];
             $un_query = "SELECT * FROM task WHERE user_id = '".$user_id."' AND is_completed = 'yes' ";
             $un_res = mysqli_query($connection, $un_query);
        if(!$un_res){
            die("Failed Again Man" . mysqli_error($connection));
        }
        $count = mysqli_num_rows($un_res);
        if($count == 0){
            echo "<script type='text/javascript'>
                  alert('No completed list here');
                  window.location='show_task.php';
                  </script>";
        }
        else{
              while($row = mysqli_fetch_assoc($un_res)){
                    $list_id = $row['task_id'];
                    $list_name = $row['task_title'];
                    $list_content = $row['task_content'];
 ?> 
        <div class="form-group">
                <tr id="<?php echo $list_id; ?>">
                  <td><?php echo $list_name; ?></td>
                  <td><?php echo $list_content; ?></td>
                <td> <a href="completed.php?incomplete=<?php echo $list_id ?>"><input type="submit" style="float:right;" name="incomplete" value="incomplete" class="btn btn-primary"/></a></td>
                <td><a href="list.php?delete=<?php echo $list_id ?>"><input type="submit" style="float:right;" name="delete list " value="DELETE LIST" class="btn btn-primary"/></a></td>
                <input type="hidden" value="<?php echo $list_id; ?>" id="item" name="item">
                </tr>
          </div>
<?php }}} ?>
 <?php incomplete_lists(); ?>
 <?php delete_list();      ?> 
</tbody>
</table>
</body>
</html>