<!DOCTYPE html>
<html>
<head>
<!-- Importing JQuery librarys -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>

<div data-role="page" data-theme="b" id="pagethree">
  <div data-role="header">
     <h1>Park At DCU</h1>
	 <!-- Navigation Bar -->
    <div data-role="navbar">
      <ul>
         <li><a href="index.html">Home</br></a></li>
        <li><a href="webservice.html">Real</br>Time</a></li>
		<li><a href="closest.html">Closest</br>CarPark</a></li>
		<li><a href="campus.html">Campus</br>Info</a></li>
		<li><a href="historical.html">Historical</br>Info</a></li>
       
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <?php
	// Call the carpark webservice to get the spaces available for $_GET['carpark']
	/* YOUR CODE GOES HERE */
	$entry = $_GET['carpark'];
	$spaceType = $_GET['spaceType'];
	$location = "http://suzannelittle.pythonanywhere.com/carpark/$entry/$spaceType";
	// Process the JSON and check for errors
	/* YOUR CODE GOES HERE */
	
	$entry = strtolower($entry);
	
	$entry = str_replace(' ', '', $entry);
	if($entry == "stpats")
	{
		$entry = "StPats";
	}
	$json = file_get_contents($location);
	$details = json_decode($json);
	
	// Get the values for $carpark, $timestamp and $spaces
    /* YOUR CODE GOES HERE */
	
	$carpark = $details->carpark_name;
	$timestamp = $details->timestamp;
	$spaces = $details->spaces_available;
	$spaces2 = $details->spaces;
	$muppet = $details->muppet;
	$spaceType = $details-> spaceType;
	
	// Call the carpark webservice to get the spaces available for $_GET['carpark']
	/* YOUR CODE GOES HERE */
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

  <div data-role="footer"> 
  <h1>Created By Aaron Gillespie 14314471</h1>
  </div>
</div> 

</body>
</html>
