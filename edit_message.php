<?php
include("connector.php"); 
if (isset($_SESSION["name"])) {
	# code...
	$name = $_SESSION["name"];
}
 


$reciever = $title  = $the_message=$file_name="";

if (!empty(!empty($_POST['recepient']))) {
	$reciever = mysqli_real_escape_string($connection, $_POST['recepient']);
}

if (!empty($_POST['subject'])) {
	$title = mysqli_real_escape_string($connection,$_POST['subject']);
 }
 if (!empty($_POST['the__id'])) {
 	$getter = $_POST['the__id'];
 	# code...
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
	if ($extension == "pgf" || $extension == "zip" || $extension = "rar") {
		if ($file_size <= 500000000) {//500GB
			# code...
			$tym = time();
			$file_name = "thembo_files$tym.$extension";
			move_uploaded_file($_FILES['file_name']['tmp_name'], "assumpta/$file_name");

 $send_sms = mysqli_query($connection,"UPDATE schoolgmails SET MESSAGE_SUBJECT = '$title',MESSAGE = '$the_message', 
 	FILE_NAME = '$file_name' WHERE RECIVER = '$reciever' AND 
 	GMail_ID = '$getter'");
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
	}

	# code...
}

 

 

	 $send_sms = mysqli_query($connection,"UPDATE schoolgmails SET MESSAGE_SUBJECT = '$title',MESSAGE = '$the_message' WHERE RECIVER = '$reciever' AND 	GMail_ID = '$getter'");


if ($send_sms) {
	$_SESSION['not'] = "<p class = 'text-success'>Your Message has been sent.</p>";
	# code...
}
else{
	$_SESSION['not'] = "<p class = 'text-warning'>Message Not sent, Try Resending</p>";
}
	# code...
 

header("location:sms.php");
?>