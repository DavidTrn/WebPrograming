<?php
	include("login.php");
	if(isset($_SESSION['userSession'])=="")
	{
		header("Location: home.php");
	} 
	$uploadcode = 0;
	if (isset($_GET['code'])){
  	$uploadcode = $_GET['code'];
} 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>User infomation</title>

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
  	<?php
    	include('header.php');
  	?>

	<div class="my-body-container">
		<div class="row">
			<div class="col-md-3" style="text-align: center; margin-top: 30px;">
				<div style="margin:0 auto; position: relative; width: 150px; height: 150px;">
					<img class="img-thumbnail" src="<?php echo ($row['AVATAR']!='')?$row['AVATAR']:'useravatar/avatar-default.png'?>" alt="avatar" width="150" height="150" id="useravatar" style="width: 150px; height: 150px;"> 
					<div id="hoveravatar">
					<a href="#" id="changeImage" style="position: absolute; bottom: 0; right: 0;"><i class="fa fa-pencil"></i></a>
					</div>
				</div>
				<div style="color: red; margin:2px;"><?php if ($uploadcode == 1) echo "Có lỗi khi tải hình, xin hãy kiểm tra lại"; ?></div>
				<h3 id="uname-profile" style="font-family: LatoFont;font-weight: bold;"></h3>
				<h5 id="user-role"><i><?php echo $row['EMAIL'] ?></i></h5>
				
			</div> 

				<form action="upload.php" enctype="multipart/form-data" method="post" name="avatarForm" id="form"><input type="file" name="urlimage" id="urlimage" style="visibility:hidden;" onchange="ins(<?php echo $row['USER_ID']; ?>)" /></form>

				
			<div class="col-md-5" style="background-color: rgba(255, 255, 255, 0.8); margin: 5px 0 0 0; padding: 20px 40px;">
			<form action="UpdateUserInfo.php" method="POST">
				<fieldset>
				<legend>Thông tin cá nhân</legend>
				<div id = "status-userinfo" style="display: block; padding: 0px; margin: 0px;">
					<?php if ($uploadcode == 2) {echo "<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Cập nhật thành công!</strong></div>" ;}
						elseif ($uploadcode == 3) {echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Cập nhật thất bại!</strong></div>";}
					?>
				</div>
					<div class="form-group">
						<label for="last-name">
							Họ và tên lót
						</label>
						<input type="text" class="form-control" id="last-name" name="last-name" pattern="[^!@#$%&*(){}\x22':|\;.,/?-+~]{2,}" title="Họ và tên lót không hợp lệ: không được chứa ký tự đặc biệt và phải nhiều hơn 6 ký tự" required>
						<div id="errl" class="error"></div>
					</div>
					<div class="form-group">
						<label for="first-name">
							Tên
						</label>
						<input type="text" class="form-control" id="first-name" name="first-name" pattern="[^!@#$%&*(){}\x22':|\;.,/?-+~]{2,}" title="Tên không hợp lệ: không được chứa ký tự đặc biệt và phải nhiều hơn 6 ký tự" required/>
						<div id="errf" class="error"></div>
					</div>
					<div class="form-group">
						 
						<label for="user-bday">
							Ngày sinh
						</label>
						<input type="date" class="form-control" id="user-bday" name="user-bday" required>
					</div>
					<div class="form-group">
						 
						<label for="user-phone">
							Số điện thoại
						</label>
						<input type="text" class="form-control" id="user-phone" name="user-phone" pattern="[0-9\x20]{8,}"/ title="Số điện thoại không hợp lệ: không được chứa ký tự và phải nhiều hơn 8 chữ số" required>
						<div id="errph" class="error"></div>
					</div>
					<div class="form-group">
						<label for="user-address">
							Địa chỉ
						</label>
						<input type="text" class="form-control" id="user-address" pattern="[^!@#$%&*(){}\x22':|\;/?-+~]{2,}"/title="Địa chỉ không hợp lệ: không được chứa ký tự và phải nhiều hơn 2 ký tự" name="user-address" required>
						<div id="erra" class="error"></div>
					</div>
					<div class="form-group">
						<label for="gender" style="margin-right: 20px;">
							Giới tính
						</label>
						<input id="male-gender" type="radio" style="margin: 0px 10px;" name="gender" value="Male" checked>Nam</input>
						<input id="female-gender" type="radio" style="margin: 0px 10px;" name="gender" value="Female" >Nữ</input>
					</div>
					<input type="submit" class="btn btn-success"  name="submit" value="Cập nhật">
					<!-- <button onclick="validateForm();" class="btn btn-success">
						Cập nhật
					</button> -->
				</fieldset>
				</form>
			</div>
			<div class="col-md-4" style="background-color: rgba(255, 255, 255, 0.8); margin: 5px 0 0 0; padding: 20px 40px;">
			<form action="ChangePassword.php" method="POST" onsubmit="return validate()">
				<fieldset>
				<legend>Thay đổi mật khẩu</legend>
				<div id = "status-changepass" style="display: block; padding: 0px; margin: 0px;">
					<?php if ($uploadcode == 4) {echo "<div class=\"alert alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Cập nhật thành công!</strong></div>" ;}
						elseif ($uploadcode == 5) {echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Cập nhật thất bại!</strong></div>"; }
					?>
				</div>
					<div class="form-group">
						 
						<label for="user-pass">
							Mật khẩu
						</label>
						<input type="password" class="form-control" name="user-pass" id="user-pass" pattern="[^'\x22]{8,}" title="Password không hợp lệ: không được chứa dấu nháy đơn và nháy kép, và phải nhiều hơn 8 ký tự" required />
						<div id="errp" class="error"></div>
					</div>
					<div class="form-group">
						 
						<label for="confirm-pass">
							Nhập lại mật khẩu
						</label>
						<input type="password" class="form-control" name="confirm-pass" id="confirm-pass" pattern="[^'\x22]{8,}" title="Password không hợp lệ: không được chứa dấu nháy đơn và nháy kép, và phải nhiều hơn 8 ký tự" required />
					</div>
					<input type="submit" name="submit" class="btn btn-success" value="Cập nhật">
					<!-- <button onclick="validatePass();" class="btn btn-success">
						Cập nhật
					</button> -->
				</fieldset>
				</form>
			</div>
		</div>
	</div>

</div>

<?php
	include('footer.php');
?>
<script src="js/modal-scripts.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript">
	$.ajax({
		url: "GetUserInfo.php",
		type: "GET",
		dataType: "json",
		success: function(jsonData) {
			$("#uname-profile").text(jsonData.uname);
			$("#last-name").val(jsonData.lname);
			$("#first-name").val(jsonData.fname);
			$("#user-bday").val(jsonData.bday);
			$("#user-phone").val(jsonData.phone);
			$("#user-address").val(jsonData.address);
			if (jsonData.gender == 1) {
				$("#male-gender").prop('checked',true);
				$("#female-gender").prop('checked',false);
			}
			else {
				$("#male-gender").prop('checked',false);
				$("#female-gender").prop('checked',true);
			}
		}
		
	});

	// function updateUserInfo(id) {
	// 	var fname  = $("#first-name").val();
	// 	var lname  = $("#last-name").val();
	// 	var bday   = $("#user-bday").val();
	// 	var phone  = $("#user-phone").val();
	// 	var address= $("#user-address").val();
	// 	var gender = 0;

	// 	if ($('input[name=gender]:checked').val() == "Male") {
	// 		gender = 1;
	// 	}
	// 	else {
	// 		gender = 0;
	// 	}
		
	// 	data = {uid:id, ufname:fname, ulname:lname, ubday:bday, uphone:phone, uaddress:address, ugender:gender};

	// 	dataSend = JSON.stringify(data);

	// 	$.ajax({
	// 		url: "UpdateUserInfo.php",
	// 		type: "POST",
	// 		data: dataSend,
	// 		dataType: "json",
	// 		success: function(jsonData) {
	// 			if (jsonData.status === 1) {
	// 				// $("#status-userinfo").html("<div class='alert alert-success' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Updated Success !</div><br>");
	// 				$("#status-userinfo").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Cập nhật thành công!</strong></div>');
	// 				$("#status-userinfo").css("display","block");
	// 			}
	// 			else if (jsonData.status === 0){
	// 				$("#status-userinfo").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Cập nhật thất bại!</strong></div>');
	// 				$("#status-userinfo").css("display","block");
	// 			}
	// 		}
	// 	});
	// }


	function validate(){
		var pass  = $("#user-pass").val();
		var confirmpass  = $("#confirm-pass").val();

		if (pass !== confirmpass){
			$("#status-changepass").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Mât khẩu nhập lại và mật khẩu không trùng nhau!</strong></div>');
			return false;
		}
	}
	// function changePass(id) {
	// 	var pass  = $("#user-pass").val();
	// 	var confirmpass  = $("#confirm-pass").val();

	// 	if (pass === confirmpass) {
	// 		data = {uid:id, upass:pass, uconfirmpass:confirmpass};

	// 		dataSend = JSON.stringify(data);

	// 		$.ajax({
	// 			url: "ChangePassword.php",
	// 			type: "POST",
	// 			data: dataSend,
	// 			dataType: "json",
	// 			success: function(jsonData) {
	// 				if (jsonData.status === 1) {
	// 					// $("#status-userinfo").html("<div class='alert alert-success' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Updated Success !</div><br>");
	// 					$("#status-changepass").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Cập nhật thành công!</strong></div>');
	// 					$("#status-changepass").css("display","block");
	// 				}
	// 				else if (jsonData.status === 0){
	// 					$("#status-changepass").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Cập nhật thất bại!</strong></div>');
	// 					$("#status-changepass").css("display","block");
	// 				}
	// 				else if (jsonData.status === 2){
	// 					$("#status-changepass").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Mât khẩu nhập lại và mật khẩu không trùng nhau!</strong></div>');
	// 					$("#status-changepass").css("display","block");
	// 				}
	// 			}
	// 		});
	// 	}
	// 	else {
	// 		$("#status-changepass").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Mât khẩu nhập lại và mật khẩu không trùng nhau!</strong></div>');
	// 		$("#status-changepass").css("display","block");
	// 	}
		
		
	// }

$('#changeImage').click(function(){
    $('#urlimage').trigger('click');
    return false;
});
     
// function validateForm(){
//         myclear();

//         var lname= $("#last-name").val();
//         if (lname.length<2 || lname.length>30) {
//           document.getElementById("errl").innerHTML = "Invalid Last name: must be 2-30 characters";
//           return false;
//         }
//         if (!((lname>='a' && lname<='z') || (lname>='A' && lname<='Z'))) {
//         	document.getElementById("errl").innerHTML = "Invalid First name: must not contain special characters";
//           return false;
//         }

//         var fname = $("#first-name").val();
//         if (fname.length<2 || fname.length>30) {
//           document.getElementById("errf").innerHTML = "Invalid First name: must be 2-30 characters";
//           return false;
//         }
//         if (!((fname>='a' && fname<='z') || (fname>='A' && fname<='Z'))) {
//         	document.getElementById("errf").innerHTML = "Invalid First name: must not contain special characters";
//           return false;
//         }
        
//         var phone= $("#user-phone").val();
//         if (phone.length<8 || phone.length>20) {
//           document.getElementById("errph").innerHTML = "Invalid phone number";
//           return false;
//         }
//         if (phone<'0' || phone>'9') {
//           document.getElementById("errph").innerHTML = "Invalid phone number, content character";
//           return false;
//         }

//        	var add= $("#user-address").val();
//         if (add.length<2 || add.length>30) {
//           document.getElementById("erra").innerHTML = "Invalid address";
//           return false;
//         }

        

//         //updateUserInfo(<?php echo $_SESSION['userSession'] ?>);
//       }

// function validatePass(){
// 	myclear();	
// 	var pass= $("#user-pass").val();
//         if (pass.length<8 || pass.length>20) {
//           document.getElementById("errp").innerHTML = "Invalid Password: must be 8-20 characters";
//           return false;
//         }

//         //changePass(<?php echo $_SESSION['userSession'] ?>);
// }

//       function myclear(){
//         document.getElementById("errf").innerHTML = "";
//         document.getElementById("errl").innerHTML = "";
//         document.getElementById("errph").innerHTML = "";
//         document.getElementById("erra").innerHTML = "";
//         document.getElementById("errp").innerHTML = "";
//       }


 function ins(userid){
 	var urlimage = document.getElementById("urlimage").value;
//  	$.ajax({
//  		url: "upload.php",
// 		type: "POST",
// 		data: {urlimage:urlimage},
// 		dataType: "json",
// 		success: function(jsonData) {
// 			alert("1");
// 			switch (jsonData.code){
// 				case 0:
// 				alert(jsonData.src);
				

// 			var xmlhttp = new XMLHttpRequest();
// 			xmlhttp.onreadystatechange = function() {
// 				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
// 					alert(xmlhttp.responseText);
// 				}
// 			};
// 			xmlhttp.open("GET", "insert.php?urlimage=" + jsonData.src, true);
// 			xmlhttp.send();
// 					$("#useravatar").attr("src",jsonData.src);
// 					break;
// 				case 1:
// 					break;
// 			}
// 		}
// });
		document.getElementById('form').submit();
		//var str4 = "useravatar/" + urlimage.split(/(\\|\/)/g).pop();
		var str4 = "useravatar/" + userid;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					
				}
			};
			xmlhttp.open("GET", "insert.php?urlimage=" + str4, true);
			xmlhttp.send();
			$("#useravatar").attr("src","str4");
			$("#useravatar").attr("src",str4);

 	
			
			
			
		}

</script>

</body>
</html>