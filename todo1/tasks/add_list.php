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
			    <?php add_list(); ?>
				 <fieldset>
				   <legend>ADD LIST</legend>				
				    <div class="form-group">
					    <label for="name">NAME</label>
					    <input type="text" name="task_name" placeholder="List Title" class="form-control" />
					</div>
                    <div class="form-group">
					    <label for="description">Description</label>
					    <input type="text" name="description" placeholder="List Content" class="form-control" />
					</div>
                    <div class="form-group">
                      <label for="tasks">Lists: </label>
                        <select name="lists_id" id="lists_id">
                            <?php 
                                $query = "SELECT * FROM tasks WHERE user_id = '".$_SESSION['user_id']."' ";
                                $select_lists = mysqli_query($connection, $query);
                                if(!$select_lists){
                                    die("Failed" . mysqli_error($connection));
                                }
                                $count = mysqli_num_rows($select_lists);
                                if($count == 0){
                                echo "<script type='text/javascript'>alert('You should add priority list');
                                              window.location='add_task.php';
                                      </script>";
                                        }
                                else {
                                        while($row = mysqli_fetch_assoc($select_lists)){
                                            $tasks_id = $row['tasks_id']; 
                                            $tasks_name = $row['tasks_name'];
                                            echo "<option value='{$tasks_id}'>{$tasks_name}</option>";
                                         }
                                       }
                                    ?>   
                        </select>    
                     </div>		
				     <div class="form-group">
						<input  type="submit" name="add_list" value="ADD" class="btn btn-primary" />
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