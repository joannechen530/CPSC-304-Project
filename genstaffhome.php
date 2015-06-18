<!DOCTYPE HTML>
<html> 
<body>
<p>General Staff</p>

<br>
<?php 
$db_conn = OCILogon("ora_l2r8", "a32433120", "ug");
$login = 334455668;//$_COOKIE["username"];
echo "<p><font size='4'> My Info: </font></p>";

$result = executePlainSQL("select name, s.ssin, pos, salary, pc, since from Staff s, WorksAt w where s.ssin=w.ssin and s.ssin=$login");

$row = OCI_Fetch_Array($result, OCI_BOTH);

echo "Current Position: <br><br>";

echo "<font size='2'> Name: $row[0] </font><br>";
echo "<font size='2'>SIN: $row[1] </font><br>";
echo "<font size='2'>Position: $row[2] </font><br>";
echo "<font size='2'>Salary: $row[3] </font><br>";
echo "<font size='2'>Branch: $row[4] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Start Date: $row[5]</font><br><br><br>";

echo "Past Positions: <br><br>";
$result = executePlainSQL("select pos, salary, pc, sfrom, sto from HasWorkedAt where ssin=$login");

while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
	echo "<font size='2'>Position: $row[0] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Salary: $row[1]</font><br>";
	echo "<font size='2'>Branch: $row[2] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: $row[3] 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: $row[4]</font><br><br>";

}
?>

<p>Update Availability:</p>
<p><font size="2">SIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Availability</font></p>
<form method="POST" action="genstaffhome.php">
<!--refresh page when submit-->
   <p><input type="text" name="sinavail" size="6"><input type="text" name="avail" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Update" name="updateavail"></p>
</form>

<p>Find Supervisor:</p>
<p><font size="2">SIN</font></p>
<form method="POST" action="genstaffhome.php">
<!--refresh page when submit-->
   <p><input type="text" name="sinsuper" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="supervisor"></p>
</form>

<p>Find employees with a certain supervisor:</p>
<p><font size="2">SIN</font></p>
<form method="POST" action="genstaffhome.php">
<!--refresh page when submit-->
   <p><input type="text" name="sinsuperem" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="supervisoremployees"></p>
</form>

<?php
$db_conn = OCILogon("ora_l2r8", "a32433120", "ug");


function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
	//echo "<br>running ".$cmdstr."<br>";
	global $db_conn, $success;
	$statement = OCIParse($db_conn, $cmdstr); //There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work

	if (!$statement) {
		echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
		$e = OCI_Error($db_conn); // For OCIParse errors pass the       
		// connection handle
		echo htmlentities($e['message']);
		$success = False;
	}

	$r = OCIExecute($statement, OCI_DEFAULT);
	if (!$r) {
		echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
		$e = oci_error($statement); // For OCIExecute errors pass the statementhandle
		echo htmlentities($e['message']);
		$success = False;
	} else {

	}
	return $statement;

}

function executeBoundSQL($cmdstr, $list) {
	/* Sometimes a same statement will be excuted for severl times, only
	 the value of variables need to be changed.
	 In this case you don't need to create the statement several times; 
	 using bind variables can make the statement be shared and just 
	 parsed once. This is also very useful in protecting against SQL injection. See example code below for       how this functions is used */

	global $db_conn, $success;
	$statement = OCIParse($db_conn, $cmdstr);

	if (!$statement) {
		echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
		$e = OCI_Error($db_conn);
		echo htmlentities($e['message']);
		$success = False;
	}

	foreach ($list as $tuple) {
		foreach ($tuple as $bind => $val) {
			//echo $val;
			//echo "<br>".$bind."<br>";
			OCIBindByName($statement, $bind, $val);
			unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype

		}
		$r = OCIExecute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($statement); // For OCIExecute errors pass the statementhandle
			echo htmlentities($e['message']);
			echo "<br>";
			$success = False;
		}
	}

}


if ($db_conn){

	if (array_key_exists('findmyinfo', $_POST)){
	if(is_numeric($_POST['sininfo']) && strlen($_POST['sininfo']) == 9){
	$result = executePlainSQL("SELECT name, ssin, availability, since, pos, salary FROM Staff natural inner join WorksAt WHERE ssin = '".$_POST['sininfo']."'");
	echo "<table>";
	echo "<tr><th>Name</th><th>SIN</th><th>Availability</th><th>Worked Since</th><th>Position</th><th>Salary</th></tr>";
	echo "</table>";
	
		OCICommit($db_conn);
	
	echo "<table>";
	while (($row = OCI_Fetch_Array($result, OCI_BOTH)) != false) {
		echo "<tr><td>" . $row['NAME'] . "</td><td>" . $row['SSIN'] . "</td><td>" . $row['AVAILABILITY'] . "</td><td>" . $row['SINCE'] . "</td><td>" . $row['POS'] . "</td><td>" . $row['SALARY'] . "</td></tr>"; 
	}
	echo "</table>";

		
	}else {echo "Invalid Inputs";}

	} else

	if (array_key_exists('updateavail', $_POST)){
	if(is_numeric($_POST['sinavail']) && strlen($_POST['sinavail']) == 9){
	executePlainSQL("UPDATE Staff SET availability = '".$_POST['avail']."' WHERE ssin = '".$_POST['sinavail']."'");
	echo "Availability changed.";
	OCICommit($db_conn);
	} else {echo "Invalid Inputs";}

	} else

	if (array_key_exists('supervisor', $_POST)){
	if(is_numeric($_POST['sinsuper']) && strlen($_POST['sinsuper']) == 9){
	$result = executePlainSQL("select name from staff where ssin = (select sr_sin from supervises where jr_sin = '".$_POST['sinsuper']."')");
	//print
	echo "<table>";
	echo "<tr><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
	}
	echo "</table>";
		OCICommit($db_conn);
	} else{echo "Invalid Inputs";}

	} else

	if (array_key_exists('supervisoremployees', $_POST)){
	if(is_numeric($_POST['sinsuperem']) && strlen($_POST['sinsuperem']) == 9){
	$result = executePlainSQL("select ssin, name from staff where ssin IN (select jr_sin from supervises where sr_sin = '".$_POST['sinsuperem']."')");	
	echo "<table>";
	echo "<tr><th>Sin</th><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["SSIN"] . "</td><td>" . $row["NAME"] . "</td></tr>"; 
	}
	echo "</table>";
	OCICommit($db_conn);
	} else {echo "Invalid Inputs";}
	
	} 



OCILogoff($db_conn);
}
 ?>
</body>
</html>
