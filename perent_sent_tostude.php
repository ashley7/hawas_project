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
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});			 
		</script>
		<style type="text/css">
		.pol{
			margin-left: 5%;
		}

		</style>
    </head>
    <body>
		 
			<h1><center>SchoolGMail</center></h1>
		
			

<div class = "row">
	<div class = "col-md-3 col-lg-3 col-sm-12 col-xs-12">
		<div id="accordion" class="panel-group">
				<div class="panel panel-info">					 
					<div class="panel-collapse collapse in" id="one">
						<div class="panel-body">
								
	 <nav class="navbar-pills navbar">	 	 
		 <ul class="nav">
	<li><a href="sponsor_parent.php">Back</a></li>
	 <li class = "active"><a href="sms_child.php">Send Message to child</a></li>
	 <li class = "active"><a href="sponsor_parent.php">Send Message</a></li> 
		 
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
	<div class = "col-md-9 col-lg-9 col-sm-12 col-xs-12">
		<center class = "alert-index alert-danger">Messages sent to student</center>
		<br>
		<div id="accordion" class="panel-group">
				<div class="panel panel-success">
					 
					<div class="panel-collapse collapse in" id="one">
						<div class="panel-body">
		<table class = "table table-hover">
				<tr class = "danger"><th>Recipient</th><th>subject</th><th>Options</th></tr>

		<?php
			$name = "";
			if (isset($_SESSION["name"])) {
	 		$name = $_SESSION["name"];
	 			}
	 			$get_poeple = mysqli_query($connection,
	 				"SELECT TEACHER_NAME FROM `register_teacher` WHERE USERNAME = '$name'");
	 			if ($get_poeple) {
	 				while ($r = mysqli_fetch_array($get_poeple)) {
	 					# code...
	 					$STUDENT_NNUMBERc = $r['TEACHER_NAME'];//this is the student number
	 				
	 			 	$selection = mysqli_query($connection,"SELECT * FROM schoolchild 
						WHERE SENDER = '$name' AND RECIVER = '$STUDENT_NNUMBERc'
						 ORDER BY GMail_ID DESC LIMIT 1");			

					if ($selection) {
						while ($group = mysqli_fetch_assoc($selection)) {
							$RECIVER = $group['RECIVER'];
							$GMail_ID = $group['GMail_ID'];
							$subject = $group['MESSAGE_SUBJECT'];
							$RECIVER = $group['RECIVER'];
							$SENDER = $group['SENDER'];
							$MESSAGE = $group['MESSAGE'];
							$DATE_SENT = $group['DATE_SENT'];
							$FILE_NAME = $group['FILE_NAME'];
							$READ_TRACH = $group['READ_TRACH'];

			 $selection_count = mysqli_query($connection,"SELECT * FROM schoolchild 
						WHERE SENDER = '$name' AND RECIVER = '$RECIVER'");

				$selection_count_read = mysqli_query($connection,"SELECT * FROM schoolchild 
						WHERE SENDER = '$name' AND READ_TRACH = 0");

				if ($selection_count) {
					$num = mysqli_num_rows($selection_count); 
				}
				if ($selection_count_read) {
					$nums = mysqli_num_rows($selection_count_read); 
				}
				// get student name
				$get_student = mysqli_query($connection, "SELECT STUDENT_NAME FROM 
					students WHERE STUDENT_NNUMBER = '$RECIVER'");

				if ($get_count = mysqli_fetch_array($get_student)) {
					$SSTUDENT_NAME = $get_count['STUDENT_NAME'];
					# code...
				}



							 
							echo "<tr class = 'info'><td>$SSTUDENT_NAME; $RECIVER ($num Message sent, $nums read)</td><td>$subject</td>
							<td>";?>

		 <ul class = "nav"><li class = "dropdown ">				
			  <a class="dropdown-toggle" 
			  data-toggle="dropdown" href="#"> 
			  	Message Controls <span class="caret"></span>
			  </a>
			   <ul class = "dropdown-menu">
 			      	<li><a href="#myModal<?php echo"$GMail_ID"?>"  data-toggle="modal">View</a></li> 				 
					 
			    </ul>
			</li>
		</ul>

			<div id="myModal<?php echo"$GMail_ID"?>" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">						 
						<div class="modal-body">
							<?php
		  $reciever = $RECIVER;
		  // get the parent detail
		  $select_details = mysqli_query($connection, "SELECT PARENT_NAME FROM parent 
		  	WHERE STUDENT_NNUMBER = ' $reciever'");
		  if ($select_details) {
		  	while ($x = mysqli_fetch_array($select_details)) {
		  		$PARENT_NAME = $x['PARENT_NAME'];
		  		echo "<p class = 'alert-index alert-danger'>Parrent: $PARENT_NAME </p>";
		  		// get this parents children
		  		echo "<p class ='text-danger'>Student</p>";
		  		  $select_student_details = mysqli_query($connection, "SELECT CLASS_NAME, STUDENT_NAME FROM students 	WHERE STUDENT_NNUMBER = ' $reciever'");
		  		  if ($select_student_details) {
		  		  	while ($d = mysqli_fetch_array($select_student_details)) {
		  		  		$CLASS_NAME = $d['CLASS_NAME'];
		  		  		$STUDENT_NAME = $d['STUDENT_NAME'];
		  		  		echo "Name:$STUDENT_NAME; Class: $CLASS_NAME";
		  		  	}
		  		  	# code...
		  		  }
		  		# code...
		  	}
		  }

		 $selectionsms = mysqli_query($connection,"SELECT * FROM schoolchild 
						WHERE SENDER = '$name' ORDER BY GMail_ID DESC");
		 if ($selectionsms) {
		 	while ($c = mysqli_fetch_assoc( $selectionsms)) {
		 		$RECIVERc = $c['RECIVER'];
				$GMail_IDc = $c['GMail_ID'];
				$subjectc = $c['MESSAGE_SUBJECT'];
				$RECIVERc = $c['RECIVER'];
				$SENDERc = $c['SENDER'];
				$MESSAGEc = $c['MESSAGE'];
				$DATE_SENTc = $c['DATE_SENT'];
				$FILE_NAMEc = $c['FILE_NAME'];
				$READ_TRACHc = $c['READ_TRACH'];
				if ($READ_TRACHc == 1) {
					$state = "<i class ='text-danger'>Not raed</i>";
					# code...
				}
				else{
				$state = "<i class ='text-success'>Raed</i>";	
				}

				echo "<div class = 'well'>
				<center class = 'alert-index alert-info'>$subjectc</center>
				<p>$MESSAGEc</p> 
				<i class = 'text-info'>Attatchment:<a href = 'assumpta/$FILE_NAMEc'>File</a>
				 <p>$DATE_SENTc</p>
				Status:$state</i>

	 <a href='#edit$GMail_IDc' data-toggle='collapse'><i class = 'text-info'>Edit</i></a>";?>

	 <a href="#myModalcharles<?php echo $GMail_IDc?>" class="btn btn-link" data-toggle="modal"><i class = "text-danger">Delete</i></a>
			<div id="myModalcharles<?php echo $GMail_IDc?>" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a href="" class="close" data-dismiss="modal">
								&times
							</a>
							<center class = "text-danger">Are you sure?</center>
						</div>
						<div class="modal-body">

							<form method = "POST">
								<input type = "text" value = "<?php echo $GMail_IDc?>" name = "del_charles">
								<br/>
								<input type = "submit" class = "btn btn-danger" value = "delete Message">
							</form>
						</div>						 
					</div>
				</div>
			</div>


	 
<?php

		echo "<div id='edit$GMail_IDc' class='collapse'>
			<div class='well'>";?>
				 <form method = "POST" action = "edit_student_message.php" enctype = "multipart/form-data" class = "alert alert-warning">
				 <p>Subject.Title:</p>
				<input type = "text" name = "subject" required class = "form-control" placeholder = "What is this message all about??">
				<p>Message:</p>
				<textarea  name = "the_message" required class = "form-control" name = "message" placeholder = "Type main message here...">
					</textarea>
					<br/>
					<input type = "text" name = "the__id" required value = "<?php echo"$GMail_IDc"?>"><br/>
				<input type = "file" name = "file_name"> <i alert alert-warning>Max size 100MB, .zip and .rar</i>
				<br/><input type = "submit" class = "btn btn-primary" value = "send">								
			</form>
			<?php
			echo "</div>

		</div>				 
				</div>
				";


		 		# code...
		 	}
		 	# code...
		 }
					


							?>
 						</div>						 
					</div>
				</div>
			</div>

						<?php 
							echo "</td></tr>";
							# code...
						}
						# code...
					}
				}
			}

			if (isset($_POST['del_charles'])) {
				$del_id = mysqli_real_escape_string($connection, $_POST['del_charles']);
				mysqli_query($connection,"DELETE FROM schoolchild WHERE GMail_ID = '$del_id'"); 
			}

?>
</table>

	</div>
</div>		 

			 

			</body>
	</htnl>