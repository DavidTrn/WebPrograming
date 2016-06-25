<?php
	session_start();
	include("dbconnect.php");


	$query = $MySQLi_CON->query("SELECT * FROM users WHERE USER_ID=".$_SESSION['userSession']);
	// $query = $MySQLi_CON->query("SELECT * FROM users WHERE USER_ID=1");

	$row = $query->fetch_array();
	$count = $query->num_rows;
	
	if ($count != 0) {
		$obj = [];
		$obj['uname'] = $row['USERNAME'];
		$obj['bday'] = $row['BIRTHDAY'];
		$obj['address'] = $row['ADDRESS'];
		$obj['phone'] = $row['PHONE'];
		$obj['fname'] = $row['FIRSTNAME'];
		$obj['lname'] = $row['LASTNAME'];
		$obj['gender'] = $row['GENDER'];

		echo json_encode($obj);

	}
	else {
		echo json_encode("Khong tim thay du lieu nguoi dung!");
	}
	
	$MySQLi_CON->close();


?>