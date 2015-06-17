<!DOCTYPE HTML>
<html> 
<body>
<p><font size='6'> MANAGER </font></p>

<br>
<?php 
$login = $_COOKIE["username"];
echo $login; 
?>

<br><br>
<!--////////////////////////////-->
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
<br><br>

<!--////////////////////////////-->

<p><b>Find Staff:</b></p>
<p> <input type='submit' name='fs_list' value='View staff list'></p>
<form action="manhome.php" method='post'> 
<p> <font size='2'>SIN: </font><input type='text' name='fs_SIN'>
	<input type='submit' name='sub_fs_SIN' value='Find'>
</p>
<p> <font size='2'>Name: </font><input type='text' name='fs_name'>
	<input type='submit' name='sub_fs_name' value='Find'>
</p>
<p> <font size='2'>Branch: </font><input type='text' name='fs_branch'>
	<input type='submit' name='sub_fs_branch' value='Find'>
</p>
</form>

<br><br>

<p><b>Add Staff:</b></p>
<form action='manhome.php' method='post'>
	<p>
		<input type='text' name='as_name' value='Name'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='text' name='as_branchPC' value='Branch Postal Code'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='text' name='as_avail' value='Availability'>
		<br>
		<input type='text' name='as_SIN' value='SIN'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='text' name='as_pos' value='Position'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='text' name='as_schedule' value='Schedule'>
		<br>
		<input type='text' name='as_pw' value='Password'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='text' name='as_sal' value='Salary'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='text' name='as_date' value='Start Date'>
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='submit' name='sub_as' value='Add'>
	</p>
</form>

<form action='' method='post'>
<p><b>Delete Staff:</b></p>
<p> <font size='2'> SIN: </font><input type='text' name='ds_SIN'><br>
	<font size='2'> Date: </font><input type='text' name='ds_date' value='yyyymmdd'><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' name='sub_ds' value='Delete'>
</p></form>

<br><br>

<p><b>Edit Staff Info:</b></p>
<form action='manhome.php' method='post'>
	<p>
		<p><font size='2'>SIN: </font> <input type='text' name='es_sin'></p>
		<p><font size='2'>Supervisor: </font>
			<input type='text' name='es_supervisor' value='SIN'>
			<input type='radio' name='sub_es_supervisor' value='Add'><font size='2'>Remove</font>
			<input type='radio' name='sub_es_supervisor' value='Remove'><font size='2'>Add</font>
		</p>
		<p><font size='2'>Supervisee: </font>
			<input type='text' name='es_supervisee' value='SIN'>
			<input type='radio' name='sub_es_supervisee' value='Add'><font size='2'>Add</font>
			<input type='radio' name='sub_es_supervisee' value='Remove'><font size='2'>Remove</font>
		</p>
		<p><font size='2'>Change Position:</font><br>
			<input type='text' name='es_pos' value='New Position'>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type='text' name='es_sal' value='Salary'>
			<br>
			<input type='text' name='es_pc' value='Branch Postal Code'>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type='text' name='es_sdate' value='Start Date'>
		</p>
		<font size='2'>New Schedule: </font><input type='text' name='es_schedule'>
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='submit' name='sub_es' value='submit'>
	</p>
</form>

<form action='manhome.php' method='post'>
<font size='3'>Set the salary of the staff whose pay is higher than the average to be the average.</font>
<input type='submit' name='sub_es_avsal' value='Set'></form>
<br><br>
<!--
<form action='manhome.php' method='post'>
<font size='3'>Transfer all the staff members that have worked at <input type='text' name='es_transfer' value='Branch Postal Code'> but no longer work there to that branch in their current positions.</font>
<input type='submit' name='sub_es_transfer' value='Transfer'>
</form><br> -->
<form action='manhome.php' method='post'>
<font size='3'>Find the waiter with the highest pay and make him supervise all the other waiters</font>
<input type='submit' name='sub_es_supall' value='Set'></form>
<br><br><br>

