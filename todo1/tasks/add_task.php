<?php include("navbar.php") ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>ADD TASK</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="min-height:500px;">
  <div class="container">	
	    <br><br>
	  <div class="row">
	     <div class="col-md-4 col-md-offset-4 well">			
		    <strong><a href="show_task.php">View Lists</a> </strong>
			  <form role="form" enctype='multipart/form-data' action="" method="post">
			   <?php add_lists()?>
				 <fieldset>
					 <legend>ADD PRIMARY LISTS</legend>
				 <div class="form-group">
					<label for="name">NAME</label>
					<input type="text" name="tasks_name" placeholder="List Title" class="form-control" />
				 </div>
				 <div class="form-group">
					<input  type="submit" name="add_tasks" value="ADD" class="btn btn-primary" />
                 </div>
				 </fieldset>
			  </form>			
		    </div>
	     </div>	
         <br>
   </div>
</div>
</body>
</html>