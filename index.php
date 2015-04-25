<!-- Web Applications Project
  --
  -- Contributors: Robbie Li, Ayako Mikami, Jonathan Ho
  --
  -- index.php
  -->
<?php 


?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home Page</title>
	<link rel='stylesheet' type='text/css' href='tesihome.css'/>


</head>

<body>
	<div>
	<div id='homeleft'>
		<h1>Menu</h1>
		<br><br>
		<form type='get' action='joinform.php'>
			<input class='menubutton' type='submit' name='joinlistserv' value='Join Listserv!'/>
		</form>
		<form type='get' action='calendarops.php'>
			<br><br><br><br>
			<input class='menubutton' type='submit' name='eventcal' value='Event Calendar'/>
		</form>
		<form type='get'>
			<br><br><br><br>
			<input class='menubutton' type='submit' name='news' value='Tech News'/>
		</form>
		<form type='get'>
			<br><br><br><br>
			<input class='menubutton' type='submit' name='about' value='About'/>
			<br><br><br><br>
		</form>
		<form method='POST' action='login.php'>
			<b>Log In</b><br>
			BC Email Address:<br>
			<input type='text' name='u' value=''/>
			<br>Password:<br>
			<input type='password' name='pw' value=''/>
			<input type='submit' name='login' value='Log In'/>
			<br><br><br><br>
		</form>
		<br>
		
		<br><br>
		Forgot Password? Enter email address below to have a new password be sent to you.
		<br><br>
		<form type='get'>
			<input type='text' name='email' value='Enter BC Email Address'/>
			<input type='submit' name='resetpw' value='Reset Password'/>
			<br><br><br><br>
		</form>
		
	</div>
	<div id='homeright'>
		<h1>Welcome to the Boston College Technology, Entrepreneurship, and Social Innovation Calendar</h1>
		<br><br>
		<ul>List of Contributors:
			<li> Robbie Li </li>
			<li> Ayako Mikami </li>
			<li> Jonathan Ho </li>
		</ul>
		<br><br>

	</div>
	</div>


</body>

</html>
