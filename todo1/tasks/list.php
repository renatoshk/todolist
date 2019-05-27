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
 <h1>LISTS</h1>    
<table class="table" id="tablelist">
    <thead>
        <tr>
           <th>Name</th><th>DESCRIPTION</th>
        </tr>
    </thead>
<tbody>
    <?php
      if(isset($_SESSION['user_id'])){
        if(isset($_GET['list'])){
               $list = $_GET['list'];
               $list_query = "SELECT * FROM task WHERE user_id = '".$_SESSION['user_id']."' AND tasks_id = $list ORDER BY position ";
               $list_res = mysqli_query($connection, $list_query);
           if(!$list_res){
               die("Failed" . mysqli_error($connection));
             }
              $count = mysqli_num_rows($list_res);
           if($count == 0){
              echo "<script type='text/javascript'>alert('No list here');
                      window.location='show_task.php';
                    </script>";
                 }
            else {
                  while($row = mysqli_fetch_assoc($list_res)){
                        $list_id = $row['task_id'];
                        $list_name = $row['task_title'];
                        $list_content = $row['task_content'];
     ?> 
        <div class="form-group">
                <tr id="<?php echo $list_id; ?>">
                    <td><?php echo $list_name; ?></td>
                    <td><?php echo $list_content; ?></td>
                    <td><a href="edit_list.php?edit=<?php echo $list_id ?>"><input type="submit" style="float:right;" name="edit list " value="EDIT LIST" class="btn btn-primary"/></a></td>
                    <td><a href="list.php?delete=<?php echo $list_id ?>"><input type="submit" style="float:right;" name="delete list " value="DELETE LIST" class="btn btn-primary"/></a></td>
                    <input type="hidden" value="<?php echo $list_id; ?>" id="item" name="item">
                </tr>
          </div>
<?php }}}} ?>
<?php delete_list() ?> 
<?php delete_lists() ?>
 </tbody>
</table>
<script>
  var $sortable = $( "#tablelist > tbody" );
      $sortable.sortable({
      stop: function ( event, ui ) {
          var parameters = $sortable.sortable( "toArray" );
          $.post("task_list.php",{value:parameters},function(result){
              alert(result);
          });
      }
  });
</script>
</body>
</html>