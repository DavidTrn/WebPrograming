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
	<form action="ResetPassService.php" method="POST" accept-charset='UTF-8'>
		<fieldset style="width: 80%;">
			<legend>Quên mật khẩu</legend>

			<input type='hidden' name='submitted' id='submitted' value='1'/>

			<div class='short_explanation'>* phải nhập</div>
			<br>
			<div><span class='error'></span></div>
		    <div class="form-group">		 
				<label for="reset-email">
					Địa chỉ Email * :
				</label>
				<input type="text" name = "email" class="form-control" id="reset-email"/>
			</div>

		    <span id='resetreq_email_errorloc' class='error'></span>
		    <br>
		    <span id='resetreq_email_errorloc' class='error'></span>
			<div class='short_explanation'>Một đường link để bạn đặt lại mật khẩu sẽ được gửi tới địa chỉ email của bạn</div>
			<br>
			<input class="btn btn-success" type='submit' name='Submit' value='Submit' />

		</fieldset>
	</form>
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
		alert(dataSend);

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