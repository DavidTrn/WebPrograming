<?php
	include("dbconnect.php");

	if (isset($_GET['lstChange']) && isset($_GET['role'])){
		$uids = explode(",", $_GET['lstChange']);
		for ($i=0; $i<sizeof($uids); $i++){
			$sql = 'UPDATE users SET ROLE="'.$_GET['role'].'" WHERE USER_ID = '.$uids[$i];
			$retval = $MySQLi_CON->query($sql);
			if(!$retval )
			{
			  die('Could not update data: ' . mysqli_error());
			}
			
		}
		
	}

	include('UserList.php');

	//close the connection
	$MySQLi_CON->close();	

?>