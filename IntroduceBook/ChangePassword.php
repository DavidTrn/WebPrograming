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
	  		$id = $_SESSION['userSession'];
			$pass = $_POST['user-pass'];
			$confirmpass = $_POST['confirm-pass'];

			if ($pass===$confirmpass) {
				$hashpass = password_hash($pass, PASSWORD_DEFAULT);
				$query = "UPDATE users SET PASSWORD='$hashpass' WHERE USER_ID=".$id;

				if($MySQLi_CON->query($query))
				{
					// $obj = [];
					// $obj['status'] = 1;
					// echo json_encode($obj);
					$MySQLi_CON->close();
					header("location: ./UserInfo.php?code=4");
					// $msg = "<div class='alert alert-success'>
					// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
					// 		</div>";
				}
				else
				{
					// $obj = [];
					// $obj['status'] = 0;
					// echo json_encode($obj);
					$MySQLi_CON->close();
					header("location: ./UserInfo.php?code=5");
					// $msg = "<div class='alert alert-danger'>
					// 			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
					// 		</div>";
				}
			}
			else {
				$obj = [];
				$obj['status'] = 2;
				echo json_encode($obj);
			}

			//$MySQLi_CON->close();

	    	break;
	  	case 'DELETE':
	    	break;
	}
?>