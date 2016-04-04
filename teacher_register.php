<?php
include("connector.php");
mysqli_query($connection,"CREATE TABLE register_teacher(ID 
	INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID), 
	TEACHER_NAME TEXT(255) NOT NULL, USERNAME VARCHAR(255) NOT NULL 
	UNIQUE, PASSWORD TEXT(50) NOT NULL, PHOTO TEXT(50),PRIORITY INT(1) NOT NULL)");
if (!empty($_POST['name_of_teacher'])) {
	if (!empty($_POST['teacher_username'])) {
		if (!empty($_POST['teacher_password'])) {
			if ($_POST['comfirm_teacher_password']) {
				if (!empty($_POST['teacher_activation'])) {

	$name_of_teacher = $_POST['name_of_teacher'];
	$teacher_username = $_POST['teacher_username'];
	$password_one = $_POST['teacher_password'];
	$password_two = $_POST['comfirm_teacher_password'];
	$teacher_activate = $_POST['teacher_activation'];
	$make_activation_key  = hash("ripemd128",$_POST['teacher_activation']);

	if ($password_one == $password_two) {
		$strong_pin = hash("ripemd128",$password_two);
		$select_actiavtion_key = mysqli_query($connection, 
				 		"SELECT security_KEY FROM security");
		if ($select_actiavtion_key) {
			while ($counter = mysqli_fetch_array($select_actiavtion_key)) {
				$secuirty = $counter['security_KEY'];
				if ($make_activation_key == $secuirty) {
					# code...
					// save
					$save = mysqli_query($connection, "INSERT INTO 
					register_teacher(TEACHER_NAME, USERNAME,PASSWORD,PRIORITY)VALUES('$name_of_teacher ',
						'$teacher_username','$strong_pin',1)");
					if ($save) {
	 					 $_SESSION['non'] = "<p class = 'text-success'>You have registered successifully.</p>";
						# code...
					}
					else{
 						$_SESSION['non'] = "<p class = 'text-danger'>The username $teacher_username is taken.</p>";
		
					}

				}
				else{
					$_SESSION['non'] = "<p class = 'text-danger'>Activation key is not correct.</p>";
				}
				# code...
			}
			# code...
		}

	}
	else{
	 $_SESSION['non'] = "<p class = 'text-danger'>The password did not mutch.</p>";

	}


					 
				}				  
			}			 
		}
	}	 
}
if (isset($_SESSION['non'] )) {
	echo $_SESSION['non'] ;
	# code...
}
header("Location:index.php");
?>