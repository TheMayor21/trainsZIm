<!DOCTYPE html>
<html>

<head>
</head>

<body>
<div class='blue-top'>
<?php

include ('db_connection.php');
include('navbar.html');
include('while.php');

$day = trim($_POST['date_day']);
$month = trim($_POST['date_month']);
$year = date('Y');
$travel_date = $year."-".$month."-".$day;

$name = trim(htmlspecialchars($_POST['fullName']));
$sex = $_POST['gender'];

$sp = trim($_GET['sp']);//info on departure point
$ep = trim($_GET['ep']); //info on termination point
$trip = trim($_GET['trip']); //info about trip type
$class = trim($_GET['class']);
$cost = $_GET['c'];

$ticket_no = ticketing($class); //calls function to create ticket number

$qry = "INSERT INTO ticket_details VALUES ('','{$ticket_no}', '{$class}', '{$name}', '{$travel_date}', '{$sex}', '{$trip}', '{$sp}', '{$ep}', '{$cost}' )";
$xqt_qry = mysqli_query($cxn, $qry);

if ($xqt_qry) {
	echo "<center>",
	"<h3>Done</h3>";
	
	if ($class == 'Sleeper') {
	echo
	"Your details are as follows:",
	"<div id='ticket'>",
	"<br/>",
	"<p><b>Class:</b> $class</p>",
	"<p><b>Full Name:</b> $name</p>",
	"<p><b>Sex:</b> $sex</p>",
	"<p><b>Travel Date:</b> $day/$month/$year</p>",
	"<p><b>From:</b> $sp </p>",
	"<p><b>To:</b> $ep </p>",
	"<p><b>Ticket: $ticket_no</p>",
	"<br/>",
	"<p><h3>$$cost - $trip </h3></p>",

	"<br/>",
	"*RT = Return Trip \t ST = Single Trip",
	
	"<br/>",
	"</div>";
	}
	else {
	echo
	"Your details are as follows:",
	
	"<div id='ticket'>",
	"<br/>",
	"<p><b>Class:</b> $class</p>",
	"<p><b>Full Name:</b> $name</p>",
	"<p><b>Travel Date:</b> $day/$month/$year</p>",
	"<p><b>From:</b> $sp </p>",
	"<p><b>To:</b> $ep </p>",
	"<p><b>Ticket: $ticket_no</p>",
	"<br/>",
	"<p><h3>$$cost - $trip </h3></p>",
	
	"*<small>RT = Return Trip \t ST = Single Trip</small>",
	"<br/>",
	"</div>";
	}
	
}
else {
	echo "Error Occured";
}
	
?>
</div>
</body>
</html>