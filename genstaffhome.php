<!DOCTYPE HTML>
<html> 
<body>
<p>Wait Staff</p>

<p>Find my info: </p>
<p><font size="2"> SIN</font></p>
<form method="POST" action="waithome.php">
<!--refresh page when submit-->
   <p><input type="text" name="sininfo" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="findmyinfo"></p>
</form>

<p>Update Availability:</p>
<p><font size="2">SIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Availability</font></p>
<form method="POST" action="waithome.php">
<!--refresh page when submit-->
   <p><input type="text" name="sinavail" size="6"><input type="text" name="avail" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Update" name="updateavail"></p>
</form>

<p>Find Supervisor:</p>
<p><font size="2">SIN</font></p>
<form method="POST" action="waithome.php">
<!--refresh page when submit-->
   <p><input type="text" name="sinsuper" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="supervisor"></p>
</form>

<p>Find employees with a certain supervisor:</p>
<p><font size="2">SIN</font></p>
<form method="POST" action="waithome.php">
<!--refresh page when submit-->
   <p><input type="text" name="sinsuperem" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="supervisoremployees"></p>
</form>

<?php
$db_conn = OCILogon("ora_r1b9", "a35876135", "ug");


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
	$result = executePlainSQL("SELECT name, sin, availability, since, pos, salary FROM Staff natural inner join WorksAt WHERE sin = '".$_POST['sininfo']."'");
	echo "<table>";
	echo "<tr><th>Name</th><th>SIN</th><th>Availability</th><th>Worked Since</th><th>Position</th><th>Salary</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["SIN"] . "</td><td>" . $row["AVAILABILITY"] . "</td><td>" . $row["SINCE"] . "</td><td>" . $row["POS"] . "</td><td>" . $row["SALARY"] . "</td></tr>"; 
	}
	echo "</table>";

		OCICommit($db_conn);
	} else

	if (array_key_exists('updateavail', $_POST)){
	executePlainSQL("UPDATE Staff SET availability = '".$_POST['avail']."' WHERE sin = '".$_POST['sinavail']."';");
	echo "Availability changed.";
	OCICommit($db_conn);
	} else

	if (array_key_exists('supervisor', $_POST)){
	$result = executePlainSQL("select name from staff where sin = (select sr_sin from supervises where jr_sin = '".$_POST['sinsuper']."')");
	//print
	echo "<table>";
	echo "<tr><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
	}
	echo "</table>";
	OCICommit($db_conn);

	} else

	if (array_key_exists('supervisoremployees', $_POST)){

	$result = executePlainSQL("select name from staff where sin = (select jr_sin from supervises where sr_sin = '".$_POST['sinsuperem']."')");
	//print		
	echo "<table>";
	echo "<tr><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
	}
	echo "</table>";
	OCICommit($db_conn);
	} 



OCILogoff($db_conn);
}
 ?>
</body>
</html>
