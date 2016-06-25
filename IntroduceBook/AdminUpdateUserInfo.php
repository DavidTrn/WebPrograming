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
	  		$id = $input->uid;
	  		$fname = $input->ufname;
	  		$lname = $input->ulname;
	  		$bday = $input->ubday;
		    $phone = $input->uphone;
			$address  = $input->uaddress;
			$gender = $input->ugender;

			$query = "UPDATE users SET LASTNAME='$lname', FIRSTNAME='$fname', BIRTHDAY='$bday', PHONE='$phone', ADDRESS='$address', GENDER='$gender' WHERE USER_ID=".$id;

			if($MySQLi_CON->query($query))
			{
				$obj = [];
				$obj['status'] = 1;
				echo json_encode($obj);
				// $msg = "<div class='alert alert-success'>
				// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
				// 		</div>";
			}
			else
			{
				$obj = [];
				$obj['status'] = 0;
				echo json_encode($obj);
				// $msg = "<div class='alert alert-danger'>
				// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
				// 		</div>";
			}
			
			$MySQLi_CON->close();

	    	break;
	  	case 'DELETE':
	    	break;
	}
?>