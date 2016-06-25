<?PHP
	require_once("./include/membersite_config.php");

	$emailsent = false;
	if(isset($_POST['submitted']))
	{
	   if($fgmembersite->EmailContact())
	   {
	        
	        $fgmembersite->RedirectToURL("TksContact.php");
	        exit;
	   }
	   else {
	   		$fgmembersite->RedirectToURL("ErrorContact.php");
	   }
	}
	else {
		$out = [];
		$out['status'] = 2;
		echo json_encode($out);
	}

?>