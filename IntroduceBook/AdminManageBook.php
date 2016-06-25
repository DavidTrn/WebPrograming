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
		<div id="content-admin-book-page" class="col-md-10">
			<div class="row">
				<span>
					<h2 class="title-content">Books</h2>
				</span>	
				<button class="btn btn-primary" onclick="showFormAddBook();">Add Book</button>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="navbar navbar-right" style="margin-right: 20px;">
						<div class="form-group" style="display: inline-block;">
							<input type="text" id="keysearch" class="form-control" placeholder="Enter name of book">
						</div> 
						<button onclick="searchBook();" class="btn btn-default" style="display: inline-block;">
							Search Book
						</button>
					</div>
				</div>
				<div class="col-md-12" style="margin-bottom: 20px;">
					<select id="selectDelBookOpt" class="form-control">
					  	<option value="title-action">Choose action...</option>
					  	<option value="delete">Delete</option>
					</select>
					<button class="btn btn-default" onclick="deleteSelected();" style="margin-right: 10px;">Apply</button>
					
				</div>
				<div class="col-md-12">
					<div id="admin-books-list" class="table-responsive">
						
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
		$("#headingThree").css({"color":"#5cb85c"});
	});
	$.ajax({
		url: "ManageBooks.php?listbooks",
		type: "get",
		dataType:"html",
		success: function(dataReceive){
			$("#admin-books-list").html(dataReceive);
		}
	});
	function deleteBook(id) {
		$.ajax({
			url: "ManageBooks.php?lstDel=" + id,
			type:"get",
			dataType:"html",
			success: function(dataReceive){
				$("#admin-books-list").html(dataReceive);
			}

		});
	}

	function showBookInfo(id) {
		$.ajax({
			url: "ManageBooks.php?show_book_id=" + id,
			type:"get",
			dataType:"html",
			success: function(dataReceive){
				$("#content-admin-book-page").html(dataReceive);
			}

		});
	}

	function deleteSelected() {
		if ($('#selectDelBookOpt option:selected').text() == 'Delete') {
			askModal.style.display = "block";
	    	btnAskAccept.onclick = function() {
		    	var bookSelected = document.getElementsByClassName("bookSelect");
				var listDelete = "";

				for (i=0; i<bookSelected.length;i++) {
					if (bookSelected[i].checked) {
						str = bookSelected[i].id.toString();
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
						url: "ManageBooks.php?lstDel=" + listDelete,
						type:"get",
						dataType:"html",
						success: function(dataReceive){
							$("#admin-books-list").html(dataReceive);
						}

					});
				}
		    	askModal.style.display = "none";
		    	$("#selectDelBookOpt").val("title-action");

		    }
			
		}
		
	}

	function searchBook(){
		var keysearch = document.getElementById('keysearch').value;
		if (keysearch != "") {
			$.ajax({
				url: "ManageBooks.php?keysearch=" + keysearch,
				type: "get",
				dataType: "html",
				success: function(dataReceive){
					$("#admin-books-list").html(dataReceive);
				}

			});
		}
	}

	// Get the modal
	var askModal = document.getElementById('askModal');
	var btnAskAccept = document.getElementById('btnAskAccept');

	// When the user clicks on the button, open the modal 
	function confirmDelete(id) {
		if ($('#selectDelBookOpt option:selected').text() == 'Delete') {
			$("#selectDelBookOpt").val("title-action");
		}

		askModal.style.display = "block";
	    btnAskAccept.onclick = function() {
	    	deleteBook(id);
	    	askModal.style.display = "none";

	    }
	    
	}

	function askDismiss() {
		askModal.style.display = "none";
	}

	function showFormAddBook() {
		$.ajax({
			url: "ManageBooks.php?addbook",
			type: "get",
			dataType: "html",
			success: function(dataReceive){
				$("#content-admin-book-page").html(dataReceive);
			}

		});
	}

	function addBook() {
		var bname = $('#bname').val();
		var bpublisher = $('#bpublisher').val();
		var bdistributor = $('#bdistributor').val();
		var bsell = $('#bsell').val();
		var bcategory = $('#bcategory').val();
		var bimg = $('#bimg').val();
		var bdis = $('#bdis').val();

		if ((bname == "") || (bimg == "") || (bcategory == "") || (bpublisher == "") || (bdistributor == "") || (bsell == "") || (bdis == "")) {
			$("#status-bookinfo").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>You must type all field!</strong></div>');
			$("#status-bookinfo").css("display","block");
		}
		else {
			data = {bname:bname, bpublisher:bpublisher, bdistributor:bdistributor, bsell:bsell, bcategory:bcategory, bimg:bimg, bdis:bdis};

			dataSend = JSON.stringify(data);
			$.ajax({
				url: "AddBook.php",
				type: "POST",
				data: dataSend,
				dataType: "json",
				success: function(jsonData) {
					if (jsonData.status === 1) {
						$("#status-bookinfo").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insert successfully!</strong></div>');
						$("#status-bookinfo").css("display","block");
					}
					else if (jsonData.status === 0){
						$("#status-bookinfo").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insert fail!</strong></div>');
						$("#status-bookinfo").css("display","block");
					}
				}
			});
		}
		
	}

	function updateBook(id) {
		var bname  = $("#bname").val();
		var bpublisher  = $("#bpublisher").val();
		var bdistributor = $("#bdistributor").val();
		var bsell  = $("#bsell").val();
		var bcategory= $("#bcategory").val();
		var bimg= $("#bimg").val();
		var bdis = $('#bdis').val();

		
		data = {bid:id,bname:bname, bpublisher:bpublisher, bdistributor:bdistributor, bsell:bsell, bcategory:bcategory, bimg:bimg, bdis:bdis};

		dataSend = JSON.stringify(data);

		$.ajax({
			url: "UpdateBookInfo.php",
			type: "POST",
			data: dataSend,
			dataType: "json",
			success: function(jsonData) {
				if (jsonData.status === 1) {
					$("#status-bookinfo").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Update successfully!</strong></div>');
					$("#status-bookinfo").css("display","block");
				}
				else if (jsonData.status === 0){
					$("#status-bookinfo").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Update fail!</strong></div>');
					$("#status-bookinfo").css("display","block");
				}
			}
		});
	}

</script>

</body>
</html>