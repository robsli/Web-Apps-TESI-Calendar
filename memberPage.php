<?php 
	session_start();
	include 'navbar.php';
	include 'calendarops.php';
	include 'dboperation.php';
?>	
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Member Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
<?php
	displayNavbar();
	
	if (isset($_POST['changepw']))
		handleChangePassForm();
?>
<!-- Beginning of Content in Body-->
	<div class="container">
	
		<?php

		$id = isset($_SESSION['id'])?$_SESSION['id']:"error: not logged in";
		$name = isset($_SESSION['firstname'])?$_SESSION['firstname']:"error: not logged in";
		echo "<h2>$name's Profile Page</h2>
		<br>
		<h4>Account Settings</h4>";
		
		?>
	
	<a href="changePassForm.php">Change Password</a>
	<br>
	<a href="#">Delete Account</a>
	<br><br>
	<h4>Profile</h4>
	<?php
		$dbc = connectToDB("lifm", "qmJriism", "lifm");
		$query1 = "select * from TESI_MEMBERSHIP where ID = $id";
		$result1 = mysqli_query($dbc, $query1);
		$rows = mysqli_num_rows($result1);
	    if ($rows == 1) {
     		 $row = mysqli_fetch_assoc($result1);
     		 $email = $row['email'];
     		 $firstname = $row['firstname'];
     		 $date = $row['registrationdate'];
     		 $lastname = $row['lastname'];
     		 $school = $row['school'];
     		 $class = $row['classyear'];
     		 $major = $row['major'];
			 $type = $row['membershiptype'];
			 
			echo "<table id='profile' class='table'>";
			 echo "<tr><td><b>Name </b></td><td>$firstname $lastname</td></tr>";
			 echo "<tr><td><b>Member Since </b></td><td>$date</td></tr>";
			 echo "<tr><td><b>School </b></td><td>$school</td></tr>";
			 echo "<tr><td><b>Class </b></td><td>$class</td></tr>";
			 echo "<tr><td><b>Major </b></td><td>$major</td></tr>";
			 echo "<tr><td><b>Membership Type </b></td><td>$type</td></tr>";
			echo "</table>";
		}

	?>
		<br><br>
		<h4>Events you've signed up for</h4>
	<?php
		$query2 = "select *
					from TESI_ATTENDANCE a
					join TESI_EVENTS e
					on a.eventID = e.ID
					and memberID = $id
					order by 3 asc";
		$result2 = mysqli_query($dbc, $query2);
		echo "<table id = 'eventsAttending' class='table table-striped'>";
		echo"<tr>
			<th>Event</th>
			<th>Location</th>
			<th>Date</th>
			<th>Start Time</th>
			<th>Status</th></tr>";
		while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			echo "<tbody>";
			echo "<tr><td>" . $row['title'] . "</td><td>" . $row['location'] . "</td>
					  <td>" . $row['dateofvisit'] . "</td><td>" . $row['starttime'] . "</td>
					  <td>" . $row['status'] . "</td></tr>";
			echo "</tbody>";  
		}


	?>
	</div>
	
</body>