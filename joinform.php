<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home Page</title>
    <script src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="joinscript.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/yeti/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
		<nav class="navbar navbar-default">
		<div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="index.php">T E S I</a>
		</div>
		<div>
		  <ul class="nav navbar-nav">
			<li><a href="index.php">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="joinform.php">Sign Up</a></li>
			<li><a href="viewCalendar.php">Events</a></li>
			<li><a href="#">News</a></li>
			<li><a href="#">Member Page</a></li>
			
		  </ul>
		</div>
		</div>
		</nav>
		

<?php

	$collegeMajorArray = 
		array(
			"Carroll School of Management" =>
				"Accounting, Information Systems, Business Analytics, 
				Corporate Reporting and Analysis, Computer Science, Economics, Finance, 
				General Management, Information Systems, Management and Leadership, 
				Marketing, Operations Management",
				
			"College of Arts and Sciences" =>
				"Art, History, Biochemistry, Biology, Chemistry, Classical Studies, Communication, 
				Computer Science, Earth and Environmental Sciences, Economics, English, 
				Environmental Geoscience, Environmental Studies, Film Studies, French, 
				Geological Sciences, German Studies, Hispanic Studies, History, Independent Major,
				International Studies, Islamic Civilization and Societies, Italian, Linguistics,
				Mathematics, Music, Philosophy, Physics, Political Science, Psychology, Russian, 
				Slavic Studies, Sociology, Studio Art, Theater, Theology",
				
			"Connell School of Nursing" =>
				"",
				
			"Lynch School of Education" =>
				"Elementary Education, Secondary Education, Applied Psychology and Human Development,
				Interdisciplinary Majors");
				
		$classArray = array("2015","2016","2017","2018");
		?>
	
	
	<form class="form-horizontal" role="form" method = "post" action="joinoperation.php" onsubmit="return validate();">
		<div class="form-group">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-6">
		<h1>Sign Up Page</h1>
		</div>
		</div>
		<?php 
		textInput("firstname","First Name");
		textInput("lastname","Last Name"); 
		textInput("email","Email"); 
		textInput("password","Password"); 
		textInput("confirmpassword","Confirm Password");   		
		?>
    <div class="form-group">
      <label class="control-label col-sm-3" for="school">School:</label>
      <div class="col-sm-6">
           <select name="school" id="school">
  	  		<option value="Carroll School of Management">Carroll School of Management</option>
  	 		<option value="College of Arts and Sciences">College of Arts and Sciences</option>
  	 		<option value="Connell School of Nursing">Connell School of Nursing</option>
  	 		<option value="Lynch School of Education">Lynch School of Education</option>
	       </select>
       </div>
    </div>
    
     <div class="form-group">
      <label class="control-label col-sm-3" for ="major">Major</label>
      <div class="col-sm-6">
           <select name ="major" id="major">
			<?php
			foreach ($collegeMajorArray as $school => $major){
					echo "<optgroup label='$school'>\n";
					$majorArray = explode(",",$major);
					foreach ($majorArray as $value){
						echo "\t\t<option value='$value'>$value</option>\n";
					}
					echo "</optgroup>\n\n";
			}?>
		</select>
		<script>
			$("#school").on("change", function() {
				$states = $("#major");
				$states.find("optgroup").hide().children().hide();
				$states.find("optgroup[label='" + this.value + "']").show().children().show();
				$states.find("optgroup[label='" + this.value + "'] option").eq(0).prop("selected", true);
			});
		</script>
       </div>
    </div>
    
	 <div class="form-group">
      <label class="control-label col-sm-3"  for ='class'>Class</label>
      <div class="col-sm-6">
           <select name="class" id ="class"><?php
			//echo "<option value=0> </option>\n";
			foreach ($classArray as $class){
      			echo "<option value=$class>$class</option>\n";
      			}?>;
		</select>
       </div>
    </div>
		
    <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-10">
		<input class="btn btn-default" type = 'submit' name = 'addMember' value ='Sign Up!'/>
	</div>
	</div>	
	<div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-10">	
		<article id="errormessage"></article><br>
		<article id="invaliderrormessage"></article>
	</div>
	</div>
	</form>
	</div>
</body>
</html>
<?php

function textInput($name,$display){
	$error = $name . "error";
	?><div class="form-group">
	<?php
	   if ($name!="password" && $name!="confirmpassword"){
		echo"<label class='control-label col-sm-3' for=$name>$display</label>
		    <div class='col-sm-6'>
			<input class='form-control' type ='text' name = '$name' id= '$name' /></div>\n";
	}
	else{
		echo"<label class='control-label col-sm-3' for=$name>$display</label>
		    <div class='col-sm-6'>
			<input class='form-control' type ='password' name = '$name' id= '$name' /></div>\n";
	}
	?></div><?php
}