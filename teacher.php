<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include("connector.php");
?>
<html>
    <head>
        <title>schoolGMail</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	 <title>Hawa</title>
	 <script type="text/javascript" src="js/jquery-1.9.0.js"></script>
	 <script type="text/javascript" src="js/bootstrap.min.js"></script>


		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #ff2'});	
			Cufon.replace('h4',{ textShadow: '1px 1px #ed2'});		 
		</script>		 
    </head>
    <body>
    	<center><h1>SchoolGMail</h1></center>
    	<?php
    	if (isset($_SESSION['save'])) {
    		# code...
    		echo $_SESSION['save'];
    	}




    	?>
    	<div class = "row">
    		<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
    			<div id="accordion" class="panel-group">
				<div class="panel panel-success">					 
					<div class="panel-collapse collapse in" id="one">
						<div class="panel-body">
	<nav class="navbar-pills navbar-stacked">	 	 
		 <ul class="nav">
	 <li class = "active"><a href="sms.php">Send Message</a></li> 
		 <li class = "dropdown ">				
			  <a class="dropdown-toggle" 
			  data-toggle="dropdown" href="#"> 
			  	Settings <span class="caret"></span>
			  </a>
			   <ul class = "dropdown-menu">
 <li class="active"><a href="#myModalstudent"  data-toggle="modal">Register Student</a></li> 
<li class="active"><a href="#myModal"  data-toggle="modal">Upload profile picture</a></li> 
<li li class="active"><a href="#load_classes"data-toggle="modal">Register classes</a>
<li li class="active"><a href="#view_classes"data-toggle="modal">View Registered classes</a>
</li>
<li li class="active"><a href="#">Conact the developer</a></li>
			    </ul>
			</li>
		</ul>
	 
