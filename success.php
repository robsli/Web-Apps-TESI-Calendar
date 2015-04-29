<?php
session_start();
include('session.php');

 print_r($_SESSION);
 $user = $_SESSION['name'];
 echo "<br>hello $user, you have successfully logged in";
 ?>
 <form method='POST' action='logout.php'>
			<input type = 'submit' name='logout' value='Log Out'/>
		</form>
