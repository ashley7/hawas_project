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
	 <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});			 
		</script>
		<style type="text/css">
		 

		</style>
    </head>
    <body>
		 
			<h1><center>SchoolGMail</center></h1>	 

<div class = "row">
	<div class = "col-md-3 col-lg-3 col-sm-12 col-xs-12 ">
		<div id="accordionc" class="panel-group">
				<div class="panel panel-success">					 
					<div class="panel-collapse collapse in" id="onex">
						<div class="panel-body">
							<nav class = "nav">						  
						<li> <a href="#sendsms" class="btn btn-info" data-toggle="modal">Type Message</a></li>
						 <li> <a href="sent_itemz.php">Sent Items</a></li>
			 	 <li class = "active"> <a href="#">Inbox</a></li>

							</nav>
 						</div>
					</div>
				</div>

			</div>

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
	<div class = "col-md-9 col-lg-9 col-sm-12 col-xs-12 ">
<?php
    if (isset($_SESSION['not'])) {
    		echo $_SESSION['not'];
    		# code...
    	}
  ?>
			<div id="accordion" class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">
							<a href="#one" data-toggle="collapse" data-parent="#accordion">INBOX</a>
						</div>
					</div>
					<div class="panel-collapse collapse in" id="one">
						<div class="panel-body">


		<table class = "table table-hover">
				<tr class = "danger"><th>Recipient</th><th>subject</th><th>Options</th></tr>
		<?php
		if (isset($_SESSION["name"])) {
	# code...
	$name = $_SESSION["name"];
}
			$select = mysqli_query($connection, "SELECT USERNAME FROM `register_teacher` ");
			if ($select) {
				while ($counter = mysqli_fetch_assoc($select)) {
					$all_usenames = $counter['USERNAME'];
					// echo "$all_usenames";
					$get_sms = mysqli_query($connection,"SELECT * FROM schoolgmails WHERE
					RECIVER = '$name' AND SENDER = '$all_usenames' ORDER BY GMail_ID DESC LIMIT 1");
					if ($get_sms) {
 						if (mysqli_num_rows($get_sms)>0) {
							while ($row = mysqli_fetch_array($get_sms)) {
								$MESSAGE_SUBJECT = $row['MESSAGE_SUBJECT'];
								// get sender 
								$get_the_name = mysqli_query($connection, 
									"SELECT TEACHER_NAME,PARENT_NAME FROM register_teacher, 
									schoolgmails, parent WHERE 
									schoolgmails.SENDER = '$all_usenames' AND 
									parent.STUDENT_NNUMBER = register_teacher.TEACHER_NAME");
								if ($get_the_name) {
									// echo mysqli_num_rows($get_the_name);
									while ($cc = mysqli_fetch_array($get_the_name)) {
										# code...
										$TEACHER_NAME = $cc['TEACHER_NAME'];
										$PARENT_NAME = $cc['PARENT_NAME'];
										// echo "$TEACHER_NAME: $PARENT_NAME<br/>";
									}

								 
									# code...
								}


								$SENDER = $row['SENDER'];
								$id = $row['GMail_ID'];

								echo "<tr class = 'success'><td>$PARENT_NAME @$SENDER</td><td>$MESSAGE_SUBJECT</td><td>";
								?>

				 <a href="#myModal<?php echo $id?>" class="btn btn-success" data-toggle="modal">Message control</a>
			<div id="myModal<?php echo $id?>" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a href="" class="close" data-dismiss="modal">
								&times
							</a>
							<center><h1>INBOX</h1></center>
						</div>
						<div class="modal-body">

							<?php
							echo "<p class = 'alert-index alert-warning'>Sender: $PARENT_NAME</p>";
								$id  = 	$id;
								$select_sms = mysqli_query($connection,
									"SELECT * FROM schoolgmails WHERE GMail_ID = '$id'");
								if ($select_sms) {
									while ($xx = mysqli_fetch_assoc($select_sms)) {
										$RECIVERx = $xx['RECIVER'];
										$SENDERx = $xx['SENDER'];
										$DATE_SENTx = $xx['DATE_SENT'];
										// echo "$RECIVERx:$SENDERx";
										// get all the messages 
										$select_all_messages = mysqli_query($connection,"SELECT 
											* FROM schoolgmails WHERE SENDER = '$SENDERx' 
											AND RECIVER = '$RECIVERx'");
										if ($select_all_messages) {
											while ($r_counter = mysqli_fetch_array($select_all_messages)) {
												# code...
												$MESSAGE = $r_counter['MESSAGE'];
												$MESSAGE_SUBJECT = $r_counter['MESSAGE_SUBJECT'];
												$FILE_NAME = $r_counter['FILE_NAME'];
												$READ_TRACH  = $r_counter['READ_TRACH'];
												$GMail_ID = $r_counter['GMail_ID'];
												$DATE_SENTx = $r_counter['DATE_SENT'];

												 
												echo "<center><p class = 'alert-indes alert-info'>$MESSAGE_SUBJECT</p></center>
												<p class = 'well'>$MESSAGE<br/>";

												if ($READ_TRACH == 1) {
													echo "<i class = 'text-danger'>Not read</i><br/>";
													# code...
											      echo "
													<form method = 'POST'>
														<input type = 'checkbox' value = '$GMail_ID' id = 'comfirm_raed'> <i class = 'text-success'>Comfirm as read.</i>
													</form>
													<a href='#sectionTwo$GMail_ID' data-toggle='collapse'>Confirm as read.</a>
													<div id='sectionTwo$GMail_ID' class='collapse'>
														 <div class='aler  alert-warning'>
														<form method = 'POST' action = 'ajax_com_messages.php'>
														  <input type = 'text' required value = '$GMail_ID' name = 'code' class = 'text-success'></i>
														  <input type = 'submit' class = 'btn btn-warning' value = 'Comfirm as read'>
														</form>
														</div>
													 </div><br/>";

												}
												else{
													echo "<i class = 'text-success'>Read</i><br/>";
												}
												echo "<i class = 'text-info'>$DATE_SENTx</i>
												<br/>";
												if ($FILE_NAME != NULL) {
													# code...
													echo "<a href = 'assumpta/$FILE_NAME'>Attachment</a>";
												}
												
	 echo                               "</p>"; ?>

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
								</td></tr>";
								 
								# code...
							}
							# code...register_teacher
						}
						else{
							// echo "No messages yet!!!";
						}
						# code...
					}

				}
				# code...
			}
			 
		 
        ?>
</table>							 
						</div>
					</div>
				</div>
			</div>

	</div>

</div>


<!-- message panel -->
			<div id="sendsms" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">					 
						<div class="modal-body alert alert-warning">
							 <h4>Sending to Parent</h4> 							 
							 <form method = "POST" action = "save_message.php" enctype = "multipart/form-data">
								 <p>TO:</p> 
								<input type = "text" name = "recepient" required class = "form-control" placeholder = "Enter the student number of this parent's child">
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
	</html>