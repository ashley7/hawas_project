<?php
include("connector.php");
 
$con = $connection;
if (!empty($_POST['Username'])) {
	$useranme = mysqli_real_escape_string($con,$_POST['Username']);
 if (!empty($_POST['Password'])) {
		$paswword = mysqli_real_escape_string($con,$_POST['Password']);
		$paswword = hash("ripemd128", $paswword);
		echo "<p>From user $paswword</p>";
		// get priority
			$get_priority = mysqli_query($connection,"SELECT PRIORITY, 
				PASSWORD,PHOTO FROM register_teacher WHERE USERNAME = '$useranme'");
			if ($get_priority) {
				if (mysqli_num_rows($get_priority) == 1) {
					while ($counter = mysqli_fetch_array($get_priority)) {
					$paswd = $counter['PASSWORD'];
					echo "<p>From db $paswd</p>";
					$priority = $counter['PRIORITY'];
					$photo_name = $counter['PHOTO'];
					if ($paswd == $paswword) {
						if ($priority == 1) {

							$_SESSION["name"] = $useranme;
 
							header("location:teacher.php");
							exit();


							# code...
						}
						elseif ($priority == 2) {
							$_SESSION["name"] = $useranme;
 
							header("location:students.php");
							exit();
							# code...
						}
						elseif ($priority == 3) {

							$_SESSION["name"] = $useranme;
 
							header("location:sponsor_parent.php");
							exit();
							# code...
						}
						else{

						}
						# code...
					}
					else{
						$_SESSION['non'] = "<p class = 'text-warning'>$useranme the password you entered is not correct, please try again.</p>";
					}

					
						# code...
					}
					# code...

				}
				else{
					$_SESSION['non'] = "<p class = 'text-danger'>Username $useranme not found in the system.</p>";
				}
				# code...
			}
		}
	}
	header("location:index.php");

?>