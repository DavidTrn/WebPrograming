<?php
	include("login.php");
	if($_SESSION['userSession']=="")
	{
		header("Location: Home.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admin Home</title>

    <meta name="author" content="3D1A Team!">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
	include('AdminHeader.php');
?>

<div class="container-fluid" style="margin-left: 10px;">
	<div class="row">

		<?php
			include('LeftSideAdminPage.php');
		?>
		
		<div class="col-md-10">
			<div class="dashboard-container">
				<div class="dashboard-content">
					<div class="dashboard-title">Hello, <?php echo $row['USERNAME'] ?></div>
                    <br>
					<div class="dashboard-title">Welcome back!</div>
				</div>
			</div>        	
    	</div>		
			
	</div>
</div>

<script src="js/modal-scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript">
	$(document).ready(function (){
		$("#headingOne").css("color","#5cb85c");
	});
</script>

</body>
</html>