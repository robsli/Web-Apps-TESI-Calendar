<?php 
session_start();
?>	
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
<?php
	include ('navbar.php');
	displayNavbar();
?>

	<!-- Beginning of Content in Body-->
	<div class="container">
		<div class="jumbotron">
			<h1 class="text-center">T E S I</h1>
			<p class="text-center">Boston College Technology, Entrepreneurship, and Social Innovation</p>
			<?php 
			$user = isset($_SESSION['firstname'])? $_SESSION['firstname']:"error";
 			if(isset($_SESSION['firstname']))
 				echo "<p class='text-center'>Hello $user, you are logged in.</p>";
 			?>
		</div>
		<h3 class="text-center">Upcoming Events</h3><br>
		<div class="row">
		  <div class="col-md-4">
			
			<img src="images/mit_event.jpg" class="img-responsive" alt="mit_logo"/>
			</div>
			<div class="col-md-2">
					<h4>MIT Media Lab</h4>
					 <p><b>Friday, May 1st 2-5pm</b></p>
							  <!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Learn More</button>
					<br><br>
					<?php 
					if(isset($_SESSION['firstname']))
						echo "<button type='button' class='btn btn-primary'>RSVP</button>";
					else 
						echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#loginModal'>Log In to RSVP</button>";
					?>
			</div>
			<div class="col-md-4">
			<img src="images/google_event.jpg" class="img-responsive" alt="mit_logo"/>
			</div>
			<div class="col-md-2">
			 <h4>Google Cambridge</h4>
					 <p><b>Friday, September 25th 2-5pm</b></p>
							  <!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Learn More</button>
					<br><br>
					<?php 
					if(isset($_SESSION['firstname']))
						echo "<button type='button' class='btn btn-primary'>RSVP</button>";
					else 
						echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#loginModal'>Log In to RSVP</button>";
					?>
			</div>
	
		
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
			  <!-- End of Modal -->
			  
			</div>

			
	
	</div>
		
		<br><br>

   
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>


</body>

</html>
