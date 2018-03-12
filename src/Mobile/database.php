<!DOCTYPE html>
<html>
<head>
<!-- Importing JQuery librarys -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<!-- Scrollling CSS -->
<style>
.table-container{
  overflow: hidden;
  overflow-x: scroll;
  -webkit-overflow-scrolling: touch;
}
</style>
</head>

<body>

<div data-role="page" data-theme="b" id="pageone">
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
	<div class="table-container">
   <?php

/* Make connection to your database on student.computing.dcu.ie here */
/* YOUR CODE GOES HERE */
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

switch ($queryNumber) {  // What is a switch statement? - http://php.net/manual/en/control-structures.switch.php
  case "q1":
    /* First make the SQL string using the $_GET['facility'] value, then call the database to get the answer */
    /* YOUR CODE GOES HERE */
	$facility = $_GET['facility'];
	$SQL = "SELECT CarParkName FROM CarParkData WHERE NearbyFacilities LIKE "."\"%$facility%\"";
    mysql_select_db($dbname);
	$result = mysql_query($SQL, $conn);

    // This example output table is for query 1,
    // the other queries will have different numbers of columns and rows and different headings
      //where $SQL is the query you used to access your database
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
  case "q2":
    /* YOUR CODE GOES HERE */
	$spaceType = $_GET['spaceType'];
	$SQL = "SELECT Campus, SUM(NumberOfSpaces) as NumberOfSpaces, SUM(NumberOfDisabledSpaces) as NumberOfDisabledSpaces, SUM(NumberOfSpaces + NumberOfDisabledSpaces) AS total FROM CarParkData Where Campus = "."\"$spaceType\"";
	mysql_select_db($dbname);
	$result = mysql_query($SQL, $conn);

    
     
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
  case "q3":
  
    
    /* YOUR CODE GOES HERE */
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
</div>
  <div data-role="footer">
    <h1>Created By Aaron Gillespie 14314471</h1>
  </div>
</div> 

</body>
</html>
