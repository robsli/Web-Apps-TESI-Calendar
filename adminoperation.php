<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
</head>

<body>
<?php		
	$classArray = array("2015","2016","2017","2018");

	$dbc = connecttoDB("lifm", "qmJriism", "lifm");
	if ( isset($_POST['changerecord']) ){
		$ID = $_POST['ID'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$school = $_POST['school'];
		$major = $_POST['major'];
		$class = $_POST['class'];
		$membershiptype = $_POST['membershiptype'];
	}
	
	//echo "Major is: " . $major;
	
	$selectQuery = "SELECT* FROM TESI_MEMBERSHIP where ID = '$ID'";
	$selectResult = mysqli_query($dbc, $selectQuery);
	$rows = mysqli_num_rows($selectResult);
	mysqli_free_result($selectResult);
	
	if ($rows){
		$updateQuery = "UPDATE TESI_MEMBERSHIP SET firstname='$firstname', lastname='$lastname',
		email='$email', school='$school', major='$major', classyear='$class', membershiptype='$membershiptype'
		WHERE ID='$ID'";

		//echo "Query: $query <br>";
		
		//$trimQuery = "UPDATE TESI_MEMBERSHIP set major = TRIM(major)";
		//$trimResult = mysqli_query($dbc, $trimQuery);

		$updateResult = mysqli_query($dbc, $updateQuery);
		
		if ($updateResult){
			returnHome();
			echo "Record was edited. Thank you!";
		}
		else{
			goBack();
			die('Invalid query: $updateQuery'. mysqli_error($dbc));
		}	
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