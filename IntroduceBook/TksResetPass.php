<?php
	include("login.php");
	if($_SESSION['userSession']!="")
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

	<title>Reset Password</title>

    <meta name="author" content="3D1A Team!">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">  
 
</head>
<body>

<?php
	include('modal.php');
?>

<div class="container-fluid">

	<!-- insert header and slider -->
	<?php
		include('header.php');
	?>
	<div class="col-md-3"></div>
	<div class="col-md-6" style="margin: 100px 0px;">
		<div>
			<h2>Link đặt lại mật khẩu đã được gửi</h2>
			Một đường link đặt lại mật khẩu đã được gửi tới email của bạn. Vui lòng kiểm tra email.
			<br>
			<br>
			<a class="btn btn-success" href="Home.php">Đến trang chủ</a>
		</div>
	</div>
	<div class="col-md-3"></div>

</div>

<?php
	include('footer.php');
?>

<script src="js/modal-scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
<script>
	$(document).ready(function(){
		$("#whatsearch").keyup(function() {
			$("#livesearch").show();	
			var x= $(this).val();
			$.ajax({
				url: "GetSearch.php",
				type: "POST",
				dataType: "json",
				data: 'res='+x,
				success:function(data) {
						liveSearch(data);

				}
			});
		});
	});

	function sendEmailToResetPass() {
		var email = document.getElementById('reset-email').value;
		
		data = {submitted:1, email:email};

		dataSend = JSON.stringify(data);

		$.ajax({
			// The link we are accessing.
			url: "ResetPassService.php",
				
			// The type of request.
			type: "POST",

			// Data send
			data: dataSend,
				
			// The type of data that is getting returned.
			dataType: "json",

			success: function(jsonData){
				// var json_obj = $.parseJSON(jsonData);//parse JSON
				
			}
		});
	}


	function liveSearch(response) {
    var i,j;
    var out="";
    for(i = 0; i < response.length; i++) {
    
    	out +='<a class="form-control" href="' +response[i].Link+ '">' +response[i].Name+'</a>' ;
    	}
    	document.getElementById("livesearch").innerHTML =out;
	    out=""; 
	}
</script>
</body>
</html>