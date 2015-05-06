<?php		
	header('Location: index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
</head>

<body>
<?php		
	header('Location: viewEvents.php');
	include 'dboperation.php';
	$classArray = array("2015","2016","2017","2018");

	$dbc = connecttoDB("lifm", "qmJriism", "lifm");
	if ( isset($_POST['addMember']) ){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = sha1($_POST['password']);
		$school = $_POST['school'];
		$major = $_POST['major'];
		$class = $_POST['class'];
	}
	
	//echo "Major is: " . $major;
	
	$selectQuery = "SELECT email FROM TESI_MEMBERSHIP where email = '$email'";
	$selectResult = mysqli_query($dbc, $selectQuery);
	$rows = mysqli_num_rows($selectResult);
	mysqli_free_result($selectResult);
	
	if ($rows==0){
		$insertQuery = "INSERT INTO TESI_MEMBERSHIP(firstname, lastname, email, password, 
		registrationdate, school, major, classyear, membershiptype)
		VALUES ('$firstname', '$lastname', '$email', sha1('$password'), now(), 
		'$school', '$major', $class,'general')";
		//echo "Query: $query <br>";
		
		//$trimQuery = "UPDATE TESI_MEMBERSHIP set major = TRIM(major)";
		//$trimResult = mysqli_query($dbc, $trimQuery);

		$insertResult = mysqli_query($dbc, $insertQuery);
		/*
		if ($insertResult){
			returnHome();
			echo "Record was added. Thank you!";
		}
		else{
			goBack();
			die('Invalid query: $insertQuery'. mysqli_error($dbc));
		}	
		*/
	}
	else{
		goBack();
		die('Email already exists within the database');
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

?>