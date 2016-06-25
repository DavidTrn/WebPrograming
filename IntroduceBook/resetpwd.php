<?php
	include("login.php");
	require_once("./include/membersite_config.php");

	$success = false;
	if($fgmembersite->ResetPassword())
	{
	    $success=true;
	    header("Location: SuccessSendResetPass.php");
	}
	else {
		header("Location: FailToSendResetPass.php");
	}
	
?>
