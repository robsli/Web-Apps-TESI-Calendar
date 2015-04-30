<?php
session_start();
//include('login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home Page</title>
	<link rel='stylesheet' type='text/css' href='tesihome.css'/>


</head>

<body>

<?php
 
 
 print_r($_SESSION);
 $user = $_SESSION['userlogin'];
 $type = $_SESSION['usertype'];
 echo "<br>hello $user, you have successfully logged in";
 ?>
<form method='POST'>
<input type = 'submit' name='changepw' value='Change Password'/><br>
</form>

 <form method='POST' action='logout.php'>
	<input type = 'submit' name='logout' value='Log Out'/>
 </form>
 <?php
 if (isset($_POST['changepw'])){
 	displayUpdatepw();
 	}
 ?>
</body>

</html>

<?php
function displayUpdatepw() {
?>
	 <form method='POST' action='login.php'>
		Current Password: 
		<br>
		<input type='password' name='current' value=''/>
		<br>
		New Password: 
		<br>
		<input type='password' name='new1' value=''/>
		<br>
		Type New Password Again: 
		<br>
		<input type='password' name='new2' value=''/> 
		<br>
		<input type='submit' name='submit' value='Submit'/>
     </form>
     <?php

}


?>