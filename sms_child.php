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
 	 <li class = "active"><a href="#myModalchild" class="btn btn-info" data-toggle="modal">Create message</a>
</li> 
  <li><a href="perent_sent_tostude.php">Sent Items</a></li>
 	<li class="btn btn-info"><a href="sms_child.php">Send Message to child</a></li>

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
<center class = "alert alert-danger">Messages from your child</center>
			<div id="accordion" class="panel-group">
				<div class="panel panel-success">
					 
					<div class="panel-collapse collapse in" id="one">
						<div class="panel-body">
 					
<?php
$selectstd = mysqli_query($connection,"SELECT TEACHER_NAME FROM  register_teacher 
	WHERE USERNAME = '$name'");
if ($selectstd) {
	while ($get_std = mysqli_fetch_assoc($selectstd)) {
		# code...
		$TEACHER_NAME = $get_std['TEACHER_NAME'];//this is the paent recivinng the sms

	}
	# code...
}
// get the messages

$get_sms  =  mysqli_query($connection,"SELECT * FROM schoolchild WHERE 
	SENDER = '$TEACHER_NAME' ORDER BY GMail_ID DESC");
if ($get_sms) {
	 
	while ($c = mysqli_fetch_assoc($get_sms)) {
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
					# code...
					if ($FILE_NAMEc == NULL) {
						# code...
			 echo "<p class = 'alert-index alert-warning'>$MESSAGEc
				<br/>Date:$DATE_SENTc 
				</p>

		 <a href='#sectionTwo$GMail_IDc' data-toggle='collapse'>confirm as read</a>

		<div id='sectionTwo$GMail_IDc' class='collapse'>
			<div class='alert-index alert-success'>

			<form method = 'POST' class = 'form form-inline'>
			<input type = 'text' value = '$GMail_IDc' name = 'read' class = 'form-control'>
			<input type = 'submit' value = 'confirm' class = 'btn btn-success'>

			</form>
			</div>
		</div>


				";
					}
					else{

						echo "<p class = 'alert-index alert-warning'>$MESSAGEc
				<br/>Date:$DATE_SENTc
				<br><a href = '../assumpta/$FILE_NAMEc'>Has file</a> 
				</p>

						 <a href='#sectionTwo$GMail_IDc' data-toggle='collapse'>confirm as read</a>

		<div id='sectionTwo$GMail_IDc' class='collapse'>
			<div class='alert-index alert-success'>

			<form method = 'POST' class = 'form form-inline'>
			<input type = 'text' value = '$GMail_IDc' name = 'read' class = 'form-control'>
			<input type = 'submit' value = 'confirm' class = 'btn btn-success'>

			</form>
			</div>
		</div>


				";

					}
					
				}
				else{

					# code...
			 if ($FILE_NAMEc == NULL) {
						# code...
			 echo "<p class = 'alert-index alert-success'>$MESSAGEc
				<br/>Date:$DATE_SENTc 
				</p>

				 


				";
					}
					else{

						echo "<p class = 'alert-index alert-success'>$MESSAGEc
				<br/>Date:$DATE_SENTc
				<br><a href = '../assumpta/$FILE_NAMEc'>Has file</a> 
				</p>
						 


				";

					}


				}


				


			 
	# code...
}
 }


if (isset($_POST['read'])) {
	$read = $_POST['read'];
	mysqli_query($connection,"UPDATE schoolchild SET READ_TRACH = 0 WHERE 
		GMail_ID = '$read'");
	# code...
}
?>
	</div>
					</div>
				</div>
			</div>
		</div>






			 

			 </div>
			</div>

			<div id="myModalchild" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a href="" class="close" data-dismiss="modal">
								&times
							</a>
							 
						</div>
						<div class="modal-body">
 <center class = "alert alert-danger">Sending to child</center> 							 
 <form method = "POST" action = "parent_sent_to_student.php" enctype = "multipart/form-data">
<p>Subject.Title:</p>
	<input type = "text" name = "subject" required class = "form-control" placeholder = "What is this message all about??">
	<p>Message:</p>
	<textarea  name = "the_message" required class = "form-control" name = "message" placeholder = "Type main message here...">
		</textarea>
		<br/>
	<input type = "file" name = "file_namess"> <i alert alert-warning>Max size 100MB, .zip and .rar</i>
	<br/><input type = "submit" class = "btn btn-primary" value = "send">								
</form>


 						</div>						 
					</div>
				</div>
			</div>
	

			 

			</body>
	</htnl>