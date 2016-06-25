<?php
	include('dbconnect.php');

	if(isset($_GET['listUsers'])) {
		include('UserList.php');
	}

	//close the connection
	$MySQLi_CON->close();

?>