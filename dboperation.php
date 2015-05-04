<?php
function connectToDB($user, $pw, $dbname){
		$dbc = @mysqli_connect("localhost", $user, $pw, $dbname) 
		OR die("Could not connect to MySQL on cscilab: ".	mysqli_connect_error());
		return $dbc;
}

?>