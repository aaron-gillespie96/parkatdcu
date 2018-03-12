<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Park At DCU</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	<div id="page">
		<div id="logo">
			<a href="index.html">
			<img src="dcu.jpg" alt="DCU Logo" style="width:124px;height:50px;">
			<h1><a href="index.html" id="logoLink">Park At DCU</a></h1>
			</a>
		</div>
		<div id="nav">
			<ul>
		<li><a href="index.html">Home</a></li>
				<li><a href="webserviceindex.html">Real Time Information</a></li>
				<li><a href="Query1.html">Closest CarPark</a></li>
				<li><a href="Query2.html">Campus Space Information</a></li>
				<li><a href="Query4.html">Historical Information</a></li>
			</ul>	
		</div>
		<div id="content">
			<?php

/* Connecting to database */

$server = "eu-cdbr-azure-north-e.cloudapp.net";
$user = "bc0070a9e563ad";
$password = "224a0f94";
$dbname = "acsm_986787df8c8453a";
$conn = mysql_connect($server, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/* Identify which query number has been called */
$queryNumber = $_GET['query'];

switch ($queryNumber) {  //Switch statment which links to html forms
  //code for query 1
  case "q1":
  //Get results from form
	$facility = $_GET['facility'];
	$SQL = "SELECT CarParkName FROM CarParkData WHERE NearbyFacilities LIKE "."\"%$facility%\"";
    mysql_select_db($dbname);
	$result = mysql_query($SQL, $conn);
	//error handeling
	 if ($facility !== "helix" && $facility !== "business" && $facility !== "main reception" && $facility !== "creche" && $facility !== "1838" && $facility !== "invent"&& $facility !== "library"&& $facility !== "gardens"&& $facility !== "sports grounds"&& $facility !== "met eireann")
	{

		$error_num = 1;
		$error_msg ="The Input Entered is not valid";
		echo "-- CA377 Error handling --";
		echo "<p>Error: " . $error_num . " " . $error_msg;
	}

	else 
    echo "<table>";
    echo "   <th>Carpark</th>";
    while ( $db_field = mysql_fetch_assoc($result) ) {
	
        echo "<tr><td>" . $db_field['CarParkName'] . "</tr></td>";
      }
    echo "</table>";


    break;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Query 2 
 case "q2":
	//Get results from form
	$spaceType = $_GET['spaceType'];
	$SQL = "SELECT Campus, SUM(NumberOfSpaces) as NumberOfSpaces, SUM(NumberOfDisabledSpaces) as NumberOfDisabledSpaces, SUM(NumberOfSpaces + NumberOfDisabledSpaces) AS total FROM CarParkData Where Campus = "."\"$spaceType\"";
	mysql_select_db($dbname);
	$result = mysql_query($SQL, $conn);

    
     //error checking
	if ($spaceType !== "Glasnevin" && $spaceType !== "St Pats" && $spaceType !== "DCU Alpha")
	{
		$error_num = 1;
		$error_msg ="The Input Entered is not valid";
		echo "-- CA377 Error handling --";
		echo "<p>Error: " . $error_num . " " . $error_msg;
	}
	else
    echo "<table>";
    while ( $db_field = mysql_fetch_assoc($result) ) {
		 echo "   <th>Campus </th>" . "<th> NumberOfDisabledSpaces </th>" . "<th> NumberOfSpaces </th>" . "<th> Total </th>" .  "<tr></tr>";
		 echo "<br>";
		echo "<td>" . $db_field["Campus"] . "</td>" ."<td>" . $db_field["NumberOfDisabledSpaces"] . "</td>" . "<td>" . $db_field["NumberOfSpaces"] . "</td>" . "<td>" . $db_field["total"] . "</td>" . "<tr></tr>";
      }
    echo "</table>";
    break;
	break;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //Query 3
  case "q3":
	//Get results from form
    $week = $_GET['weekOfYear'];
	$carpark = $_GET['carpark'];

	$SQL = "SELECT d.CarParkName as name , d.WeekOfYear as week ,d.CapacityAt7 , d.CapacityAt8 , d.CapacityAt9, d.CapacityAt10 , d.CapacityAt11 , d.CapacityAt12 , d.CapacityAt13 , d.CapacityAt14 , d.CapacityAt15 , d.CapacityAt16 , d.CapacityAt17 , d.CapacityAt18 , d.CapacityAt19 , d.CapacityAt20 , d.CapacityAt21 FROM CarParkData c , CarparkHistoricalOccupancy d WHERE d.WeekOfYear ="."\"$week\" AND d.CarParkName = "."\"$carpark\" group by d.CarParkName";
	
	mysql_select_db($dbname);
	$result = mysql_query($SQL, $conn);

    echo "<table>";
	echo "    <th>Carpark Name</th>" . "<th>Week</th>" . "<th>7am</th>" . "<th>8am</th>" . "<th>9am</th>" . "<th>10am</th>" . "<th>11am</th>" . "<th>12am</th>" . "<th>1pm</th>" . "<th>2pm</th>" . "<th>3pm</th>" . "<th>4pm</th>" . "<th>5pm</th>" . "<th>6pm</th>" . "<th>7pm</th>" . "<th>8pm</th>" ."<th>9pm</th>" . "<tr></tr>";
    while ($db_field = mysql_fetch_assoc($result)) {
	echo "<td>" . $carpark . "</td>" . "<td>" . $week . "</td>" . "<td>" . $db_field["CapacityAt7"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt8"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt9"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt10"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt11"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt12"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt13"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt14"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt15"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt16"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt17"]* 100 . "%"  . "</td>" .  "<td>" . $db_field["CapacityAt18"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt19"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt20"]* 100 . "%"  . "</td>" . "<td>" . $db_field["CapacityAt21"]* 100 . "%"  . "</td>" . "<tr></tr>";
      }
    echo "</table>";
	break;
}

 ?>
		</div>
		<div id="footer">
			<p>
				Webpage made by <a href="https://ie.linkedin.com/in/aaron-gillespie-b01a1365" >[Aaron Gillespie 14314471]</a>
			</p>
		</div>
	</div>



  </body>
 </html>