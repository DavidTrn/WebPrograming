<?php
	session_start();
	include("dbconnect.php");


	//$input = (object) json_decode(file_get_contents('php://input'),true);

	$method = $_SERVER['REQUEST_METHOD'];
	switch ($method) {
	  	case 'GET':
	    	break;
	  	case 'PUT':
	    	break;
	  	case 'POST':
	  		$id = $_SESSION["userSession"];
	  		$fname = $_POST["first-name"];
	  		$lname = $_POST["last-name"];
	  		$bday = $_POST["user-bday"];
		    $phone = $_POST["user-phone"];
			$address  = $_POST["user-address"];
			$gender = ($_POST["gender"] == "Male")?1:0;

			$query = "UPDATE users SET LASTNAME='$lname', FIRSTNAME='$fname', BIRTHDAY='$bday', PHONE='$phone', ADDRESS='$address' WHERE USER_ID=".$id;

			if($MySQLi_CON->query($query))
			{
				//$obj = [];
				//$obj['status'] = 1;
				$MySQLi_CON->close();
				header("location: ./UserInfo.php?code=2");
				//echo json_encode($obj);
				// $msg = "<div class='alert alert-success'>
				// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
				// 		</div>";
			}
			else
			{
				//$obj = [];
				//$obj['status'] = 0;
				$MySQLi_CON->close();
				header("location: ./UserInfo.php?code=3");
				//echo json_encode($obj);
				// $msg = "<div class='alert alert-danger'>
				// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
				// 		</div>";
			}
			
			

	    	break;
	  	case 'DELETE':
	    	break;
	}
?>