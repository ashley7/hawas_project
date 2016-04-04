<?php
include("connector.php"); 
if (isset($_SESSION["name"])) {
	# code...
	$name = $_SESSION["name"];
}
 

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
	if ($extension == "pgf" || $extension == "zip" || $extension == "rar") {
		if ($file_size <= 500000000) {//500GB
			# code...
			$tym = time();
			$file_name = "thembo_files$tym.$extension";
			move_uploaded_file($_FILES['file_name']['tmp_name'], "assumpta/$file_name");

 $send_sms = mysqli_query($connection,"UPDATE schoolchild SET MESSAGE_SUBJECT = '$title',MESSAGE = '$the_message', 
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


	 $send_sms = mysqli_query($connection,"UPDATE schoolchild SET MESSAGE_SUBJECT = '$title',MESSAGE = '$the_message' WHERE RECIVER = '$reciever' AND 	GMail_ID = '$getter'");


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

 

 

	 $send_sms = mysqli_query($connection,"UPDATE schoolchild SET MESSAGE_SUBJECT = '$title',MESSAGE = '$the_message' WHERE RECIVER = '$reciever' AND 	GMail_ID = '$getter'");


if ($send_sms) {
	$_SESSION['not'] = "<p class = 'text-success'>Your Message has been sent.</p>";
	# code...
}
else{
	$_SESSION['not'] = "<p class = 'text-warning'>Message Not sent, Try Resending</p>";
}
	# code...
 

header("location:perent_sent_tostude.php");
?>