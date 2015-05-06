<?php
	header('Location: viewEvents.php');
	session_start();
	include 'dboperation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>RSVP</title>
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="joinscript.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
	<?php
	$id = $_SESSION['id'];
	$calid = $_POST['gcalid'];

	rsvp($id, $calid);
	?>
	
	
	
</body>
</html>

<?php

	
function rsvp($id, $calid) {
	$dbc = connectToDB("lifm", "qmJriism", "lifm");

	//Get Event ID
	$eventQuery = "select ID from TESI_EVENTS where eventID = '$calid'";

	$eventResult = mysqli_query($dbc, $eventQuery);
	$row = mysqli_fetch_array($eventResult, MYSQLI_ASSOC);
	$eventID = $row['ID'];
	
	$checkQuery = "select * from TESI_ATTENDANCE where memberID = $id and eventID = $eventID";
	$checkResults = mysqli_query($dbc, $checkQuery);
	$checkRows = mysqli_num_rows($checkResults);
	
	if ($checkRows == 0) {
		$query = "insert into TESI_ATTENDANCE values (DEFAULT, $id, $eventID, 'a', sysdate())";
		$results = mysqli_query($dbc, $query);
	}
}

?>