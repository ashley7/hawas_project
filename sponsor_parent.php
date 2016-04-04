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
 	 <li class = "active"><a href="#myModalperent" class="btn btn-info" data-toggle="modal">Create message</a>
</li> 
	<li class="active"><a href="#myModal"  data-toggle="modal">Upload profile picture</a></li> 
 <li><a href="perent_sent.php">Sent Items</a></li>
 	 <li class = "active"><a href="sms_child.php">Send Message to child</a></li>

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
	
	<div id="accordion" class="panel-group">
				<div class="panel panel-success">
					 
					<div class="panel-collapse collapse in" id="one">
						<div class="panel-body">
			<?php
			if (isset($_SESSION['not'])) {
				echo $_SESSION['not'];
			 }
			?>
		<table class = "table table-hover">
				<tr class = "danger"><th>Recipient</th><th>subject</th><th>Options</th></tr>
		<?php
			$name = "";
			if (isset($_SESSION["name"])) {
	 		$name = $_SESSION["name"];
	 		// echo "$name";
	 			}
	 // get all the messages that have been sent
	 			$selection = mysqli_query($connection,"SELECT 
	 				TEACHER_NAME FROM register_teacher WHERE 
	 				USERNAME = '$name'");
	 			if ($selection) {	 				 
	 				while ($counter = mysqli_fetch_assoc($selection)) {
	 				$TEACHER_NAME = $counter['TEACHER_NAME'];
	 				// echo "$TEACHER_NAME";

	 				// get all usernames and select only those that have ever sent U a sms

	 				$selection_user = mysqli_query($connection, 
	 					"SELECT USERNAME FROM `register_teacher`");
	 				if ($selection_user) {
	 					while ($users = mysqli_fetch_assoc($selection_user)) {
	 						$USERNAME = $users['USERNAME'];
	 						// echo "$USERNAME ";


	 				// get the messages
	 						$get_sms_raed = mysqli_query($connection, "SELECT *FROM 
	 					schoolgmails WHERE RECIVER = '$TEACHER_NAME' AND 
	 					SENDER = '$USERNAME'");
	 						if ($get_sms_raed) {
	 							 $total = mysqli_num_rows($get_sms_raed);
	 							# code...
	 						}
	$get_sms_raed_count = mysqli_query($connection, "SELECT *FROM schoolgmails WHERE RECIVER = '$TEACHER_NAME' AND READ_TRACH = 1");

	if ($get_sms_raed_count) {
		$new_sms = mysqli_num_rows($get_sms_raed_count);
		

		# code...
	}


	 				 $get_sms_raed_new = mysqli_query($connection, "SELECT *FROM 
	 					schoolgmails WHERE RECIVER = '$TEACHER_NAME'");
	 				 if ($get_sms_raed_new) {
	 				 	$all_sms = mysqli_num_rows($get_sms_raed_new);
	 				 
	 				 	# code...
	 				 }


	 				$get_sms = mysqli_query($connection, "SELECT *FROM 
	 					schoolgmails WHERE RECIVER = '$TEACHER_NAME' AND 
	 					SENDER = '$USERNAME' limit 1");
	 				if ($get_sms) {
	 					if (mysqli_num_rows($get_sms)>0) {
	 						while ($group = mysqli_fetch_assoc($get_sms)) {
	 						
							$GMail_ID = $group['GMail_ID'];							 
							$subject = $group['MESSAGE_SUBJECT'];
							$SENDER = $group['SENDER'];
							$READ_TRACH = $group['READ_TRACH'];
							echo "<p class = 'text-info'>$new_sms New messages; $all_sms messages in Inbox;";
							
						 
							echo "<tr class='info'>
							<td>$SENDER($total Messages)</td><td>$subject</td><td>";?>

		 <a href="#myModal<?php echo "$GMail_ID"?>" class="btn btn-link" data-toggle="modal">Message controls</a>
			<div id="myModal<?php echo "$GMail_ID"?>" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">						 
						<div class="modal-body">
							<?php						 	

					 $get_all_sms = mysqli_query($connection, "SELECT *FROM 
	 					schoolgmails WHERE RECIVER = '$TEACHER_NAME' AND 
	 					SENDER = '$USERNAME' ORDER BY GMail_ID DESC");
					 if($get_all_sms) {
					 	while ($vella = mysqli_fetch_assoc($get_all_sms)) {
					 		$MESSAGE = $vella['MESSAGE'];
					 		$GMail_ID = $vella['GMail_ID'];
	 						$RECIVER = $vella['RECIVER'];
	 						$subject = $vella['MESSAGE_SUBJECT'];
							$RECIVER = $vella['RECIVER'];
							$SENDER = $vella['SENDER'];
							$MESSAGE = $vella['MESSAGE'];
							$DATE_SENT = $vella['DATE_SENT'];
							$FILE_NAME = $vella['FILE_NAME'];
							$READ_TRACH = $vella['READ_TRACH'];
							if ($READ_TRACH  == 1) {
								$state = "<i class ='text-danger'>Not read</i>
	<form method = 'POST'>
		<input type = 'checkbox' value = '$GMail_ID' id = 'comfirm_raed'> <i class = 'text-success'>Comfirm as read.</i>
		</form>

	 <a href='#sectionTwo$GMail_ID' data-toggle='collapse'>Confirm as read.</a>
		<div id='sectionTwo$GMail_ID' class='collapse'>
			<div class='aler  alert-warning'>
			<form method = 'POST' action = 'ajax_comfirm_messages.php'>
			<input type = 'text' required value = '$GMail_ID' name = 'code' class = 'text-success'></i>
			<input type = 'submit' class = 'btn btn-warning' value = 'Comfirm as read'>
			</form>				 
			</div>
		</div>

								";?>

								<script src = "js/jquery-1.11.3.min.js"></script>
             <script>
               $(document).ready(
                function(){                
                  $('#comfirm_raed').change(
                    function(){
                        var code = $(this).val();
                        //document.write(code);
                        var data = 'code='+code;

                        // alert(code);
                        alert('Message comfirmed as read!!!');

                        $.ajax(
                        {
                            type : "POST",
                            url : "ajax_comfirm_messages.php",
                            data : data,
                            cache : false,
                            success : function(html){
                                $("#student_number").html(html);                                   

                                } 

                              }
                            );

                    }
                    );
               });
          
             </script> 



								<?php


								# code...
							}
							else{
								$state = "<i class ='text-success'>Read</i>";
							}
							 
						// get the names of the sender
							$select_name = mysqli_query($connection, 
								"SELECT TEACHER_NAME FROM register_teacher WHERE 
								USERNAME = '$SENDER'");
							if ($select_name) {
								while ($the_true_name = mysqli_fetch_assoc($select_name)) {
									$TEACHER_NAME = $the_true_name['TEACHER_NAME'];
									echo "<p class = 'alert alert-info'>From: $TEACHER_NAME; aka $SENDER</p>
									<div class = 'well'>
									<center class = 'alert-index alert-danger'>$subject</center>
									$state 
									<p class = 'text'>$MESSAGE</p>
									<p class = 'text-info'>$DATE_SENT</p>";
									if ($FILE_NAME == NULL) {
										# code...
									}
									else
										echo "<p><a href= 'assumpta/$FILE_NAME' >atarchment</a></p>

									</div>
									";
									# code...

								}
								# code...
							}



					 	}
					 	# code...
					 }

							?>
 						</div>
						
					</div>
				</div>
			</div>





							<?php
							echo "
							 </td></td>

							</tr>";
	 						 
	 							# code...
	 						}
	 						# code...
	 					}
	 					else{
	 						// echo "No inbox yet!!";
	 					}
	 					# code...
	 				}

	 						# code...
	 					}
	 					# code...
	 				}
	 			 


	 				}//while
	 			}



	 	 

?>
</table>

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

?>


			<div id="myModalperent" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						 
						<div class="modal-body">

<h4>Sending to Teacher</h4> 							 
 <form method = "POST" action = "paent_sent_to_teacher.php" enctype = "multipart/form-data">
	 <p>TO:</p> 
	<input type = "text" name = "recepient" required class = "form-control" placeholder = "Sender's name, It is the name after aka">
	<p>Subject.Title:</p>
	<input type = "text" name = "subject" required class = "form-control" placeholder = "What is this message all about??">
	<p>Message:</p>
	<textarea  name = "the_message" required class = "form-control" name = "message" placeholder = "Type main message here...">
		</textarea>
		<br/>
	<input type = "file" name = "file_name"> <i alert alert-warning>Max size 100MB, .zip and .rar</i>
	<br/><input type = "submit" class = "btn btn-primary" value = "send">								
</form>


 						</div>
					 
					</div>
				</div>
			</div>	 

	

			 

			</body>
	</htnl>