<p><b>Update Branch Info:</b></p>
<form action='manhome.php' method='post'>
	<input type='text' name='ub_branch' value='Branch Postal Code'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='text' name='ub_budget' value='Budget'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='text' name='ub_pfmce' value='Performance'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' name='sub_ub' value='Update'>
</form>
<br><br>

<p><b>Others:</b></p>
<form action='manhome.php' mehtod='post'>
<font size='3'>Find branches managed by <input type='text' name='o_man' value='Manager Name'></font>
<input type='submit' name='sub_o_man' value='Search'></form><br>

<form action='manhome.php' method='post'>
<font size='3'>Compare performances of managers managing branches of</font>
<input type='text' name='o_compare' value='Restaurant Name'>
<input type='submit' name='sub_o_compare' value='Compare'></form><br>

<form action='manhome.php' method='post'>
<font size='3'>Find the most popular dishes:</font><br>
<input type='text' name='o_pop_res' value='Restaurant Name'>
<input type='submit' name='sub_o_pop' value='Search'></form><br>

<form action='manhome.php' method='post'>
<font size='3'>Count the number of customers that have visited
	<input type='text' name='o_cust_br' value='Branch Postal Code'>
	from <input type='text' name='o_cust_from' value='Date in yyyymmdd'>
	to <input type='text' name='o_cust_to' value='Date in yyyymmdd'></font>
<input type='submit' name='sub_o_cust' value='Submit'></form><br>





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

function printResult($result) { //prints results from a select statement
	echo "<br>Got data from table tab1:<br>";
	echo "<table>";
	echo "<tr><th>ID</th><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; //or just use "echo $row[0]" 
	}
	echo "</table>";

}


