<?php
include('include/dbconn.php');

if (isset($_POST['login'])) {
   handleLoginForm();
   }
   
   
/*function handleForm () {
	$response = handleLoginForm();
	if ( $response == true ) {	
			header("Location: profile.php");
		} else {
			header("Location: index.php?status=badlogin");
		}

}
*/
 
/*
CREATE TABLE TESI_MEMBERSHIP(
firstname VARCHAR(40),
lastname VARCHAR(40),
email VARCHAR(50),
PASSWORD VARCHAR(40),
registrationdate DATETIME,
school VARCHAR(40),
major VARCHAR(40),
classyear INT(4),
membershiptype enum('general', 'admin')
);
*/



function handleLoginForm(){
    $login = isset($_POST['u'])?$_POST['u']:"error";
	if (emailExists($login)){
		$dbc= connectToDB("lifm");
		$pw = isset($_POST['pw'])? sha1(sha1($_POST['pw'])):"error";
		$query = "SELECT * from TESI_MEMBERSHIP where email = '$login' AND PASSWORD = '$pw'"; 
		$result = performQuery($dbc, $query);
	    if (mysqli_num_rows($result) == 1) {
     		 $row = mysqli_fetch_assoc($result);
     		 $name = $row['email'];
     		 
			 session_start();
      		 //Store the name in the session
      		 $_SESSION['userlogin'] = $name;
      		header("Location: success.php");
         }
          else{ 
             echo "The combination of the login and password do not match 1 ";
          } 
	} else {
	     echo "The combination of the login and password do not match 2";
	}
	
}


function passwordsNOmatch($pw1, $pw2){

	if ($pw1 != $pw2) {
		//echo "Password does not match <br />
		//<a href='http://cscilab.bc.edu/~mikamia/hw12a/index.php?showjoin=Join+the+Club'>Retry</a>";
		return false;
	}

	return true;

}

function emailExists($email){

	$dbc= connectToDB("lifm");
	$query= "SELECT * FROM `TESI_MEMBERSHIP` where email='$email'";
	$result= performQuery ($dbc, $query);
	$row=mysqli_num_rows($result);
	
	if ($row==0) {
		return 0;
	}

	return 1;
}


/*
function emailNOvalid ($email){

	$dbc= connectToDB("lifm");
	$query= "SELECT * FROM `TESI_MEMBERSHIP` where `email`='$email'";
	$result= performQuery ($dbc, $query);
	$row=mysqli_num_rows($result);

	if ($row!=0) {
		echo "E-mail address entered already exists
		<br><a href='http://cscilab.bc.edu/~mikamia/hw12a/index.php?showjoin=Join+the+Club'>Retry</a>";
		return false;
	}
	
	

	return true;
}


function handleJoinForm () {
	if ((passwordsNOmatch($_POST['password'],$_POST['passwordagain']))&&

	(emailNOvalid($_POST['email']))) {
	insertmember();
	
	echo "Thank you! Your registration was successful";
	echo "<br><br>
		<a href='http://cscilab.bc.edu/~mikamia/hw12a/index.php'>Back to Main</a>";

	}

}
*/

/*
function insertmember() {

	$name= $_POST['name'];
	$email= $_POST['email'];
	$password= $_POST['password'];
	$membership= $_POST['memberType'];

	$dbc= connectToDB("mikamia");
	$query= "insert into myClub(Name, Email, Password, RegistrationDate, MembershipType) values('$name', '$email', sha1('$password'), now(), '$membership')";
	$result= mysqli_query($dbc, $query) or
		die ('Invalid query: $query '. mysqli_error($dbc));



}

function handleForgotForm() {
	$emailValidate = $_POST['emailforget'];
	$val = emailExists($emailValidate);
	
	if ($val != 1) {
	    
		echo "This email does not exist. Please try again. 
		<br><a href='http://cscilab.bc.edu/~mikamia/hw12a/index.php?forgotpw=Forgot+Password'>Retry</a>";
	   
	    return;
	}
	$newPW = createpw();
	$hiddenpw= sha1($newPW);
	
	$dbc= connectToDB("mikamia");
	$query= "UPDATE myClub SET Password= '$hiddenpw' WHERE Email='$emailValidate'";
	$result = performQuery ($dbc, $query);

	$to= $emailValidate;
	$subject= 'New Password';
	$body= $newPW;
	$headers= 'From: mikamia@bc.edu';

	if (mail($to, $subject, $body, $headers))
			echo "Your new password has been sent to $emailValidate";
	else
		echo "Mail was NOT sent";
	
}
*/


/*
function createpw() {
	$password="";

	$possible="23456789abcdefghjklmnpwrstuvwxyz";

	$password="";
	$length=8;

	for ($i=1; $i<=$length; $i++){
		$pick=rand(0, strlen($possible)-1);

		$passchar=substr($possible, $pick, 1);

		$password .= $passchar;
	}
	return $password;
}
*/
?>
