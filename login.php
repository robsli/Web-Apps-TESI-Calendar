<?php
include('include/dbconn.php');

if (isset($_POST['login'])) {
   handleLoginForm();
   }
else if (isset($_POST['resetpw'])){
	handleForgotForm();
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
     		 $type = $row['membershiptype'];
			 session_start();
      		 //Store the name in the session
      		 $_SESSION['userlogin'] = $name;
      		 $_SESSION['usertype'] = $type;
      		header("Location: index.php");
      		exit;
         }
          else{ 
             echo "The combination of the login and password do not match 1 ";
          } 
          disconnectFromDB($dbc, $result);
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
function handleForgotForm() {
	$emailValidate = $_POST['email'];
	$val = emailExists($emailValidate);
	
	if ($val != 1) {
	    
		echo "This email does not exist. Please try again. 
		<br><a href='index.php'>Retry</a>";
	   
	    return;
	}
	$newPW = createpw();
	$hiddenpw= sha1(sha1($newPW));
	
	$dbc= connectToDB("lifm");
	$query= "UPDATE TESI_MEMBERSHIP SET Password= '$hiddenpw' WHERE email='$emailValidate'";
	$result = performQuery ($dbc, $query);

	$to= $emailValidate;
	$subject= 'New Password';
	$message = "Your new password is ".$newPW.". Please go to the website and log in with this password. After you log in you can change it to something else.";
	$body= $message;
	$headers= 'From: mikamia@bc.edu';

	if (mail($to, $subject, $body, $headers))
			echo "Your new password has been sent to $emailValidate";
	else
		echo "Mail was NOT sent";
	
}


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
/*
function handleUpdatepw(){
  $oldpw = isset($_POST['current'])? sha1(sha1($_POST['current'])) : '';
  $new1 = isset($_POST['new1'])? $_POST['new1'] : '';
  $new2 = isset($_POST['new2'])? $_POST['new2'] : '';
  $user = $_SESSION['userlogin'];
  echo "user is $user";
  
  if (passwordsNOmatch($new1,$new2)){
  	echo "New password and new password again does not match.";
  	return;
  }
  /*
  $dbc= connectToDB("lifm");
  $query = "SELECT * from TESI_MEMBERSHIP where email = '$user' AND PASSWORD = '$oldpw'"; 
  $result = performQuery($dbc, $query);
  if (mysqli_num_rows($result) == 1) {
	$query= "UPDATE TESI_MEMBERSHIP SET Password= 'sha1(sha1($new1')) WHERE email='$user'"; 
    $result = performQuery($dbc, $query);
  } else{ 
	  echo "The old password you entered was incorrect. Please try again.";
  } 
  */



?>
