<!DOCTYPE HTML>
<html> 
<body>
<p>Customer</p>

<p>Write a review: </p>
<p> Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PostalCode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rating&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</p>
<form method="POST" action="custhome.php">
<!--refresh page when submit-->
   <p><input type="text" name="namereview" size="6"><input type="text" name="pcreview" size="6"><input type="text" name="ratingreview" size="6"><input type="text" name="datereview" size="6"><br><br>Comment<br><input type="text" name="commentreview" size="6" style="width:200px; height:200px;">
<!--define variables to pass the value-->      
<br><br><input type="submit" value="Submit Review" name="submitreview"></p>
</form>


<p>Find a branches reviews: </p>
<p><font size="2"> Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City </font></p>
<form method="POST" action="custhome.php">
<!--refresh page when submit-->
   <p><input type="text" name="addressreview" size="6"><input type="text" name="cityreview" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="searchforreviews"></p>
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
/*
	$result = executePlainSQL("select * from reviews");
	echo "<br>Got data from table Reviews:<br>";
	echo "<table>";
	echo "<tr><th>ID</th><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["POSTALCODE"] . "</td><td>" . $row["RATING"] . "</td><td>" . $row["PDATE"] . "</td><td>" . $row["COMMENT"] . "</td></tr>"; //or just use "echo $row[0]"
		//echo $row[0]; 
	}
	echo "</table>";

*/
	if (array_key_exists('submitreview', $_POST)){
	$tuple = array (
			":bind1" => $_POST['namereview'],
			":bind2" => $_POST['pcreview'],
			":bind3" => $_POST['ratingreview'],
			":bind4" => $_POST['datereview'],
			":bind5" => $_POST['commentreview']
		);
		$alltuples = array (
			$tuple
		);

		executeBoundSQL("insert into reviews values (:bind1, :bind2, :bind3, :bind4, :bind5)", $alltuples);
		executePlainSQL("UPDATE Branch SET av_rating = (SELECT AVG(rating) FROM Reviews WHERE pc = v_rpc GROUP BY pc)");

		OCICommit($db_conn);
	} else
	if (array_key_exists('searchforreviews', $_POST)){
		$tuple = array (
				":bind1" => $_POST['addressreview'],
				":bind2" => $_POST['cityreview']
			);
			$alltuples = array (
				$tuple
			);
		executeBoundSQL("select r.username, r.rating, r.comments from reviews r where r.pc = (select b.pc from branches where b.addr = :bind1 and b.city = :bind2)", $alltuples);
		//print
		OCICommit($db_conn);
	}


OCILogoff($db_conn);
}
 ?>
</body>
</html>
