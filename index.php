<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
?>
<html>
    <head>
        <title>schoolGMail</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	 <title>Hawa</title>
	 <script type="text/javascript" src="js/jquery-1.9.0.js"></script>
	 <script type="text/javascript" src="js/bootstrap.min.js"></script>


		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});			 
		</script>
		<style type="text/css">
		.pol{
			margin-left: 5%;
		}

		</style>
		<style type="text/css">
    	h1{
    		background-color: black;
    	}

    	</style>
    </head>
    <body>
		<div class="wrapper">
			<h1><center>SchoolGMail</center></h1>
			<center>
			<?php
			if (isset($_SESSION['non'] )) {
				echo $_SESSION['non'] ;	 
			}
			?>

			</center>
			
 			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					 
					<form class = "login active" method = "POST" action = "Login.php">
						<h3>Login</h3>
						<div>
						<label>Username:</label>
						<input type="text" class = "form-control" name = "Username" required/>
						 
						</div>
						<div>
						<label>Password: </label>
						<input type="password" class = "form-control" name = "Password" required />
						</div>
						<input type="submit" value="Login"></input>	  

						<div class="bottom">
 	 	<li class = "dropdown ">				
			  <a class="dropdown-toggle" 
			  data-toggle="dropdown" href="#"> 
			  	Register <span class="caret"></span>
			  </a>
			   <ul class = "dropdown-menu">
      	<li><a href="#myModalteacher"   data-toggle="modal">As teacher</a></li> 
		<li><a href="#myModalstudent"  data-toggle="modal">As Student</a></li> 
		<li><a href="#myModalparent"  data-toggle="modal">As Parent/Sponsor</a></li> 				 
			    </ul>
			</li>                  
		<!--  -->
	 							</div>
							</div>						 
						</div>			
					</form>					 
				</div>
				<div class="clear"></div>
			</div>
			 
		</div>


<!-- for teacher -->
 			<div id="myModalteacher" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">					 
						<div class="modal-body">
							<div class = "row">
								<div class = "col-lg-2 col-md-2 col-sm-12 col-xs-12">
								</div>
								<div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 alert alert-warning">
									<h1><center>Teacher</center></h1>

						 <form method = "POST" action = "teacher_register.php">
							<p class = "text-info">Name:</p>
							<input class = "form-control" required  title = "This is your name as Teacher. for example Madam. Hawa Namata" type = "text" name = "name_of_teacher">
						 					
							<p class = "text-info">Set Username:</p>
							<input class = "form-control" required type = "text" 
							name = "teacher_username" title = "this can be any text that you can not forget">
							
							<p class = "text-info">Set Password</p>
							<input class = "form-control" required type = "password" name = "teacher_password">
							<p class = "text-info">Comfirm Password</p>
							<input class = "form-control" required type = "password" name = "comfirm_teacher_password">
						    <p class = "text-info">Activation Key</p>
							<input class = "form-control" required title = "This activation key was given to you by the developer." type = "password" name = "teacher_activation">										 
						    <br><input type = "submit" value = "Register" class = "btn btn-primary btn-block">
						<p class = "text-danger">
							 			
						</p>
				</form> 
			</div>
			<div class = "col-lg-2 col-md-2 col-sm-12 col-xs-12">
			</div>
		</div>
		</div>
	</div>
</div>
</div>

		  				 						 
					 
			 

<!-- for student -->
			<div id="myModalstudent" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">						 
						<div class="modal-body">
							<div class = "row">
								<div class = "col-lg-2 col-md-2 col-sm-12 col-xs-12">
								</div>
								<div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 alert alert-warning">
					 <h1><center>Student</center></h1>
						 <form method = "POST" action = "student_sign_up.php">
 							 			
							<p class = "text-info">Set Username:</p>
							<input class = "form-control" required type = "text" 
							name = "student_username" title = "this can be any text that you can not forget">
							
							<p class = "text-info">Set Password</p>
							<input class = "form-control" required type = "password" 
							name = "student_password">
							<p class = "text-info">Comfirm Password</p>
							<input class = "form-control" required type = "password" name = "comfirm_student_password">
						    <p class = "text-info">Your Number</p>
							<input class = "form-control" required title = "You can get this key from the school administrator" type = "text" name = "student_number">										 
						    <br><input type = "submit" value = "Register" class = "btn btn-primary btn-block">
						<p class = "text-danger">
							 			
						</p>
				</form>



								</div>
								<div class = "col-lg-2 col-md-2 col-sm-12 col-xs-12">
								</div>
							</div>
							 
						</div>
						 
					</div>
				</div>
			</div>

<!-- for parent -->
			
			<div id="myModalparent" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
 
						<div class="modal-body">

				 <div class = "row">
					<div class = "col-lg-1 col-md-1 col-sm-12 col-xs-12">
					</div>
					<div class = "col-lg-10 col-md-10 col-sm-12 col-xs-12 alert alert-warning">
						<h1><center>Sponsor/Parent</center></h1>
						 <form method = "POST" action = "parent_register.php">	

						 <p class = "text-info">Your Child's Number.</p>
							<input class = "form-control" required type = "text" 
							name = "studentNumber" title = "this can be any text that you can not forget">				 				
							<p class = "text-info">Set Username:</p>
							<input class = "form-control" required type = "text" 
							name = "parent_username" title = "this can be any text that you can not forget">				
							<p class = "text-info">Set Password</p>
							<input class = "form-control" required type = "password" name = "parent_password">

							<p class = "text-info">Comfirm Password</p>
							<input class = "form-control" required type = "password" name = "comfirm_parent_password">
						    <p class = "text-info">Activation Key</p>
							<input class = "form-control" required title = "This activation key was given to you by the administrators when you registred your child. if you do not have it, you can call the school administrator." type = "password" name = "key">										 
						    <br><input type = "submit" value = "Register" class = "btn btn-primary btn-block">
						<p class = "text-danger">
							 			
						</p>
				</form> 
			</div>
			<div class = "col-lg-1 col-md-1 col-sm-12 col-xs-12">
			</div>
		</div>



 						</div>
						 
					</div>
				</div>
			</div>



 

       
    </body>
</html>