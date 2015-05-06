<?php
	header('Location: viewEvents.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
</head>

<body>
<?php		
	include ('dboperation.php');
	include ('calendarops.php');
	
	$dbc = connecttoDB("lifm", "qmJriism", "lifm");
	if ( isset($_POST['changerecord']) ){
		$ID = $_POST['ID'];
		$club = $_POST['club'];
		$title = $_POST['title'];
		$location = $_POST['location'];
		$date = $_POST['date'];
		$starttime = $_POST['starttime'];
		$endtime = $_POST['endtime'];
		$eventID = $_POST['eventID'];
	}
	
	$selectQuery = "SELECT* FROM TESI_EVENTS where ID = '$ID'";
	$selectResult = mysqli_query($dbc, $selectQuery);
	$rows = mysqli_num_rows($selectResult);
	mysqli_free_result($selectResult);
	
	if ($rows){
		$updateQuery = "UPDATE TESI_EVENTS SET club='$club', title='$title',
		location='$location', dateofvisit='$date', starttime='$starttime', endtime='$endtime'
		WHERE ID='$ID'";
		
		$updateResult = mysqli_query($dbc, $updateQuery);
		updateEvent($summary, $location, $startTime, $endTime, $ID);
	}
	mysqli_close($dbc);	
	?>
</body>
</html>

<?php
function returnHome(){
	echo" <form action='index.php'>
	<input type='submit' value='Home'></form><br>";
}

function goBack(){
	echo"<button type='button' onclick='history.back();'>Try Again</button><br><br>";
}

function connectToDB($user, $pw, $dbname){
		$dbc = @mysqli_connect("localhost", $user, $pw, $dbname) 
		OR die("Could not connect to MySQL on cscilab: ".	mysqli_connect_error());
		return $dbc;
}