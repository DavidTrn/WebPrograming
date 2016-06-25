<?php
	session_start();

	include_once 'dbconnect.php';
	$email = $_REQUEST['email'];
	$type = $_REQUEST['type'];
	$query = mysqli_query($MySQLi_CON, "SELECT * FROM subscribers WHERE email='".$email."'");

	if(mysqli_num_rows($query) > 0){
		if ($type == 1){
		$result = array("code"=>2);	
    	echo json_encode($result);}
    	else {
    		$query = mysqli_query($MySQLi_CON, "DELETE FROM subscribers WHERE email='".$email."'");
    		$result = array("code"=>0);	
    		echo json_encode($result);
    	}

	}else{
		if ($type == 1){
   		$query = mysqli_query($MySQLi_CON, "INSERT INTO subscribers (EMAIL) VALUES ('$email')");
    	$result = array("code"=>1);	
    	echo json_encode($result);}
    	else {
    		$result = array("code"=>3);	
    		echo json_encode($result);}
    }
	
		$MySQLi_CON->close();	
?>