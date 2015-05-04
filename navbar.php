<?php

function displayNavbar() {
?>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
		<div class="row">	
		<div class="col-md-6">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">T E S I</a>
			</div>
			
		  	<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="viewEvents.php">Events</a></li>
				<li><a href="news.php">News</a></li>
		   	</ul>
		</div>
		<div class="col-md-6">
			<ul class="nav navbar-nav navbar-right">
					<?php 
					$user = isset($_SESSION['firstname'])? $_SESSION['firstname']:"error";
					$type = isset($_SESSION['memtype'])? $_SESSION['memtype']:"error";
					if (isset($_SESSION['firstname']) AND ($type == 'admin')) {
						echo "<li><a href='addEventForm.php'>Add Event</a></li>";
						echo "<li><a href='managerForm.php'>Manage Events</a></li>";
						echo "<li><a href='adminform.php'>Admin</a></li>";
					} else if (isset($_SESSION['firstname']) AND ($type == 'manager')) {
						echo "<li><a href='addEventForm.php'>Add Event</a></li>";
						echo "<li><a href='#'>Manage Events</a></li>";
					} else if (isset($_SESSION['firstname'])) {
						echo "<li><a href='#'>Member Page</a></li>";
					} else 
						echo "<li><a href='joinform.php'>Sign Up</a></li>";
					?>	
				<li><?php 
					if (isset($_SESSION['firstname'])){
					   echo"<a href='logout.php'>Logout</a>";
					} else {
					   echo "<a href='#loginModal' data-toggle='modal' data-target='#loginModal'>LogIn</a>"; 
					   }
					?>
				</li>
		  	</ul>
		</div>
		</div>	  
		</div>
	</nav>
	
	<!-- Modal -->
	<div id="loginModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Log In</h4>
		</div>
		<div class="modal-body">
			<form method='POST' action='login.php'>
			<h3>Log In</h3> 
				BC Email Address:<br>
				<input type='text' name='u' value=''/>
				<br>Password:<br>
				<input type='password' name='pw' value=''/>
				<br><br>
				<input class="btn btn-warning" type='submit' name='login' value='Log In'/>
			</form>
			<h3>Forgot Password?</h3> 
			<p>Forgot Password? Enter email address below to have a new password be sent to you.</p>
			<p><form method='POST' action='login.php'>
			<input type='text' name='email' placeholder = 'Enter BC Email Address'/>
			<br><br>
			<input type='submit' class="btn btn-danger" name='resetpw' value='Reset Password'/>
			</form></p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div>
	<!-- End of Modal-->
<?php
}
?>