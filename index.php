<?php 
session_start();
?>
<!-- Web Applications Project
  --
  -- Contributors: Robbie Li, Ayako Mikami, Jonathan Ho
  --
  -- index.php
  -->	
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home Page</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
 <form method='POST' action='logout.php'>
	<input type = 'submit' name='logout' value='Log Out'/>
 </form>
		<nav class="navbar navbar-default">
		<div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.php">T E S I</a>
		</div>
		<div>
		  <ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="joinform.php">Sign Up</a></li>
			<li><a href="viewCalendar.php">Events</a></li>
			<li><a href="#">News</a></li>
			
		  </ul>
		</div>
		</div>
		</nav>
		
		
	<div class="container">
		<div class="jumbotron">
			<h1 class="text-center">T E S I</h1>
			<p class="text-center">Boston College Technology, Entrepreneurship, and Social Innovation</p>
			<?php 
			$user = isset($_SESSION['userlogin'])? $_SESSION['usertype']:"error";
 			echo "<p>hello $user, you have successfully logged in</p>";
 			?>
		</div>
		<div class="row">
			<div class="col-sm-4">
			  <h3>Upcoming Event</h3>
			    <h4>MIT Media Lab</h4>
			     <p><b>Friday, May 1st 2-5pm</b></p>
						  <!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Learn More</button>

				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">MIT Media Lab</h4>
				  </div>
				  <div class="modal-body">
				    <img src="images/mit_logo.png" class="img-responsive" alt="mit_logo"/>
					<p>The MIT Media Lab is a multi-disciplinary lab with research groups focusing in on the edges and future of technology and design. Students will tour the facilities and see the following research groups/demos: Lifelong Kindergarten, cityFARM, and Viral Communications. The MIT Media Lab is the home and birthplace of successes like Guitar Hero, Echonest, Processing, Scratch, Lego Mindstorms, and the bionic prosthetics that allowed Boston bombing survivor Adrianne Haslet Davis to dance again.</p>
				    <p><a href ='http://www.media.mit.edu/' onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;">View Website</a></p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

				</div>
				</div>
			 
			  <button type="button" class="btn btn-primary">RSVP</button>
			</div>
			<div class="col-sm-4">
			  <h3>Log In</h3>
				<p><form method='POST' action='login.php'>
					BC Email Address:<br>
					<input type='text' name='u' value=''/>
					<br>Password:<br>
					<input type='password' name='pw' value=''/>
					<br><br>
					<input class="btn btn-warning" type='submit' name='login' value='Log In'/>
			    </form></p>
			  
			</div>
			<div class="col-sm-4">
			  <h3>Forgot Password?</h3> 
			  <p>Forgot Password? Enter email address below to have a new password be sent to you.</p>
		
			  <p><form method='POST' action='login.php'>
					<input type='text' name='email' value='Enter BC Email Address'/>
					<br><br>
					<input type='submit' class="btn btn-danger" name='resetpw' value='Reset Password'/>
			  </form></p>
			
			</div>
		</div>
	</div>
		
		<br><br>

   
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>


</body>

</html>
