<!DOCTYPE HTML>
<html> 
<body>
<p><font size='6'> MANAGER </font></p>

<br><br>

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

<p><b>Delete Staff:</b></p>
<p> <font size='2'> SIN: </font><input type='text' name='ds_SIN'>
	<input type='submit' name='sub_ds' value='Delete'>
</p>

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

<font size='3'>Set the salary of the staff whose pay is higher than the average to be the average.</font>
<input type='submit' name='sub_es_avsal' value='Set'>
<br><br>
<form action='manhome.php' method='post'>
<font size='3'>Transfer all the staff members that have worked at <input type='text' name='es_transfer' value='Branch Postal Code'> but no longer work there to that branch in their current positions.</font>
<input type='submit' name='sub_es_transfer' value='Transfer'>
</form><br>
<font size='3'>Find the waiter with the highest pay and make him supervise all the other waiters</font>
<input type='submit' name='sub_es_supall' value='Set'>
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
<form action='manhome.php' method='post'>
<font size='3'>Compare performances of managers managing branches of</font>
<input type='text' name='o_compare' value='Restaurant Name'>
<input type='submit' name='sub_o_compare' value='Compare'></form><br>

<form action='manhome.php' method='post'>
<font size='3'>Find the most popular dishes:</font><br>
<input type='text' name='o_pop_res' value='Restaurant Name'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='o_pop_reg' value='City or Province'>
<input type='submit' name='sub_o_pop' value='Search'></form><br>

<form action='manhome.php' method='post'>
<font size='3'>Count the number of customers that have visited
	<input type='text' name='o_cust_br' value='Branch Postal Code'>
	on <input type='text' name='o_cust_date' value='Date in yyyymmdd'></font>
<input type='submit' name='sub_o_cust' value='Submit'></form><br>

<!-- 

FIND STAFF (return name, sin, WA and HWA, shifts/schedule/certificates)
- staff list
- by name
- by sin
- by branch pc
- add staff (ADD WA)
- delete staff (move WA to HWA)

EDIT STAFF
- enter sin 
- add supervisor/remove supervisor
- add supervisee/remove supervisee
- move staff to another pos (change WA and HWA)
- change shifts and schedule
- set the salary of the staff whose pay is higher than the average to be the average
- transfer all the staff members that have worked at a specific branch but no longer work there to that branch in their current positions
- Find the waiter with the highest pay and make him supervise all the other waiters

OTHERS
- compare performances
- Find the most popular dishes of a restaurant in a region (city or province)
- Find and count all the users that have visited a branch on a specific day
- Find and compare the performances of other managers of a given restaurant

UPDATE BRANCH:
- update budget and performance (branch, budge, performance)

--> 




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

$login = $_POST['user'];
if ($db_conn){
	if (array_key_exists('sub_fs_list', $_POST)){
		/* View staff list
 		 * - return a list of staff (sin, name, branch)
	 	 * - 1 query
	 	 */

	} else if (array_key_exists('sub_fs_SIN', $_POST)){
/* Find staff by sin
	 * - args(sin)
	 * - return staff with that sin (sin, name, branch)
	 * - 1 query
	 */
	} else if (array_key_exists('sub_fs_name', $_POST)) {

/* Find staff by Name
	 * - args(name)
	 * - return list of staff with that name (sin, name, branch)
	 * - 1 query
	 */
		$name = $_POST['fs_name'];
		$result = executePlainSQL('select name, sin from staff s, worksat w where name=&name! and s.sin=w.sin and w.pc in (select pc from worksat where sin=$login!);');
	
	} else if (array_key_exists('sub_fs_branch', $_POST)) {
/* Find staff by branch
	 * - args(branch pc)
	 * - return list of staff working at the branch (sin, name, branch)
	 * - 1 query
	 */		
	} else if (array_key_exists('sub_as', $_POST)) {
/* Add staff
	 * - args(name, sin, pw, pc, pos, sal, avail, sch, sdate)
	 * - add new tuple to Staff and WorksAt
	 * - 2 queries
	 */		
	} else if (array_key_exists('sub_ds', $_POST)) {
/* Delete Staff
	 * - args(sin)
	 * - add one tuple to HWA using info from WA
	 * - delete a tuple from chef/manager/waiter if used to be one of them 
	 * - delete a tuple from WA
	 * - 2-3 queries
	 */		
	} else if (array_key_exists('sub_es', $_POST)) {
/* Edit Staff
	 * - args() --> a lot
	 * - store sin
	 * - check each op one by one --> perform op if input not null   !!! no input == null????
	 *   - supervisor sin, add/remove
	 *   - supervisee, add/remove
	 *   - new pos
	 *   - new schedule
	 *   - set sal
	 *   - transfer
	 *   - supervise all
	 * - 9 queries, 11 if's (ish)
	 */		
	} else if (array_key_exists('sub_es_avsal', $_POST)) {
/* set sal
 * - no args
 * - 1 query
 */
		
	} else if (array_key_exists('sub_es_transfer', $_POST)) {
/* transfer
 * - args(branch)
 * - 1 query
 */		
	} else if (array_key_exists('sub_es_supall', $_POST)) {
/* supervise all
 * - no args
 * - 1 query
 */		
	} else if (array_key_exists('sub_ub', $_POST)) {
/* Update Branch
	 * - args(pc, budget, performance)
	 * - update a tuple in Branch
	 * - 1 query
	 */		
	} else if (array_key_exists('sub_o_compare', $_POST)) {
/* Compare performances
	 * - args(restaurant)
	 * - return a list of performances, managers, branches ordered by performance
	 * - 1 query
	 */		
	} else if (array_key_exists('sub_o_pop', $_POST)) {
/* Find the most popular dishes
	 * - args(restaurant, region)
	 * - assume region is province --> if null assume region is city 
	 * - 2 queries; 1 if
	 */		
	} else if (array_key_exists('sub_o_cust', $_POST)) {
/* Count #cust
	 * - args(pc, date)
	 * - return a num, branch, date
	 * - 1 query */		
	}
	

OCILogoff($db_conn);
}
 ?>
</body>
</html>
