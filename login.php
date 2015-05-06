<?php
include('include/dbconn.php');

if (isset($_POST['login'])) {
   handleLoginForm();
   }
if (isset($_POST['resetpw'])) {
   handleForgotForm();
   }
if (isset($_POST['changepw'])) {
   handleChangePassForm();
   }
   
 
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
     		$email = $row['email'];
     		$firstname = $row['firstname'];
			$type = $row['membershiptype'];
			$id = $row['ID'];
     		 
			session_start();
      		//Store the email in the session
      		$_SESSION['userlogin'] = $email;
      		 
      		//Store the name in the session.
      		$_SESSION['firstname'] = $firstname;
			 
			$_SESSION['memtype'] = $type;
			$_SESSION['id'] = $id;
      		 
      		header("Location: index.php");
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



function emailNOvalid ($email){  //test to see if the email already exists (false)

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
	$query= "UPDATE TESI_MEMBERSHIP SET PASSWORD= '$hiddenpw' WHERE email='$emailValidate'";
	$result = performQuery ($dbc, $query);

	$to= $emailValidate;
	$subject= 'New Password';
	$body= 'Your new password is '.$newPW;
	$headers= 'From: mikamia@bc.edu';

	if (mail($to, $subject, $body, $headers))
			echo "Your new password has been sent to $emailValidate!
			<br><a href='index.php'>Return to main page</a>";
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

?>
