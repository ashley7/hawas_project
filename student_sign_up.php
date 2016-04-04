<?php
include("connector.php"); 
	if (!empty($_POST['student_username'])) {
		if (!empty($_POST['student_password'])) {
			if ($_POST['comfirm_student_password']) {
				if (!empty($_POST['student_number'])) { 
	$username = $_POST['student_username'];
	$password_one = $_POST['student_password'];
	$password_two = $_POST['comfirm_student_password'];
	$student_number = $_POST['student_number']; 
	if ($password_one == $password_two) {
		$strong_pin = hash("ripemd128",$password_two);
		$select_student_number = mysqli_query($connection, "SELECT * FROM 
			students WHERE STUDENT_NNUMBER = '$student_number'");
			if ($select_student_number) {
				if (mysqli_num_rows($select_student_number) > 0) {
					# code...

					// ?check number
					$selec = mysqli_query($connection, "SELECT * FROM 
					register_teacher WHERE TEACHER_NAME = '$student_number'");
					if ($selec) {
						if (mysqli_num_rows($selec) < 3) {

							$save_for_login_control = mysqli_query($connection,
					 	"INSERT INTO register_teacher(TEACHER_NAME,USERNAME,
					 		PASSWORD,PRIORITY)VALUES('$student_number','$username','$strong_pin',2)");
					 		if ($save_for_login_control) {
					 			$_SESSION['non'] = "<p class = 'text-success'>Registered succesifully!!</p>";

					 			# code...
					 		}
					 		else{
					 			$_SESSION['non'] = "<p class = 'text-danger'>username $username is taken, please choose a different one.</p>";
					 		}
							# code...
						}
						else{

							$_SESSION['non'] = "<p class = 'text-danger'>Student Number $student_number has already Registered.</p>";

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