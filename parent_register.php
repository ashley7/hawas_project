<?php
include("connector.php"); 
	if (!empty($_POST['parent_username'])) {
		if (!empty($_POST['parent_password'])) {
			if ($_POST['comfirm_parent_password']) {
				if (!empty($_POST['key'])) { 
					echo "string";
	$username = $_POST['parent_username'];
	$password_one = $_POST['parent_password'];
	$password_two = $_POST['comfirm_parent_password'];
	$actiavtion_key = $_POST['key']; 
	if ($password_one == $password_two) {
		$strong_pin = hash("ripemd128",$password_two);
		$child = $_POST['studentNumber'];
		$select_student_number = mysqli_query($connection, "SELECT * FROM 
			parent WHERE STUDENT_NNUMBER = '$child'");
			if ($select_student_number) {
				if (mysqli_num_rows($select_student_number) > 0) {	

							 // 
					$check_key = mysqli_query($connection,"SELECT ACTIVATION_KEY FROM  
						parent WHERE STUDENT_NNUMBER = '$child'");

					if ($check_key) {
						if (mysqli_num_rows($check_key) == 1) {
							while ($geter = mysqli_fetch_assoc($check_key)) {
								$the_key = $geter['ACTIVATION_KEY'];
								if ($actiavtion_key == $the_key) {							 

				 	$save_for_login_control = mysqli_query($connection,
					 	"INSERT INTO register_teacher(TEACHER_NAME,USERNAME,
					 		PASSWORD,PRIORITY)VALUES('$child','$username','$strong_pin',3)");
					 		if ($save_for_login_control) {

					 			$_SESSION['non'] = "<p class = 'text-success'>Registered succesifully!!</p>";

					 			# code...
					 		}
					 		else{
					 			$_SESSION['non'] = "<p class = 'text-danger'>username $username is taken, please choose a different one.</p>";
					 		}
							# code...
						 
						# code...
									# code...
								}
								else{

									$_SESSION['non'] = "<p class = 'text-danger'>The activation key you entered is not correct. please try again</p>";

								}
								# code...
							}
							# code...
						}
						else{

						}
						# code...
					}

						 

						
					 
					 
				}
				else{
				$_SESSION['non'] = "<i class = 'text-danger'>Student number $student_number is not found in the system.</i>";
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
 
if (isset($_SESSION['non'] )) {
	echo $_SESSION['non'] ;
	# code...
}
header("Location:index.php");
?>