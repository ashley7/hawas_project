<?php
include("connector.php"); 
if (isset($_SESSION["name"])) {
	# code...
	$name = $_SESSION["name"];
}
mysqli_query($connection,"CREATE TABLE schoolchild(GMail_ID 
	INT(50) NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(GMail_ID),
	MESSAGE_SUBJECT TEXT(255), 
	RECIVER TEXT(225) NOT NULL, 
	SENDER TEXT(255) NOT NULL,
	MESSAGE TEXT(600),
	DATE_SENT TEXT(100) NOT NULL, 
	FILE_NAME TEXT(255), READ_TRACH INT(1))");

// get student number
$selectstd = mysqli_query($connection,"SELECT TEACHER_NAME FROM  register_teacher 
	WHERE USERNAME = '$name'");
if ($selectstd) {
	while ($get_std = mysqli_fetch_assoc($selectstd)) {
		# code...
		$TEACHER_NAME = $get_std['TEACHER_NAME'];//this is the student numbet, the reciever of the message
	}
	# code...
}



$reciever = $title  = $the_message=$file_name="";

 
	$reciever = mysqli_real_escape_string($connection, $TEACHER_NAME);

if (!empty($_POST['subject'])) {
	$title = mysqli_real_escape_string($connection,$_POST['subject']);
 }
if (!empty($_POST['the_message'])) { 
	$the_message = mysqli_real_escape_string($connection,$_POST['the_message']);
}
	$today = date("l F jS, Y");
	$today_time  = date("g:i:s A", time());
	$date_sent = "On $today at $today_time";


if (!empty($_FILES['file_namess'])) {
	$file_name =  $_FILES['file_namess']['name'];
	 
	$file_size =  $_FILES['file_namess']['size'];
	 
	$extension = pathinfo($file_name , PATHINFO_EXTENSION);
	 echo "	$reciever";

	if ($extension == "pdf" || $extension == "zip" || $extension == "rar") {
		if ($file_size <= 500000000) {//500GB
			# code...
			$tym = time();
			$file_name = "thembo_files$tym.$extension";
			move_uploaded_file($_FILES['file_namess']['tmp_name'], "assumpta/$file_name");

 $send_sms = mysqli_query($connection,"INSERT INTO schoolchild(MESSAGE_SUBJECT, 
	RECIVER,SENDER,MESSAGE,DATE_SENT,FILE_NAME,READ_TRACH)VALUES('$title', 
	'$reciever','$name','$the_message','$date_sent','$file_name',1)");
if ($send_sms) {
	$_SESSION['not'] = "<p class = 'text-success'>Your Message has been sent.</p>";
	# code...
}
else{
	$_SESSION['not'] = "<p class = 'text-warning'>Message Not sent, Try Resending</p>";
}



		}
		else{
			$_SESSION['not'] = "File size should be less than 50MB";
		}
		# code...

	}
	else{
		$_SESSION['not'] = "<p class = 'text-danger'>Invalid file type, it should be ziped or pdf<>";

		$send_sms = mysqli_query($connection,"INSERT INTO schoolchild(MESSAGE_SUBJECT, 
	RECIVER,SENDER,MESSAGE,DATE_SENT,READ_TRACH)VALUES('$title', 
	'$reciever','$name','$the_message','$date_sent',1)");
if ($send_sms) {
	$_SESSION['not'] = "<p class = 'text-success'>Your Message has been sent.</p>";
	# code...
}
else{
	$_SESSION['not'] = "<p class = 'text-warning'>Message Not sent, Try Resending</p>";
}
	}

	# code...
}
else{
	$send_sms = mysqli_query($connection,"INSERT INTO schoolchild(MESSAGE_SUBJECT, 
	RECIVER,SENDER,MESSAGE,DATE_SENT,READ_TRACH)VALUES('$title', 
	'$reciever','$name','$the_message','$date_sent',1)");
if ($send_sms) {
	$_SESSION['not'] = "<p class = 'text-success'>Your Message has been sent.</p>";
	# code...
}
else{
	$_SESSION['not'] = "<p class = 'text-warning'>Message Not sent, Try Resending</p>";
}
}
	# code...
 

header("location:sms_child.php");
?>