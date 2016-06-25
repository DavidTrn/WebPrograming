<?php
	include("login.php");
	if($_SESSION['userSession']=="")
	{
		header("Location: home.php");
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admin Comments</title>

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
		<div id="content-admin-comment-page" class="col-md-10">
			<div class="row">
				<span>
					<h2 class="title-content">Comments</h2>
				</span>	
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="navbar navbar-right" style="margin-right: 20px;">
						<div class="form-group" style="display: inline-block;">
							<input type="text" id="keysearch" class="form-control" placeholder="Enter username here">
						</div> 
						<button onclick="searchComment();" class="btn btn-default" style="display: inline-block;">
							Search Comments
						</button>
					</div>
				</div>
				<div class="col-md-12" style="margin-bottom: 20px;">
					<select id="selectDelCommentOpt" class="form-control">
					  	<option value="title-action">Choose action...</option>
					  	<option value="delete">Delete</option>
					</select>
					<button class="btn btn-default" onclick="deleteSelected();" style="margin-right: 10px;">Apply</button>
					
				</div>
				<div class="col-md-12">
					<div id="admin-comments-list" class="table-responsive">
						
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
		$("#headingFive").css({"color":"#5cb85c"});
	});
	$.ajax({
		url: "ManageComments.php?listcomments",
		type: "get",
		dataType:"html",
		success: function(dataReceive){
			$("#admin-comments-list").html(dataReceive);
		}
	});
	function deleteComment(id) {
		$.ajax({
			url: "ManageComments.php?lstDel=" + id,
			type:"get",
			dataType:"html",
			success: function(dataReceive){
				$("#admin-comments-list").html(dataReceive);
			}

		});
	}

	// function showCommentInfo(id) {
	// 	$.ajax({
	// 		url: "ManageBooks.php?show_b_id=" + id,
	// 		type:"get",
	// 		dataType:"html",
	// 		success: function(dataReceive){
	// 			$("#content-admin-book-page").html(dataReceive);
	// 		}

	// 	});
	// }

	function deleteSelected() {
		if ($('#selectDelCommentOpt option:selected').text() == 'Delete') {
			askModal.style.display = "block";
	    	btnAskAccept.onclick = function() {
		    	var commentSelected = document.getElementsByClassName("commentSelect");
				var listDelete = "";

				for (i=0; i<commentSelected.length;i++) {
					if (commentSelected[i].checked) {
						str = commentSelected[i].id.toString();
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
						url: "ManageComments.php?lstDel=" + listDelete,
						type:"get",
						dataType:"html",
						success: function(dataReceive){
							$("#admin-comments-list").html(dataReceive);
						}

					});
				}
		    	askModal.style.display = "none";
		    	$("#selectDelCommentOpt").val("title-action");

		    }
			
		}
		
	}

	function searchComment(){
		var keysearch = document.getElementById('keysearch').value;
		if (keysearch != "") {
			$.ajax({
				url: "ManageComments.php?keysearch=" + keysearch,
				type: "get",
				dataType: "html",
				success: function(dataReceive){
					$("#admin-comments-list").html(dataReceive);
				}

			});
		}
	}

	// Get the modal
	var askModal = document.getElementById('askModal');
	var btnAskAccept = document.getElementById('btnAskAccept');

	// When the user clicks on the button, open the modal 
	function confirmDelete(id) {
		if ($('#selectDelCommentOpt option:selected').text() == 'Delete') {
			$("#selectDelCommentOpt").val("title-action");
		}

		askModal.style.display = "block";
	    btnAskAccept.onclick = function() {
	    	deleteComment(id);
	    	askModal.style.display = "none";

	    }
	    
	}

	function askDismiss() {
		askModal.style.display = "none";
	}

</script>

</body>
</html>