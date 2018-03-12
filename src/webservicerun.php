<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Park At DCU</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	
</head>
<body>
<!-- Start of page css -->
	<div id="page">
	<!-- Logo -->
		<div id="logo">
			<a href="index.html">
			<img src="dcu.jpg" alt="DCU Logo" style="width:124px;height:50px;">
			<h1><a href="index.html" id="logoLink">Park At DCU</a></h1>
			</a>
		</div>
		<!-- Navigation Bar -->
		<div id="nav">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="webserviceindex.html">Real Time Information</a></li>
				<li><a href="Query1.html">Closest CarPark</a></li>
				<li><a href="Query2.html">Campus Space Information</a></li>
				<li><a href="Query4.html">Historical Information</a></li>
			</ul>	
		</div>
		<!-- Content -->
		<div id="content">
			<?php
	// Call the carpark webservice to get the spaces available for $_GET['carpark']

	$entry = $_GET['carpark'];
	$spaceType = $_GET['spaceType'];
	$location = "http://suzannelittle.pythonanywhere.com/carpark/$entry/$spaceType";
	// Process the JSON and check for errors

	
	$entry = strtolower($entry);
	
	$entry = str_replace(' ', '', $entry);
	if($entry == "stpats")
	{
		$entry = "StPats";
	}
	$json = file_get_contents($location);
	$details = json_decode($json);
	
	// Get the values for $carpark, $timestamp and $spaces

	
	$carpark = $details->carpark_name;
	$timestamp = $details->timestamp;
	$spaces = $details->spaces_available;
	$spaces2 = $details->spaces;
	$muppet = $details->muppet;
	$spaceType = $details-> spaceType;
	
	// Call the carpark webservice to get the spaces available for $_GET['carpark']

	if($entry == "alpha" || $entry == "creche" || $entry == "multistory" || $entry == "library" || $entry == "StPats" || $entry == "invent")
	{
		
		if($spaces <0 || $spaces2 <0)
		{
			$error_num = 2;
			$error_msg = "The number of Spaces given was less than Zero.";
			echo "-- CA377 Error handling --";
			echo "<p>Error: " . $error_num . " " . $error_msg;
		}
		if(($spaces> 0) && is_int($spaces) == false && is_int($spaces2) == false)
		{
			$error_num =3;
			$error_msg="The number of spaces given was not a whole number.";
			echo "-- CA377 Error handling --";
			echo "<p>Error: " . $error_num . " " . $error_msg;
		}
		if (strlen($muppet)>0)
		{
			$error_num = 4;
			$error_msg ="The muppets character listed is not a required field";
			echo "-- CA377 Error handling --";
			echo "<p>Error: " . $error_num . " " . $error_msg;
			

		}
		
	}
  if ($entry !== "alpha" && $entry !== "creche" && $entry !== "multistory" && $entry !== "library" && $entry !== "StPats" && $entry !== "invent")
	{

		$error_num = 1;
		$error_msg ="The Input Entered is not valid. Please enter one of the following CarPark's : Multistorey,Creche,Invent,Library,St Pats,DCU Alpha CP";
		echo "-- CA377 Error handling --";
		echo "<p>Error: " . $error_num . " " . $error_msg;
	}

	else 
	{ 
		echo " <table>";
		echo "   <th>Carpark</th><th>Space Type</th><th>Time</th><th>Spaces</th>";
		echo "   <tr><td>" . $carpark . "</td>" . "<td>" . $spaceType . "</td>" . "<td>" . $timestamp . "</td>" . "<td>" . $spaces . "</td></tr>";
		echo "</table>";
	   
	}
	
	echo "</br>";
	
	
  
	

  ?>
		</div>
		<!-- Footer -->
		<div id="footer">
			<p>
				Webpage made by <a href="https://ie.linkedin.com/in/aaron-gillespie-b01a1365" >[Aaron Gillespie 14314471]</a>
			</p>
		</div>
	</div>


  

  
 </body>
</html>
