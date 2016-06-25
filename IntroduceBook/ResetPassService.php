<?PHP
	require_once("./include/membersite_config.php");

	$emailsent = false;
	if(isset($_POST['submitted']))
	{
	   if($fgmembersite->EmailResetPasswordLink())
	   {
	        
	        $fgmembersite->RedirectToURL("TksResetPass.php");
	        exit;
	   }
	   else {
	   		$fgmembersite->RedirectToURL("SendLinkResetPassError.php");
	   }
	}
	else {
		$out = [];
		$out['status'] = 2;
		echo json_encode($out);
	}

?>