<!DOCTYPE html>
<html>

<head></head>

<body>


 
 <div class='blue-top'>
		<p>
		    <span>

<?php

include("db_connection.php");
include('navbar.html');

 extract($_GET);

 
 $qry = "SELECT * FROM class_info WHERE class_id='{$class}'";
 $xqt = mysqli_query($cxn, $qry);
 

 while ($row = mysqli_fetch_assoc($xqt)) {
     extract($row);
	 
	 echo "<center><h3>$class_name</h3>";
	 echo "<p style='margin: 2% 10% 2% 10%;'>$description</p>";
	 
	 global $cn; //classsname var
	 $cn = $class_name;
}
 ?>
  <center>
        <a href='about.php?class=SLP'><span>Sleeper</span></a>
		&nbsp &nbsp
		<a href='about.php?class=STN'><span>Standard</span></a>
		&nbsp &nbsp
		<a href='about.php?class=ECO'><span>Economy</span></a>
	</center>
 </span>
 <br/>
 
 <form method='POST' action='reservations.php?class=<?php echo $cn ?>'>
	  <p>
	  Departing From:
	  <br/>
	  <br/>
	  <img src='icns/right_up-24.png'>
	  <br/>
      <select name='sp'> <!-- sp = end point-->
	      <option value='Harare'>Harare</option>
		  <option value='Macheke/Headlands'>Macheke/Headlands</option>
		  <option value='Marondera'>Marondera</option>
		  <option value='Nyazura'>Nyazura</option>
		  <option value='Rusape'>Rusape</option>
	  </select>
	  </p>
	  
	  <p>
	  Arriving At:
	  <br/>
	  <br/>
	  <img src='icns/left_down-24.png'/>
	  <br/>
	  <select name='ep'> <!-- ep = end point-->
		  <option value='Macheke/Headlands'>Macheke/Headlands</option>
		  <option value='Marondera'>Marondera</option>
		  <option value='Mutare'>Mutare</option>
		  <option value='Nyazura'>Nyazura</option>
		  <option value='Rusape'>Rusape</option>
		</select>
		</p>
		
		<p>Return Trip?<input type='checkbox' name="triptype[selection]" value=2></p>
		
	</div>
		<center>
		<p>
		<input type='submit' value='Submit' id='submit-btn'>
		</p>
		</center>
 </form>
</p>
</center>
</body>
</html>