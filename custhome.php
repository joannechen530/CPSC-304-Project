<!DOCTYPE HTML>
<html> 
<body>
<p>Customer</p>

<br>
<?php 
$login = $_COOKIE["username"];
echo $login; 
?>

<p>Write a review: </p>
<p> Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PostalCode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rating&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</p>
<form method="POST" action="custhome.php">
<!--refresh page when submit-->
   <p><input type="text" name="namereviews" size="6"><input type="text" name="pcreview" size="6"><input type="text" name="ratingreview" size="6"><input type="text" name="datereview" size="6"><br><br>Comment<br><input type="text" name="commentreview" size="6" style="width:200px; height:200px;">
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

<p>Find all reviews for a restaurant chain: </p>
<p><font size="2"> Restaurant Chain: </font></p>
<form method="POST" action="custhome.php">
<!--refresh page when submit-->
   <p><input type="text" name="namereview" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="searchforallreviews"></p>
</form>


<?php
$db_conn = OCILogon("ora_y2q8", "a33104126", "ug");


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

	if (array_key_exists('submitreview', $_POST)){
		if ( strlen($_POST['pcreview']) < 8 && is_numeric($_POST['datereview']) && $_POST['datereview'] < 20160101 && strlen($_POST['commentreview']) < 300){
		executePlainSQL("INSERT into review values ('".$_POST['namereviews']."', '".$_POST['pcreview']."', '".$_POST['ratingreview']."', '".$_POST['datereview']."' , '".$_POST['commentreview']."')");
		executePlainSQL("UPDATE Branch SET av_rating = (SELECT AVG(rating) FROM Reviews WHERE pc = '".$_POST['namereviews']."' GROUP BY pc)");
	}else {
		echo "Invalid Inputs";}

		OCICommit($db_conn);
	} else
	if (array_key_exists('searchforreviews', $_POST)){
	$result = executePlainSQL("SELECT r.username, r.rating, R.P_DATE, r.rcomment from review r where r.pc = (select b1.pc from branch b1, branch_city b2 where b1.pc = b2.pc and b1.addr = '".$_POST['addressreview']."' and b2.city = '".$_POST['cityreview']."')");
	echo "<table>";
	echo "<tr><th>Name</th><th><Rating</th><th><Posting Date</th><th>Comment</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["USERNAME"] . "</td><td>" . $row["RATING"] . "</td><td>" . $row["P_DATE"] . "</td><td>" . $row["RCOMMENT"] . "</td></tr>"; 
	}
	echo "</table>";

		OCICommit($db_conn);
	}else 

	if(array_key_exists ("searchforallreviews", $_POST)){
	$result = executePlainSQL("SELECT * from review where pc IN (select pc from branch where bname = '".$_POST['namereview']."') ");
	echo "<table>";
	echo "<tr><th>Username</th><th>Postal Code</th><th><Rating</th><th>Posting Date</th><th>Comment</th></tr>";
	
	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["USERNAME"] . "</td><td>" . $row["PC"] . "</td><td>" . $row["RATING"] . "</td><td>" . $row["P_DATE"] . "</td><td>" . $row["RCOMMENT"] . "</td></tr>"; 
	}
	
	
	echo "</table>";

	OCICommit($db_conn);
	}

OCILogoff($db_conn);
}
 ?>
</body>
</html>
