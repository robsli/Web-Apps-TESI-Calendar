<?php 
session_start();
include('include/dbconn.php');
?>	
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Home</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
<?php
	include ('navbar.php');
	include ('calendarops.php');
	displayNavbar();
	
	if (isset($_POST['changepw']))
		handleChangePassForm();
?>
<!-- Beginning of Content in Body-->
	<div class="container">
	<h1>Change Password</h1>
	<?php
	if (!isset($_SESSION['userlogin'])){
		
	echo "<p>Please log in first! </p>";
	
	
	}
	else {
    ?>
	<form class="form-horizontal" method="post">
		<div class="control-group">
		<label class="control-label" for="inputPassword">Old Password</label>
		<div class="controls">
		  <input type="password" name="oldPw" placeholder="Old Password">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">New Password</label>
		<div class="controls">
		  <input type="password" name="newPw" placeholder="New Password">
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="inputPassword">New Password Confirm</label>
		<div class="controls">
		  <input type="password" name="newPwAgain" placeholder="New Password Again">
		</div>
		</div>
		<br>
		<div class="control-group">
		<div class="controls">
		   <input class="btn btn-default" type = 'submit' name = 'changepw' value ='Change Password'/>
		</div>
		</div>
		
		  
		 
		</div>
		</div>
	</form>
	
	
	</div>
	<?php
	}
	?>
</body>
</html>
<?php
function handleChangePassForm() {
    $email = $_SESSION['userlogin'];
    $new1 = isset($_POST['newPw'])? sha1(sha1($_POST['newPw'])):"error";
    $new2 = isset($_POST['newPwAgain'])? sha1(sha1($_POST['newPwAgain'])):"error";
    if ( $new1 == $new2){
		$dbc= connectToDB("lifm");
		$old = isset($_POST['oldPw'])? sha1(sha1($_POST['oldPw'])):"error";
		$dbc= connectToDB("lifm");
		$query= "SELECT * FROM `TESI_MEMBERSHIP` where PASSWORD ='$old'";
		$result= performQuery ($dbc, $query);
		$row=mysqli_num_rows($result);
		
		if ($row!=0) {
			$query= "UPDATE TESI_MEMBERSHIP SET PASSWORD= '$new1' WHERE email='$email'";
			$result = performQuery ($dbc, $query);
			echo "Password has been changed!";
		}
	} else {
	   echo "The new password and new password confirm does not match. Please try re-entering it again.";
	}
	
}
?>