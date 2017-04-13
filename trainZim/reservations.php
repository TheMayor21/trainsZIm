<!DOCTYPE html>
<html>
<?php
    include('navbar.html');
?>
<head>
	<link rel='stylesheet' type='text/css' href='bootstrap/css/customCSS.css'/>
</head>

<body>

<div class='blue-top'>
<br/>
<center>
<?php
    extract($_GET);
	global $mulitiplier;
	global $triptype;
	
	 $var = $_POST['triptype']['selection']; //variable to hold a 2 if Round Trip was slected on prev, or NULL if not selected
	 if ($var == 2) {
	  $multiplier = 2;
	  $triptype = 'RT'; //RT for Return Trip
	 }
	 else {
	 $multiplier = 1;
	 $triptype = 'ST'; //ST for Single Trip
	 }
	 
	include("db_connection.php");
	$class = trim(strtolower($_GET['class'])); //class var to be used in determine which price for which chosen class to pull from db
	
	$ep = $_POST['ep']; //extracting the end point info passed from prev page where selection was made
	$sp = $_POST['sp'];//extracting the start point info
	
	$qry = "SELECT ($class * $multiplier) AS price, start_point, end_point FROM trip_details WHERE start_point='$sp' AND end_point='$ep' ";
    $xqt = mysqli_query($cxn, $qry);
 

     while ($row = mysqli_fetch_assoc($xqt)) {
     extract($row);
	  
	  //holding information for later use
	  global $sp;
	  $sp = $start_point;
	  
	  global $ep;
	  $ep = $end_point;
	  
	  global $price;
	 $price = $price;
	 
	 }
?>

<form method='POST' action='uploadScript.php?sp=<?php echo $sp?>&ep=<?php echo $ep?>&trip=<?php echo $triptype ?>&class=<?php echo $_GET['class'] ?>&c=<?php echo $price ?>'> <!-- passing star and end point data to be used on next page-->
			    
				<p>
				<img src='icns/user_male3-25.png'>
				<br/>
				Full Name:
				<br/>
				<input type='text' name='fullName' placeholder='Full Name'>
				</p>
				
				<p>
				<img src='icns/calendar-25.png'>
				<br/>
				Travel Date:
				<br/>
				<select name='date_day' >
				<?php
				       
					   for ($i =1; $i<=31; $i++) {
				           echo "<option value='{$i}'>{$i}</option>";
						}
				?>
				</select>
				
				<select name='date_month' >
				<?php
				        $monthNames = Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
						//$monthNums = Array(31,28,31,30,31,30,31,31,30,31,30,31);
						$count = 1; //count = month as a num e.g. Jan = 1, Feb = 2 ...
						
						foreach($monthNames as $mN) {
						echo "<option value='{$count}'>{$mN}</option>";
						$count++;
						}
						
				?>
				</select>
				</p>
				
				<p>
				<img src='icns/toilet-25.png'>
				<br/>
				Sex: 
				<br/>
				<select name='gender'>
				    <option value='F'>Female</option>
					<option value='M'>Male</option>
				</select>
				</p>
				
				<?php echo "<h1>$$price</h1>",
				"<h3>$triptype</h3>",
				"RT = Return Trip",
				"<br/>",
				"ST - Single Trip";
				?>
</center>
</div>
<p><center><input type='submit' value='Submit' id='submit-btn'/></center></p>
</form>

</body>
</html>