</nav>
 
 <?php
		if (isset($_SESSION["name"])) {
	 		$name = $_SESSION["name"];
	 		$image = mysqli_query($connection,"SELECT PHOTO FROM register_teacher 
	 			WHERE USERNAME = '$name'");
	 		if ($image) {
	 			while ($counter=mysqli_fetch_assoc($image)) {
	 				# code...
	 				$photo = $counter['PHOTO'];
	 				echo "<img src = 'images/$photo' width = '100%'>";
	 			}
	 			# code...
	 		}
			    echo "Loged in as $name <a href = 'logout.php'>Logout</a>";		 
			
		}
?>
 						</div>
					</div>
				</div>
			</div>

    		</div>
    		<div class = "col-lg-9 col-md-9 col-sm-12 col-xs-12">
    			
    	 <div id="accordionx" class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#onex" data-toggle="collapse" data-parent="#accordionx"><h4><center>Students Registered</center></h4></a>
						</div>
					</div>
					<div class="panel-collapse collapse in" id="onex">
						<div class="panel-body">

							 <?php
    				  $select = mysqli_query($connection,"SELECT ID,CLASS_NAME FROM 
    				 	claseses");
    				 if ($select) {
    				 	if (mysqli_num_rows($select)>0) {
    				 		while ($counter = mysqli_fetch_array($select)) {
    				 			$classses = $counter['CLASS_NAME'];
    				 			$id = $counter['ID'];?>
    		 <div id="accordion<?php echo $id?>" class="panel-group">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#one<?php echo $id?>" data-toggle="collapse" data-parent="#accordio<?php echo $id?>"><?php echo $classses?></a>
						</div>
					</div>
					<div class="panel-collapse collapse in" id="one<?php echo $id?>">
						<div class="panel-body">
							<table class = "table">
							<tr class = "danger"><th>Student Name</th><th>Parent Name</th><th>Student Number<th></tr>			
							<?php
							$selection = mysqli_query($connection,"SELECT * FROM students WHERE CLASS_NAME = '$classses'");
							if ($selection) {
								if (mysqli_num_rows($selection) > 0) {
									while ($row = mysqli_fetch_array($selection)) {
										$s_name = $row['STUDENT_NAME'];
										$s_num = $row['STUDENT_NNUMBER'];
										// get parent namwe
										$parent_selet = mysqli_query($connection, "SELECT ACTIVATION_KEY,PARENT_NAME FROM 
											parent WHERE STUDENT_NNUMBER = '$s_num'");
										if ($parent_selet) {
											while ($v = mysqli_fetch_array($parent_selet)) {
												$PARENT_NAME = $v['PARENT_NAME'];
												$ACTIVATION_KEY = $v['ACTIVATION_KEY'];

												# code...
											}
											# code...
										}
										echo "<tr><td>$s_name</td><td>$PARENT_NAME(key: $ACTIVATION_KEY)</td><td>$s_num</td></tr>";
										# code...
									}
									# code...
								}
								else{
									echo "No student registered in this class yet!!";
								}
								# code...
							}

							?>
								</table>
							 
						</div>
					</div>
				</div>
			</div>



    				 <?php
    				 		}
    				 		# code...
    				 	}
    				 	else{
    				 		echo "No classes Registered yet!!";
    				 	}
    				 	# code...
    				 }   				 

    				 ?>

						 
						</div>
					</div>
				</div>
			</div>







    		</div>
    	</div>






 			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">						 
						<div class="modal-body">
	 <div class = "row">
    		<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
    		</div>
    		<div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12 alert alert-warning">
    				<form class = "form" method = "POST" enctype = "multipart/form-data" >
					         <input type = "file" name = "teachers_pictue">
								<br>
								<input value = "Upload" type = "submit" class = "btn btn-primary btn-block">
							</form>	
    		      </div>
    		<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
    		</div>
    	</div>


 						</div>						 
					</div>
				</div>
			</div>


			<div id="load_classes" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">					 
						<div class="modal-body">

	 <div class = "row">
    		<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
    		</div>
    		<div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12 alert alert-warning">
    				<center class = 'alert-index alert-danger'>Load classes</center>
    				<form class = "form" method = "POST">
					        <p>Enter class</p>
					         <input type = "text" placeholder = "e.g Form 1" class = "form-control" name = "class_name">
								<br>
								<input value = "Save" type = "submit" class = "btn btn-primary btn-block">
					</form>	
    		      </div>
    		<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
    		</div>
    	</div>




 						</div>					 
					</div>
				</div>
			</div>

			<div id="view_classes" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">					 
						<div class="modal-body">

	 <div class = "row">
    		<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
    		</div>
    		<div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12 alert alert-warning">
    				<center class = 'alert-index alert-danger'>Registered classes</center>
    				 <?php
    				 echo "<table class = 'table'>
    				 			<tr><th>Class name</th><th>Option</th></tr>";
    				 $select = mysqli_query($connection,"SELECT ID,CLASS_NAME FROM 
    				 	claseses");
    				 if ($select) {
    				 	if (mysqli_num_rows($select)>0) {
    				 		while ($counter = mysqli_fetch_array($select)) {
    				 			$classses = $counter['CLASS_NAME'];
    				 			$id = $counter['ID'];
    				 			echo "
    				 			<tr><td>$classses</td><td>
    				 			<form method = 'POST'>
    				 			<input type = 'submit'name = 'del' class = 'btn btn-link' value = '$id'>delete
    				 			</form>
    				 			";

    				 			if (isset($_POST['del'])) {
    				 				$the_id = $_POST['del'];
    				 				$del = mysqli_query($connection,"DELETE FROM claseses WHERE ID = '$the_id'");
    				 				# code...
    				 			}
    				 		 

    				 			# code...
    				 		}
    				 		# code...
    				 	}
    				 	else{
    				 		echo "No classes Registered yet!!";
    				 	}
    				 	# code...
    				 }
    				 echo "</td></tr>
    				 			</table>";

    				 ?>
    		      </div>
    		<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
    		</div>
    	</div>




 						</div>					 
					</div>
				</div>
			</div>



			<!-- registering student -->
		 <div id="myModalstudent" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">					 
						<div class="modal-body">
							<div class = "row">
								<div class = "col-lg-2 col-md-2 col-sm-12 col-xs-12">
								</div>
								<div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 alert alert-warning">
						 <h1><center>REGISTER STUDENT</center></h1>

						 <form method = "POST" action = "student_register.php">
							<p class = "text-info">Student name:</p>
							<input class = "form-control" required  type = "text" name = "name_of_student">	<p

							 class = "text-info">parent name:</p>
							<input class = "form-control" required  type = "text" name = "parent_of_student">						 

							<p class = "text-info">Class</p>
							<select name = "class_name" class = "form-control">
								<option></option>
								<?php
							 $select = mysqli_query($connection,"SELECT ID,CLASS_NAME FROM claseses");
				    				 if ($select) {
				    				 	if (mysqli_num_rows($select)>0) {
				    				 		while ($counter = mysqli_fetch_array($select)) {
				    				 			$classses = $counter['CLASS_NAME'];
				    				 			echo "<option>$classses</option>";
				    				 		}
				    				 	}
				    				 }

							?>


							</select>						  							 
						    <br><input type = "submit" value = "Register" class = "btn btn-primary btn-block">
						<p class = "text-danger">
							 			
						</p>
				</form> 
			</div>
			<div class = "col-lg-2 col-md-2 col-sm-12 col-xs-12">
				
			</div>
		</div>
		</div>
	</div>
</div>
</div>






				<?php
							 
 							
							if (isset($_FILES['teachers_pictue'])) {
							$pictures_name = $_FILES['teachers_pictue']['name'];
								$extension_image = pathinfo($pictures_name , PATHINFO_EXTENSION);	
								 					# code...
								if (
									($extension_image == 'flv')  || ($extension_image == 'FLV')  ||
									($extension_image == 'png')  || ($extension_image == 'PNG')  ||
									($extension_image == 'jpeg') ||	($extension_image == 'JPEG') ||
									($extension_image == 'gif')  ||	($extension_image == 'ico')  ||	
									($extension_image == 'ICO')  ||	($extension_image == 'jpg')  ||	
									($extension_image == 'JPG')  ||	($extension_image == 'tif')  ||	
									($extension_image == 'TIF')  ||	($extension_image == 'swf')  ||	
									($extension_image == 'SWF')  ||	($extension_image == 'bmp')  ||	
									($extension_image == 'BMP')  ||	($extension_image == 'dts')  || 
									($extension_image == 'DTS')  ||	($extension_image == 'gif')	 ||
									($extension_image == 'GIF')	
									){
						 		
								$tym = time();
								 
								 $teacher_upload = "$name$tym.$extension_image";
								 
								 move_uploaded_file($_FILES['teachers_pictue']['tmp_name'], "images/$teacher_upload ");
								 mysqli_query($connection, "UPDATE register_teacher SET PHOTO = '$teacher_upload' 
								 	WHERE USERNAME = '$name'");
							 }								 
								else{
									echo "<i class = 'text-danger'>Please Only image suppoted.</i>";
								}
								

							}



							// save clases
							if (!empty($_POST['class_name'])) {
								mysqli_query($connection,"CREATE TABLE CLASESES(ID 
									INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID), 
									CLASS_NAME VARCHAR(255) NOT NULL UNIQUE)");
								$class = mysqli_real_escape_string($connection,$_POST['class_name']);
								$save = mysqli_query($connection,"INSERT INTO CLASESES(CLASS_NAME)
									VALUES('$class')");


								# code...
							}

							?>


    </body>
</html>