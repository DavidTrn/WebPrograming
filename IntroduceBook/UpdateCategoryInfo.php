<?php
	session_start();
	include("dbconnect.php");


	$input = (object) json_decode(file_get_contents('php://input'),true);

	$method = $_SERVER['REQUEST_METHOD'];
	switch ($method) {
	  	case 'GET':
	    	break;
	  	case 'PUT':
	    	break;
	  	case 'POST':
	  		$cid = $MySQLi_CON->real_escape_string(trim($input->cid));
	  		$cname = $MySQLi_CON->real_escape_string(trim($input->cname));
			$cdis = $MySQLi_CON->real_escape_string(trim($input->cdis));

			$query = "UPDATE categories SET CATEGORY_NAME='$cname', DISCRIPTION='$cdis' WHERE CATEGORY_ID='$cid'";

			if($MySQLi_CON->query($query))
			{
				$obj = [];
				$obj['status'] = 1;
				echo json_encode($obj);
			}
			else
			{
				$obj = [];
				$obj['status'] = 0;
				echo json_encode($obj);
			}
			
			$MySQLi_CON->close();

	    	break;
	  	case 'DELETE':
	    	break;
	}
?>