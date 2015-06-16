<!DOCTYPE HTML>
<html> 
<body>
<p>Staff Login:</p>

<form action="" method="post">
Name: <input type="text" name="user"><br>
Password: <input type="text" name="pass"><br>
<input type="submit" name = 'slogin' value = "LOGIN">
<br><br>
Customer Login:<br>
<form action="" method="post">
Name: <input type="text" name="cuser"><br>
Password: <input type="text" name="cpass"><br>
<input type="submit" name = 'clogin' value = "LOGIN">
<br><br><br><br><br><br><br><br>


<p>Find all branches (In a province or city) </p>
<p><font size="2"> Restaurant Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Province&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City </font></p>
<form method="POST" action="login.php">
<!--refresh page when submit-->
   <p><input type="text" name="rnamebranches" size="6"><input type="text" name="provincebranches" size="6"><input type="text" name="citybranches" size="6">
<!--define variables to pass the value-->      
<input type="submit" value="Search for branches by city" name="searchforbranchesincity"><br>
</form>



<p>Find a branches reviews: </p>
<p><font size="2"> Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City </font></p>
<form method="POST" action="login.php">
<!--refresh page when submit-->
   <p><input type="text" name="addressreview" size="6"><input type="text" name="cityreview" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="searchforreviews"></p>
</form>

<p>About a Restaurant: </p>
<p><font size="2"> Restaurant Name </font></p>
<form method="POST" action="login.php">
<!--refresh page when submit-->
   <p><input type="text" name="rnameinfo" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="searchforrest"></p>
</form>

<p>Find a Restaurant's Dishes: </p>
<p><font size="2"> Restaurant Name </font></p>
<form method="POST" action="login.php">
<!--refresh page when submit-->
   <p><input type="text" name="rnamedishes" size="6">
<!--define variable to pass the value-->      
<input type="submit" value="Search" name="searchfordishes"></p>
</form>




</form>
<?php session_start(); ?>

<?php
$success = True; //keep track of errors so it redirects the page only if there are no errors
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

	if (array_key_exists('searchforbranchesincity', $_POST)){
			$result = executePlainSQL("select addr, city, province, phone, av_rating from branches where name ='".$_POST['rnamebranches']."' and city = '".$_POST['citybranches']."' and province ='".$_POST['provincebranches']."'");
			echo "<br>Got data from table Branches:<br>";
			echo "<table>";
			echo "<tr><th>Address</th><th>City</th><th>Province</th><th>Phone</th><th>Rating</th></tr>";

			while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
				echo "<tr><td>" . $row["ADDR"] . "</td><td>" . $row["CITY"] . "</td><td>" . $row["PROVINCE"] . "</td><td>" . $row["PHONE"] . "</td><td>" . $row["AV_RATING"] . "</td></tr>";  
			}
			echo "</table>";
			

	}else 
	if (array_key_exists('searchforallbranches', $_POST)){
		$tuple = array (
				":bind1" => $_POST['rnamebranches']

			);
			$alltuples = array (
				$tuple
			);
			executeBoundSQL("select addr, city, province, phone, av_rating, s_date, capacity  from Branches where :bind1 = name order by av_rating", $alltuples);

			OCICommit($db_conn);
	} else
		if (array_key_exists('searchforrest', $_POST)){
		$tuple = array (
				":bind1" => $_POST['rnameinfo']

			);
			$alltuples = array (
				$tuple
			);
		executeBoundSQL("select rname, type, s_date from Restaurant where rname=restaurant;", $alltuples);
		OCICommit($db_conn);
	} else

	if (array_key_exists('searchfordishes', $_POST)){
		$tuple = array (
				":bind1" => $_POST['rnamedishes']

			);
			$alltuples = array (
				$tuple
			);
		executeBoundSQL("select dname, price, popularity FROM SellsDish WHERE rname=:bind1", $alltuples);
		OCICommit($db_conn);
	} else 

	if (array_key_exists('searchforreviews', $_POST)){
		$result = executePlainSQL("select r.username, r.rating, r.comments from reviews r where r.pc = (select b.pc from branches where b.addr = '".$_POST['addressreview']."' and b.city = '".$_POST['cityreview']."'')");
		echo "<br>Got data from table Reviews:<br>";
			echo "<table>";
			echo "<tr><th>Username</th><th>Rating</th><th>Comment</th></tr>";

			while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
				echo "<tr><td>" . $row["USERNAME"] . "</td><td>" . $row["RATING"] . "</td><td>" . $row["COMMENT"] . "</td></tr>";  
			}
			echo "</table>";

		OCICommit($db_conn);
	}

OCILogoff($db_conn);
}

if(isset($_POST['slogin']))   // it checks whether the user clicked login button or not 
{
     $user = $_POST['user'];
     $pass = $_POST['pass'];
/*
     $staff = executePlainSQL("select sin from staff where sin = '".$user."'");
     if (!is_null($staff)){
     	$staff = executePlainSQL("select sin from manager where sin = '".$user."' AND pw = '".$pass"'");

     }else{
     	echo "Invalid username or password";
     } 
*/
      if($user == "manager" && $pass == "m123")    
         {                                       

          $_SESSION['use']=$user;

         echo '<script type="text/javascript"> window.open("manhome.php","_self");</script>';            //  On Successfull Login redirects to home.php

        }
      if($user == "username" && $pass == "c123")    
         {                                       

          $_SESSION['use']=$user;

         echo '<script type="text/javascript"> window.open("custhome.php","_self");</script>';            //  On Successfull Login redirects to home.php

        }
        if($user == "waiter" && $pass == "w123")    
         {                                       

          $_SESSION['use']=$user;

         echo '<script type="text/javascript"> window.open("waithome.php","_self");</script>';            //  On Successfull Login redirects to home.php

        }
        if($user == "chef" && $pass == "ch123")    
         {                                       

          $_SESSION['use']=$user;

         echo '<script type="text/javascript"> window.open("chefhome.php","_self");</script>';            //  On Successfull Login redirects to home.php

        }

        else
        {
            echo "Invalid UserName or Password";        
        }       
}


 ?>
</body>
</html>
