<?php
	session_start(); 
?> 
<html lang = "en"> 
<?php
// connection to the server
$connection = mysqli_connect("127.0.0.1","root","");
mysqli_query($connection,"CREATE DATABASE hawa_db");
// connect to the db
$connection = mysqli_connect("localhost","root","","hawa_db");
// the default_admin_password, iy can be changed
$DEFAUTL_SECURYTY_KEY =hash("ripemd128", "hawa");
// make security Table
$c = mysqli_query($connection, "CREATE TABLE security(ID INT(11) NOT NULL 
	AUTO_INCREMENT, PRIMARY KEY(ID), security_KEY TEXT(32) NOT NULL)");
if (!$c) {
	// echo mysqli_error($connection);
	# code...
}
	// save the default password
$check = mysqli_query($connection,"SELECT security_KEY FROM security");
if ($check) {
	if(mysqli_num_rows($check)==0){
mysqli_query($connection,"INSERT INTO security(security_KEY)VALUES('$DEFAUTL_SECURYTY_KEY')");
	}
	else{
		// do nothing
	}
	# code...
}
?>
<style type="text/css">
    	h1{
    		background-color: black;
    	}

    	</style>