<?php include("navbar.php") ?> 
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
  <h1>TODO LISTS</h1>
<h3><a href="completed.php">The Complete Lists</a></h3>
  <br>OR
<h3><a href="uncompleted.php"><strong>The Incomplete Lists</strong></a></h3>
<table class="table" id="tablelist">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
      <?php
      if(isset($_SESSION['user_id'])){
        $query = "SELECT * FROM tasks WHERE user_id = '".$_SESSION['user_id']."' ORDER BY position";
        $result = mysqli_query($connection, $query);
      if(!$result){
          die("Failed". mysqli_error($connection));
            }
         $count = mysqli_num_rows($result);
         if($count == 0){
            echo "<script type='text/javascript'>alert('No primary lists here, add one!');
                     window.location='add_task.php';
                  </script>";
            }
         else {
            foreach ($result as $row) {
                ?>
          <div class="form-group">
           <?php delete_lists() ?> 
                <tr id="<?php echo $row["tasks_id"]; ?>">
                    <td><?php echo $row["tasks_name"]; ?></td>
                    <td><a href="list.php?list=<?php echo $row["tasks_id"]; ?>"><input type="submit" style="float:right;" name="view list " value="VIEW LIST" class="btn btn-primary" /></a></td>
                     <td><a href="edit_task.php?edit=<?php echo $row["tasks_id"]; ?>"><input type="submit" style="float:right;" name="edit list " value="EDIT LIST" class="btn btn-primary" /></a></td>
                     <td><a href="show_task.php?delete=<?php echo $row["tasks_id"]; ?>"><input type="submit" style="float:right;" name="delete list " value="DELETE LIST" class="btn btn-primary" /></a></td>
                     <input type="hidden" value="<?php echo $row["tasks_id"]; ?>" id="item" name="item">
                  </tr>
              </div>
          <?php }}} ?>
    </tbody>
</table>
<script>
  var $sortable = $( "#tablelist > tbody" );
  $sortable.sortable({
      stop: function ( event, ui ) {
          var parameters = $sortable.sortable( "toArray" );
          $.post("task.php",{value:parameters},function(result){
              alert(result);
          });
      }
  });
</script>
</body>
</html>