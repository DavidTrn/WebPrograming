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

	<title>Admin Users</title>

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
	include('askmodal.php');
?>

<div class="container-fluid" style="margin-left: 10px;">
	<div class="row">
		<?php
			include('LeftSideAdminPage.php');
		?>
		<div id="content-admin-user-page" class="col-md-10">
			<div class="row">
				<span>
					<h2 class="title-content">Users</h2>
				</span>	
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="navbar navbar-right" style="margin-right: 20px;">
						<div class="form-group" style="display: inline-block;">
							<input type="text" id="keysearch" class="form-control" placeholder="Enter username or email">
						</div> 
						<button onclick="searchUser();" class="btn btn-default" style="display: inline-block;">
							Search User
						</button>
					</div>
				</div>
				<div class="col-md-12" style="margin-bottom: 20px;">
					<select id="selectDelUserOpt" class="form-control">
					  	<option value="title-action">Choose action...</option>
					  	<option value="delete">Delete</option>
					</select>
					<button class="btn btn-default" onclick="deleteSelected();" style="margin-right: 10px;">Apply</button>
					
					<select id="selectRoleUserOpt" class="form-control">
					  	<option value="title-role">Change role to...</option>
					  	<option value="admin">Admin</option>
					  	<option value="customer">Member</option>
					</select>
					<button class="btn btn-default" onclick="changeRole();">Change</button>
				</div>
				<div class="col-md-12">
					<div id="admin-users-list" class="table-responsive">
						
					</div>
				</div>
			</div>
			<div id="page-wrapper">
                <div class="graphs" style="border-top: 1px solid #ccc;padding:20px 0px;">      
                    <div class="copy" style="text-align: center;">
                        <strong style="font-family: LatoFont;font-weight: bold">Copyright &copy; 2016 3D1A's Admin All Rights Reserved | Design by <a href="Contact.php" target="_blank">3D1A Team</a> </strong>
                    </div>
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
		$("#headingTwo").css({"color":"#5cb85c"});
	});
	$.ajax({
		url: "GetListUsers.php?listUsers",
		type: "get",
		dataType:"html",
		success: function(dataReceive){
			$("#admin-users-list").html(dataReceive);
		}
	});
	function deleteUser(id) {
		$.ajax({
			url: "DeleteUser.php?lstDel=" + id,
			type:"get",
			dataType:"html",
			success: function(dataReceive){
				$("#admin-users-list").html(dataReceive);
			}

		});
	}

	function updateUserInfo(id) {
		var fname  = $("#fname").val();
		var lname  = $("#lname").val();
		var bday   = $("#ubday").val();
		var phone  = $("#uphone").val();
		var address= $("#uaddress").val();
		var gender = 0;


		if ($('input[name=gender]:checked').val() == "Male") {
			gender = 1;
		}
		else {
			gender = 0;
		}
		
		data = {uid:id, ufname:fname, ulname:lname, ubday:bday, uphone:phone, uaddress:address, ugender:gender};

		dataSend = JSON.stringify(data);

		$.ajax({
			url: "AdminUpdateUserInfo.php",
			type: "POST",
			data: dataSend,
			dataType: "json",
			success: function(jsonData) {
				if (jsonData.status === 1) {
					// $("#status-userinfo").html("<div class='alert alert-success' style='margin-bottom:0px;'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Updated Success !</div><br>");
					$("#status-userinfo").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Update successfully!</strong></div>');
					$("#status-userinfo").css("display","block");
				}
				else if (jsonData.status === 0){
					$("#status-userinfo").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Update fail!</strong></div>');
					$("#status-userinfo").css("display","block");
				}
			}
		});
	}

	function showUserInfo(id) {
		$.ajax({
			url: "ShowUserInfo.php?uid=" + id,
			type:"get",
			dataType:"html",
			success: function(dataReceive){
				$("#content-admin-user-page").html(dataReceive);
			}

		});
	}

	function deleteSelected() {
		if ($('#selectDelUserOpt option:selected').text() == 'Delete') {
			askModal.style.display = "block";
	    	btnAskAccept.onclick = function() {
		    	var userSelected = document.getElementsByClassName("userSelect");
				var listDelete = "";

				for (i=0; i<userSelected.length;i++) {
					if (userSelected[i].checked) {
						str = userSelected[i].id.toString();
						index = str.split("-");
						if (listDelete == "")
							listDelete += index[1];
						else {
							listDelete += ',';
							listDelete += index[1];
						}

					}
				}

				if (listDelete != "") {
					$.ajax({
						url: "DeleteUser.php?lstDel=" + listDelete,
						type:"get",
						dataType:"html",
						success: function(dataReceive){
							$("#admin-users-list").html(dataReceive);
						}

					});
				}
		    	askModal.style.display = "none";
		    	$("#selectDelUserOpt").val("title-action");

		    }
			
		}
		
	}

	function changeRole() {
		if ($('#selectRoleUserOpt option:selected').val() != 'title-role') {
			
	    	var userSelected = document.getElementsByClassName("userSelect");
			var listChange = "";

			for (i=0; i<userSelected.length;i++) {
				if (userSelected[i].checked) {
					str = userSelected[i].id.toString();
					index = str.split("-");
					if (listChange == "")
						listChange += index[1];
					else {
						listChange += ',';
						listChange += index[1];
					}

				}
			}

			if (listChange != "") {
				role = $('#selectRoleUserOpt option:selected').text();
				$.ajax({
					url: "ChangeRoleUser.php?lstChange=" + listChange + "&role=" + role,
					type:"get",
					dataType:"html",
					success: function(dataReceive){
						$("#admin-users-list").html(dataReceive);
					}

				});
			}			
		}
	}

	function searchUser(){
		var keysearch = document.getElementById('keysearch').value;
		if (keysearch != "") {
			$.ajax({
				url: "UserSearchPage.php?keysearch=" + keysearch,
				type: "get",
				dataType: "html",
				success: function(dataReceive){
					$("#admin-users-list").html(dataReceive);
				}

			});
		}
	}

	// Get the modal
	var askModal = document.getElementById('askModal');
	var btnAskAccept = document.getElementById('btnAskAccept');

	// When the user clicks on the button, open the modal 
	function confirmDelete(id) {
		if ($('#selectDelUserOpt option:selected').text() == 'Delete') {
			$("#selectDelUserOpt").val("title-action");
		}

		askModal.style.display = "block";
	    btnAskAccept.onclick = function() {
	    	deleteUser(id);
	    	askModal.style.display = "none";

	    }
	    
	}

	function askDismiss() {
		askModal.style.display = "none";
	}

</script>

</body>
</html>