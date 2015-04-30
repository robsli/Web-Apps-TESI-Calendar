<?php
// Starting Session
//session_start();
//include('include/dbconn.php');
include('login.php');


	$dbc= connectToDB("lifm");

	$user_check=$_SESSION['userlogin'];
	// SQL Query To Fetch Complete Information Of User
	$query = "SELECT * from TESI_MEMBERSHIP where email = '$user_check'"; 
	$result = performQuery($dbc, $query);
	while (@extract(mysqli_fetch_array($result, MYSQLI_ASSOC))) {
			$login_session =$email;
			$name = $firstname." ".$lastname;
			$type = $membershiptype;
			$_SESSION['name'] = $name;
			$_SESSION['type'] = $type;
	 }
	if(!isset($login_session)){
		disconnectFromDB($dbc, $result); // Closing Connection
		header('Location: index.php'); // Redirecting To Home Page
	}
?>