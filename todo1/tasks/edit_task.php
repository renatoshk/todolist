<?php include("navbar.php") ?>
<!DOCTYPE html>
<html>
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>ADD TASK</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body class="">
 <div class="container" style="min-height:500px;">
    <div class="container">	
	       <br><br>
	    <div class="row">
	        <div class="col-md-4 col-md-offset-4 well">			
		       <strong><a href="show_task.php">View Lists</a> </strong>
			  <form role="form" enctype='multipart/form-data' action="" method="post">
                 <?php  update_lists(); ?>
			         <?php
                       if(isset($_GET['edit'])){
                         $lists_id = $_GET['edit'];
                         $query = "SELECT * FROM tasks WHERE tasks_id = $lists_id ";
                         $select_res = mysqli_query($connection, $query);
                        if(!$select_res){
                            die("Failed Query" . mysqli_error($connection));
                          }
                      while($row = mysqli_fetch_assoc($select_res)){
                        $tasks_id = $row['tasks_id'];
                        $tasks_name = $row['tasks_name'];
                     ?>
				 <fieldset>
					 <legend>EDIT LISTS</legend>				
				     <div class="form-group">
						<label for="name">NAME</label>
						<input value = "<?php if(isset($tasks_name)){echo $tasks_name;}?>" type="text" name="edit_tasks" placeholder="List Title" class="form-control" />
				     </div>	
				     <div class="form-group">
						<input  type="submit" name="update" value="UPDATE" class="btn btn-primary" />
					 </div>
				 </fieldset>
				<?php }} ?>
			  </form>
           </div>
	    </div>	
         <br>
    </div>
</div>
</body>
</html>