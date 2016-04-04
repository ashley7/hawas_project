<?php
include("connector.php"); 
if (isset($_SESSION["name"])) {
	# code...
	$name = $_SESSION["name"];
}
mysqli_query($connection,"CREATE TABLE schoolGMails(GMail_ID 
	INT(50) NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(GMail_ID),
	MESSAGE_SUBJECT TEXT(255), 
	RECIVER TEXT(225) NOT NULL, 
	SENDER TEXT(255) NOT NULL,
	MESSAGE TEXT(600),
	DATE_SENT TEXT(100) NOT NULL, 
	FILE_NAME TEXT(255), READ_TRACH INT(1))");


$reciever = $title  = $the_message=$file_name="";

if (!empty(!empty($_POST['recepient']))) {
	$reciever = mysqli_real_escape_string($connection, $_POST['recepient']);
}
if (!empty($_POST['subject'])) {
	$title = mysqli_real_escape_string($connection,$_POST['subject']);
 }
if (!empty($_POST['the_message'])) { 
	$the_message = mysqli_real_escape_string($connection,$_POST['the_message']);
}
	$today = date("l F jS, Y");
	$today_time  = date("g:i:s A", time());
	$date_sent = "On $today at $today_time";


if (isset($_FILES['file_name'])) {
	$file_name =  $_FILES['file_name']['name'];
	$file_size =  $_FILES['file_name']['size'];
	$extension = pathinfo($file_name , PATHINFO_EXTENSION);
	if ($extension == "pdf" || $extension == "zip" || $extension == "rar") {
		if ($file_size <= 500000000) {//500GB
			# code...
			$tym = time();
			$file_name = "thembo_files$tym.$extension";
			move_uploaded_file($_FILES['file_name']['tmp_name'], "assumpta/$file_name");

 $send_sms = mysqli_query($connection,"INSERT INTO schoolgmails(MESSAGE_SUBJECT, 
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

		$send_sms = mysqli_query($connection,"INSERT INTO schoolgmails(MESSAGE_SUBJECT, 
	RECIVER,SENDER,MESSAGE,DATE_SENT,READ_TRACH)VALUES('$title', 
	'$reciever','$name','$the_message','$date_sent',1)");
if ($send_sms) {
	$_SESSION['not'] = "<p class = 'text-success'>Your Message has been sent.</p>";
	# code...
}
else{
	$_SESSION['not'] = "<p class = 'text-warning'>Message Not sent, Try Resending</p>";
}


		$_SESSION['not'] = "<p class = 'text-danger'>Invalid file type, it should be ziped or pdf<>";
	}

	# code...
}
else{
	$send_sms = mysqli_query($connection,"INSERT INTO schoolgmails(MESSAGE_SUBJECT, 
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
 

header("location:sponsor_parent.php");
?>