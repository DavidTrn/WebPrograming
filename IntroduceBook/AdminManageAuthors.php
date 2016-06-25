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

	<title>Admin Books</title>

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
		<div id="content-admin-author-page" class="col-md-10">
			<div class="row">
				<span>
					<h2 class="title-content">Authors</h2>
					<button class="btn btn-primary" onclick="showFormAddAuthor();">Add Author</button>
				</span>	
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="navbar navbar-right" style="margin-right: 20px;">
						<div class="form-group" style="display: inline-block;">
							<input type="text" id="keysearch" class="form-control" placeholder="Enter name of author here">
						</div> 
						<button onclick="searchAuthor();" class="btn btn-default" style="display: inline-block;">
							Search Author
						</button>
					</div>
				</div>
				<div class="col-md-12" style="margin-bottom: 20px;">
					<select id="selectDelAuthorOpt" class="form-control">
					  	<option value="title-action">Choose action...</option>
					  	<option value="delete">Delete</option>
					</select>
					<button class="btn btn-default" onclick="deleteSelected();" style="margin-right: 10px;">Apply</button>
					
				</div>
				<div class="col-md-12">
					<div id="admin-authors-list" class="table-responsive">
						
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
		$("#headingSix").css({"color":"#5cb85c"});
	});
	$.ajax({
		url: "ManageAuthors.php?listauthors",
		type: "get",
		dataType:"html",
		success: function(dataReceive){
			$("#admin-authors-list").html(dataReceive);
		}
	});
	function deleteAuthor(id) {
		$.ajax({
			url: "ManageAuthors.php?lstDel=" + id,
			type:"get",
			dataType:"html",
			success: function(dataReceive){
				$("#admin-authors-list").html(dataReceive);
			}

		});
	}

	function showAuthorInfo(id) {
		$.ajax({
			url: "ManageAuthors.php?show_author_id=" + id,
			type:"get",
			dataType:"html",
			success: function(dataReceive){
				$("#content-admin-author-page").html(dataReceive);
			}

		});
	}

	function deleteSelected() {
		if ($('#selectDelAuthorOpt option:selected').text() == 'Delete') {
			askModal.style.display = "block";
	    	btnAskAccept.onclick = function() {
		    	var authorSelected = document.getElementsByClassName("authorSelect");
				var listDelete = "";

				for (i=0; i<authorSelected.length;i++) {
					if (authorSelected[i].checked) {
						str = authorSelected[i].id.toString();
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
						url: "ManageAuthors.php?lstDel=" + listDelete,
						type:"get",
						dataType:"html",
						success: function(dataReceive){
							$("#admin-authors-list").html(dataReceive);
						}

					});
				}
		    	askModal.style.display = "none";
		    	$("#selectDelAuthorOpt").val("title-action");

		    }
			
		}
		
	}

	function searchAuthor(){
		var keysearch = document.getElementById('keysearch').value;
		if (keysearch != "") {
			$.ajax({
				url: "ManageAuthors.php?keysearch=" + keysearch,
				type: "get",
				dataType: "html",
				success: function(dataReceive){
					$("#admin-authors-list").html(dataReceive);
				}

			});
		}
	}

	// Get the modal
	var askModal = document.getElementById('askModal');
	var btnAskAccept = document.getElementById('btnAskAccept');

	// When the user clicks on the button, open the modal 
	function confirmDelete(id) {
		if ($('#selectDelAuthorOpt option:selected').text() == 'Delete') {
			$("#selectDelAuthorOpt").val("title-action");
		}

		askModal.style.display = "block";
	    btnAskAccept.onclick = function() {
	    	deleteAuthor(id);
	    	askModal.style.display = "none";

	    }
	    
	}

	function askDismiss() {
		askModal.style.display = "none";
	}

	function showFormAddAuthor() {
		$.ajax({
			url: "ManageAuthors.php?addauthors",
			type: "get",
			dataType: "html",
			success: function(dataReceive){
				$("#content-admin-author-page").html(dataReceive);
			}

		});
	}

	function addAuthor() {
		var aname = $('#aname').val();
		var aintro = $('#aintro').val();

		data = {aname:aname, aintro:aintro};

		dataSend = JSON.stringify(data);
		$.ajax({
			url: "AddAuthor.php",
			type: "POST",
			data: dataSend,
			dataType: "json",
			success: function(jsonData) {
				if (jsonData.status === 1) {
					$("#status-authorinfo").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insert successfully!</strong></div>');
					$("#status-authorinfo").css("display","block");
				}
				else if (jsonData.status === 0){
					$("#status-authorinfo").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insert fail!</strong></div>');
					$("#status-authorinfo").css("display","block");
				}
			}
		});
	}

	function updateAuthor(id) {
		var aname  = $("#aname").val();
		var aintro = $('#aintro').val();

		
		data = {aid:id,aname:aname, aintro:aintro};

		dataSend = JSON.stringify(data);

		$.ajax({
			url: "UpdateAuthorInfo.php",
			type: "POST",
			data: dataSend,
			dataType: "json",
			success: function(jsonData) {
				if (jsonData.status === 1) {
					$("#status-authorinfo").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Update successfully!</strong></div>');
					$("#status-authorinfo").css("display","block");
				}
				else if (jsonData.status === 0){
					$("#status-authorinfo").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Update fail!</strong></div>');
					$("#status-authorinfo").css("display","block");
				}
			}
		});
	}

</script>

</body>
</html>