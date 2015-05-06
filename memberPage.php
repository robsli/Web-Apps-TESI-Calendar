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
	
	<?php
	$id = isset($_SESSION['userlogin'])?$_SESSION['userlogin']:"error: not logged in";
	$name = isset($_SESSION['firstname'])?$_SESSION['firstname']:"error: not logged in";
	echo "<h2>Hello $name! This is your profile page</h2>
	<br>
	<h4>Account Settings</h4>";
	
	?>
	
	<a href="changePassForm.php">Change Password</a>
	<br>
	<a href="#">Delete Account</a>
	<br><br>
	<h4>Profile</h4>
	<?php
		$dbc= connectToDB("lifm");
		$query1 = "SELECT * from TESI_MEMBERSHIP where email = '$id'"; 
		$result1 = performQuery($dbc, $query1);
	    if (mysqli_num_rows($result1) == 1) {
     		 $row = mysqli_fetch_assoc($result);
     		 $email = $row['email'];
     		 $firstname = $row['firstname'];
     		 $date = $row['registrationdate'];
     		 $lastname = $row['lastname'];
     		 $school = $row['school'];
     		 $class = $row['classyear'];
     		 $major = $row['major'];
			 $type = $row['membershiptype'];
		}
			 echo "Name: $firstname $lastname<br>";
			 echo "Meber Since: $date<br>";
			 echo "School: $school<br>";
			 echo "Class: $class<br>";
			 echo "Major: $major<br>";
			 echo "Membership Type: $type<br>";
		
		//$query2 = "select event_name from TESI_EVENTS e, TESI_ATTENDANCE a where e.id = a.id and a.memberID = $id"; 
		$query2 = "select * from TESI_EVENTS e
					join
					TESI_ATTENDANCE a
					where e.id = a.id
					and a.memberID = $id";
		$result2 = performQuery($dbc, $query2);
	    if (mysqli_num_rows($result2) != 0) {
	    	print_r($result2);
	    }
			 ?>
			 <br><br>
	  <h4>Events You Signed up For</h4>
	  
	  
	</div>
	
</body>

<?php
/*
Steps: 1. Find user id ($id = $_SESSION['id'])
2. List events user is going to:

Query:

select event_name
from TESI_EVENTS e, TESI_ATTENDANCE a
where e.id = a.id
and a.memberID = $id
*/
?>