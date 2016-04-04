<?php
include("connector.php");
if (isset($_SESSION['save'])) {
	unset($_SESSION['save']);
	# code...
}
mysqli_query($connection,"CREATE TABLE students(ID 
	INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID), CLASS_NAME TEXT(50) NOT NULL,
	STUDENT_NAME TEXT(255) NOT NULL,STUDENT_NNUMBER INT(25) NOT NULL UNIQUE, 
	PRIORITY INT(1) NOT NULL)");

mysqli_query($connection,"CREATE TABLE parent(ID 
	INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID), 
	PARENT_NAME TEXT(255) NOT NULL,STUDENT_NNUMBER INT(15) NOT NULL REFERENCES  
	students(STUDENT_NNUMBER),  
	PRIORITY INT(1) NOT NULL,ACTIVATION_KEY TEXT(6) NOT NULL)");

$student_number_gen = 1;
$default_user_name = time();//coz the white space will kill the uniqueness
if (!empty($_POST['name_of_student'])) { 
		if (!empty($_POST['class_name'])) {
			$student_name = $_POST['name_of_student'];
			$class = $_POST['class_name']; 
			$parent_name = $_POST['parent_of_student'];
			$select = mysqli_query($connection, "SELECT *FROM students");
			if ($select) {
				if (mysqli_num_rows($select) == 0) {
					$save = mysqli_query($connection, "INSERT INTO students(STUDENT_NAME, 
					STUDENT_NNUMBER,PRIORITY,CLASS_NAME)VALUES('$student_name', 
					'$student_number_gen',2,'$class')");

					if ($save) {
						$key = generateactivation_key();
						$save = mysqli_query($connection, "INSERT INTO 
					parent(PARENT_NAME, STUDENT_NNUMBER,PRIORITY,ACTIVATION_KEY)VALUES('$parent_name', 
					'$student_number_gen',3,'$key')");
						# code...
					}
					# code...
				}
				else{
					// get the lase student number
					$select_num = mysqli_query($connection, "SELECT  STUDENT_NNUMBER FROM  students");
					if ($select_num) {
						while ($get_num = mysqli_fetch_assoc($select_num)) {
							$num = $get_num['STUDENT_NNUMBER'];


							# code...
						}
					$last_numner = $num + generateRandomString();
					$save = mysqli_query($connection, "INSERT INTO students(STUDENT_NAME, 
					STUDENT_NNUMBER,PRIORITY,CLASS_NAME)VALUES('$student_name', 
					'$last_numner',2,'$class')");


					if ($save) {
						$key = generateactivation_key();
						$save = mysqli_query($connection, "INSERT INTO 
					parent(PARENT_NAME, STUDENT_NNUMBER,PRIORITY,ACTIVATION_KEY)VALUES('$parent_name', 
					'$last_numner',3,'$key')");
						# code...
					}
				
						# code...
					}



				}
				# code...
				if ($save) {
					$_SESSION['save']="Student saved successifully";
					# code...
				}
				else{
					$_SESSION['save'] = mysqli_error($connection);
				}
			}

		} 
	}

	function generateRandomString($length = 3) {
      $characters = '123456789';

    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateactivation_key($length = 5) {
      $characters = '23456789ABCDEGHJKMNPQWYZ';

    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
header("location:teacher.php");
?>