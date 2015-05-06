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
	<h1> Member Page</h1>
	<a href="changePassForm.php">Change Password</a>
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