if ($db_conn){
	$result = null;

	/***************************************/
	if (array_key_exists('findmyinfo', $_POST)){
	if(is_numeric($_POST['sininfo']) && strlen($_POST['sininfo']) < 9){
	$result = executePlainSQL("SELECT name, sin, availability, since, pos, salary FROM Staff natural inner join WorksAt WHERE sin = '".$_POST['sininfo']."'");
	echo "<table>";
	echo "<tr><th>Name</th><th>SIN</th><th>Availability</th><th>Worked Since</th><th>Position</th><th>Salary</th></tr>";
	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["SIN"] . "</td><td>" . $row["AVAILABILITY"] . "</td><td>" . $row["SINCE"] . "</td><td>" . $row["POS"] . "</td><td>" . $row["SALARY"] . "</td></tr>"; 
	}
	echo "</table>";
		OCICommit($db_conn);
	}else {echo "Invalid Inputs";}
	} else
	if (array_key_exists('updateavail', $_POST)){
	if(is_numeric($_POST['sinavail']) && strlen($_POST['sinavail']) < 9){
	executePlainSQL("UPDATE Staff SET availability = '".$_POST['avail']."' WHERE sin = '".$_POST['sinavail']."';");
	echo "Availability changed.";
	OCICommit($db_conn);
	} else {echo "Invalid Inputs";}
	} else
	if (array_key_exists('supervisor', $_POST)){
	if(is_numeric($_POST['sinsuper']) && strlen($_POST['sinsuper']) < 9){
	$result = executePlainSQL("select name from staff where sin = (select sr_sin from supervises where jr_sin = '".$_POST['sinsuper']."')");
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
	if(is_numeric($_POST['sinsuperem']) && strlen($_POST['sinsuperem']) < 9){
	$result = executePlainSQL("select name from staff where sin = (select jr_sin from supervises where sr_sin = '".$_POST['sinsuperem']."')");	
	echo "<table>";
	echo "<tr><th>Name</th></tr>";
	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
	}
	echo "</table>";
	OCICommit($db_conn);
	} else {echo "Invalid Inputs";}
	
	} 

	/***************************************/

	if (array_key_exists('sub_fs_list', $_POST)){
		// View staff list (sin, name, branch)
		$result = executePlainSQL('select sin, name, pc from staff s, worksat w where s.sin=w.sin and w.pc in (select pc from worksat where sin=$login!) order by sin;');
	} else if (array_key_exists('sub_fs_SIN', $_POST)){
   		//Find staff by sin
		$sin = $_POST['fs_SIN'];
		$result = executePlainSQL("select sin, name, pc from Staff s, WorksAt w where s.ssin=$sin and s.sin=w.sin and w.pc in (select pc from WorksAt where sin=$login) order by sin;");
	} else if (array_key_exists('sub_fs_name', $_POST)) {
		//Find staff by Name
		$name = $_POST['fs_name'];
		$result = executePlainSQL("select sin, name, pc from staff s, worksat w where name=$name and s.sin=w.sin and w.pc in (select pc from worksat where sin=$login) order by sin;");
	
	} else if (array_key_exists('sub_fs_branch', $_POST)) {
		//Find staff by branch
	 	$pc = $_POST['fs_branch'];
		$result = executePlainSQL("select sin, name, pc from Staff s, WorksAt w where s.sin=w.sin and w.pc=$pc and w.pc in (select pc from WorksAt where sin=$login) order by sin;");
	} else if (array_key_exists('sub_as', $_POST)) {
		// Add staff
		$name = $_POST['as_name'];
		$pc = $_POST['as_branchPC'];
		$avail = $_POST['as_avail'];
		$sin = $_POST['as_SIN'];
		$pos = $_POST['as_pos'];
		$sch = $_POST['as_schedule'];
		$pw = $_POST['as_pw'];
		$sal = $_POST['as_sal'];
		$date = $_POST['as_date'];

		$staff = executePlainSQL("insert into Staff values($sin, $name, $pw, $avail);");
		$worksat = executePlainSQL("insert into WorksAt values($sin, $pc, $date, $pos, $sal);");

		if (preg_match("(.*waiter.*)|(.*Waiter.*)", $pos))
			executePlainSQL("insert int Waiter values($sin, $sch);");
		else if (preg_match("(.*manager.*)|(.*Manager.*)", $pos)) {
			executePlainSQL("insert into Manager values($sin);");
			executePlainSQL("update branch set sin=$sin where pc=$pc;");
		} else if (preg_match("(.*chef.*)|(.*Chef.*)", $pos))
			executePlainSQL("insert into Chef values($sin, $sch, null);");
		$result = "Add successful!";
		OCICommit($db_conn);
	} else if (array_key_exists('sub_ds', $_POST)) {
		//Delete Staff
		$sin = $_POST["ds_SIN"];
		$date = $_POST["ds_date"];
	    //add one tuple to HWA using info from WA
		executePlainSQL("insert into HasWorkedAt select sin, pc, since, $date, pos, salary from WorksAt where sin=$sin;");
		//delete a tuple from chef/manager/waiter if used to be one of them 
		executePlainSQL("delete from Chef where sin=$sin;");
		executePlainSQL("delete from Waiter where sin=$sin;");
		executePlainSQL("delete from Manager where sin=$sin;");
		// delete a tuple from WA
		executePlainSQL("delete from WorksAt where si=$sin;");
	
		// note: at least a branch is left without a manager 
		$result = "Delete Successful!";
		OCICommit($db_conn);
	} else if (array_key_exists('sub_es', $_POST)) {
			//Edit Staff
	
		$sin = $_POST["es_sin"];
		$spvisor = $_POST["es_supervisor"];
		$spvisee = $_POST["es_supervisee"];
		$selected_sor = $_POST["sub_es_supervisor"];
		$selected_see = $_POST["sub_es_supervisee"];
		$pos = $_POST["es_pos"];
		$pc = $_POST["es_pc"];
		$sal = $_POST["es_sal"];
		$date = $_POST["es_sdate"];
		$sch = $_POST["es_schedule"];

		if ($spvisor != 'SIN') {
			if ($selected_sor == "Add")
				executePlainSQL("insert into Supervises values($spvisor, $sin);");
			else if ($selected_sor == "Remove")
				executePlainSQL("delete from Supervises where sr_sin = $spvisor and jr_sin=$sin;");
			else
				echo "Please select add or remove.";
			$result = "Supervisor added! ";
		}
		if ($spvisee != 'SIN') {
			if ($selected_see == "Add")
				executePlainSQL("insert into Supervises values($sin, $spvisee);");
			else if ($selected_see == "Remove")
				executePlainSQL("delete from Supervises where jr_sin = $spvisee and sr_sin=$sin;");
			else
				echo "Please select add or remove.";
			$result .= "Supervisee added! ";
		}
		if($pos !='New Position') {
			$oldPos = executePlainSQL("select pos from WorksAt where sin=$sin;");
			// save wa to hwa
			executePlainSQL("insert into HasWorkedAt select $sin as sin, pc, sfrom, $date as to, pos, salary from WorksAt where sin=$sin;");
			
			// if chef, man, or waiter add
			if(preg_match("(.*waiter.*)|(.*Waiter.*)", $pos) && preg_match("(.*chef.*)|(.*Chef.*)", $oldPos)) {
				executePlainSQL("insert into Waiter select $sin as sin, schedule from Chef where sin=$sin;");
				executePlainSQL("delete from Chef where sin=$sin;");
			} else if (preg_match("(.*waiter.*)|(.*Waiter.*)", $pos) && preg_match("(.*manager.*)|(.*Manager.*)", $oldPos)){
				// insert new waiter tuple
				executePlainSQL("insert into Waiter values($sin, null);");
				// delete manager tuple
				executePlainSQL("delete from Manager where sin=$sin;");

				// note: a branch is now without a manager --> add a manager; waiter has no shifts
			} else if (preg_match("(.*chef.*)|(.*Chef.*)", $pos) && preg_match("(.*waiter.*)|(.*Waiter.*)", $oldPos)) {
				// insert new chef
				executePlainSQL("insert into Chef select $sin as sin, shifts as schedule, null as certificates from Waiter, where sin=$sin;");
				// delete waiter
				executePlainSQL("delete from Waiter where sin=$sin;");
				// note: chef has no certificates
			} else if (preg_match("(.*chef.*)|(.*Chef.*)", $pos) && preg_match("(.*manager.*)|(.*Manager.*)", $oldPos)){
				// insert new chef tuple
				executePlainSQL("insert into Chef values($sin, null, null);");
				// delete manager tuple
				executePlainSQL("delete from Manager where sin=$sin;");

				// note: a branch is now without a manager --> add a manager; chef has empty schedule and certificates
			} else if (preg_match("(.*manager.*)|(.*Manager.*)", $pos) && preg_match("(.*waiter.*)|(.*Waiter.*)", $oldPos)){
				// update man in branch table where pc = pc
				executePlainSQL("update Branch set sin=$sin where pc=$pc;");
				// insert new tuple to manager
				executePlainSQL("insert into manager values($sin);");
				// delete tuple from waiter
				executePlainSQL("delete from waiter where sin=$sin");

			} else if (preg_match("(.*Manager.*)|(.*manager.*)", $pos) && preg_match("(.*chef.*)|(.*Chef.*)", $oldPos)) {
				// update man in branch table where pc=pc
				executePlainSQL("update Branch set sin=$sin where pc=$pc;");
				// insert new table to manager
				executePlainSQL("insert into manager values($sin);");
				// delete tuple from chef
				executePlainSQL("delete from Chef where sin=$sin");

			} else if (preg_match("(.*Manager.*)|(.*manager.*)", $pos)) {
				executePlainSQL("insert into Manager values($sin);");
				executePlainSQL("update Branch set sin=$sin where pc=$pc;");

			} else if (preg_match("(.*Chef.*)|(.*chef.*)", $pos)) {
				executePlainSQL("insert into Chef values($sin, null, null);");
				//note: chef has no shifts or certificates
			} else if (preg_match("(.*Waiter.*)|(.*waiter.*)", $pos)){
				executePlainSQL("insert into Waiter values($sin, null);");
				// note: waiter has no shfits
			}
			// update pos in wa
			executePlainSQL("update WorksAt set pos=$pos where sin=$sin;");
			executePlainSQL("update WorksAt set salary=$sal where sin=$sin;");
			executePlainSQL("update WorksAt set pc=$pc where sin=$sin;");
			executePlainSQL("update WorksAt set since=$date where sin=$sin;");
			$result .= "New position added! ";

		}
		if($sch!=NULL) {// !!!!!!!!check this!!!!
			executePlainSQL("update Waiter set shifts=$sch where sin=$sin;");
			executePlainSQL("update Chef set schedule=$sch where sin=$sin;");
			$result .= "Schedule updated! ";
		}

		OCICommit($db_conn);
	} else if (array_key_exists('sub_es_avsal', $_POST)) {
		// set all to <= av salary 
		$result = executePlainSQL("select count(*) from WorksAt where salary > (select AVG(salary) from Staff natural inner join WorksAt);");
 		executePlainSQL("update Staff set salary = (select AVG(salary) FROM Staff natural inner join WorksAt)
 						 where salary > (select AVG(salary) from Staff natural inner join WorksAt);");
		$result .= " updated. ";
		OCICommit($db_conn);
	} /* else if (array_key_exists('sub_es_transfer', $_POST)) {
 		* transfer
 		* - args(branch)
 		* - 1 query
 		*		//!!!!!!
	} */ else if (array_key_exists('sub_es_supall', $_POST)) {
		// supervise all
		executePlainSQL("create VIEW WaitorWithMostPay AS SELECT w.sin FROM Waiter w, WorksAt wa1 WHERE w.sin = wa1.sin AND NOT EXIST 
			(SELECT * FROM WorksAt wa2 WHERE wa1.salary < wa2.salary);");
		executePlainSQL("create VIEW Candidate AS SELECT sin FROM WaitorWithMostPay w1 ORDER BY since;");
		executePlainSQL("insert INTO Supervises SELECT Candidate, sin FROM Waiter;");
		
		$result = "Supervising all. ";
		OCICommit($db_conn);

	} else if (array_key_exists('sub_ub', $_POST)) {
		// Update Branch	
		$pc = $_POST["ub_branch"];
		$budge = $_POST["ub_budget"];
		$performance = $_POST["ub_pfmce"];
		executePlainSQL("update branch set budge=$budget, performance=$performance;");

		$result = "Branch updated. ";
		OCICommit($db_conn);

	} else if (array_key_exists('sub_o_man', $_POST)){
		// Find branches managed by a manager
		$sin = $_POST['o_man'];
		$result = executePlainSQL("select pc from Branch where sin=$sin;");

	} else if (array_key_exists('sub_o_compare', $_POST)) {
		// Compare performances/		
		$res = $_POST["o_compare"];
		$result = executePlainSQL("select performance, pc from Branch where where rname=$res order by performance desc;");
	} else if (array_key_exists('sub_o_pop', $_POST)) {
		// Find the most popular dishes

		$res = $_POST["o_pop_res"];
		$result = executePlainSQL("select dish_name from SellsDish sd1 where rname = restaurant 
						and not exist (select * from SellsDish sd2 where sd1.popularity < sd2.popularity);");
	} else if (array_key_exists('sub_o_cust', $_POST)) {
		// Count #cust
		$pc = $_POST["o_cust_br"];
		$from = $_POST["o_cust_from"];
		$to = $_POST["o_cust_to"];

		$result = executePlainSQL("select SUM(num) FROM Visits WHERE v_date>=$from OR v_date<=$to AND pc=$pc;");
	}
	
	printResult($result);

OCILogoff($db_conn);
}
 ?>
</body>
</html>
