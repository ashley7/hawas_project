<?php
include("connector.php");
 $code = $_POST['code']; 
mysqli_query($connection,"UPDATE schoolchild SET 
	READ_TRACH = 0 WHERE GMail_ID = '$code'");
header("location:students.php");
?>