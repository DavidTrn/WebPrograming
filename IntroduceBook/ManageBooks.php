<?php
	include('dbconnect.php');

	if(isset($_GET['listbooks'])) {
		include('BookList.php');
	}

	if (isset($_GET['show_book_id'])) {
		if (is_numeric($_GET['show_book_id'])) {
			$sql = 'SELECT * FROM books WHERE BOOK_ID='.$_GET['show_book_id'];
			$retval = $MySQLi_CON->query($sql);
			// $retval = mysqli_query( $dbhandle, $sql );
			if(!$retval )
			{
			  die('Could not get data: ' . mysqli_error());
			}
			$row = $retval->fetch_array();

			echo '<div id = "status-bookinfo" style="width:60%;display: none; margin: 0 0 0 10%;"></div>
				<fieldset style="width:60%; margin: 0 0 0 10%;">
					<legend><strong>Book infomation</strong></legend>
					
					<div class="form-group">
						<label for="bname">
							Name
						</label>
						<input type="text" class="form-control" id="bname" value="'.$row['BOOK_NAME'].'"/>
					</div>
					<div class="form-group">
						<label for="bpublisher">
							Publisher
						</label>
						<input type="text" class="form-control" id="bpublisher" value="'.$row['PUBLISHER'].'"/>
					</div>
					<div class="form-group">
						<label for="bdistributor">
							Distributor
						</label>
						<input type="text" class="form-control" id="bdistributor" value="'.$row['DISTRIBUTOR'].'"/>
					</div>
					<div class="form-group">
						<label for="bcategory">
							Category code
						</label>
						<input type="text" class="form-control" id="bcategory" value="'.$row['CATEGORY_CODE'].'" />
					</div>
					<div class="form-group">
						<label for="bsell">
							Sell at
						</label>
						<input type="text" class="form-control" id="bsell" value="'.$row['SELL_AT'].'"/>
					</div>
					
					<div class="form-group"> 
						<label for="bimg">
							Image
						</label>
						<input type="text" class="form-control" id="bimg" value="'.$row['IMAGE'].'"/>
					</div>
					<label for="bdis">
							Discription
					</label>
					<div class="panel panel-default margin-content">
						<div class="panel-heading">
							<div class="btn-group">
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-left"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-center"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-right"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-justify"></em>
								</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-bold"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-italic"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-font"></em>
								</button> 
							</div>
						</div>
						<div class="panel-body">
							<textarea class="title-content form-control" cols="81" rows="10" id="bdis" >'.$row['DISCRIPTION'].'</textarea>
						</div>
					</div>			
					<button onclick="updateBook('.$_GET['show_book_id'].');" class="btn btn-success" style="width:100px;"">
						Update
					</button>
				</fieldset>
				<div id="page-wrapper" style="margin: 20px 0 0 0;">
	                <div class="graphs" style="border-top: 1px solid #ccc;padding:20px 0px;">      
	                    <div class="copy" style="text-align: center;">
	                        <strong style="font-family: LatoFont;font-weight: bold">Copyright &copy; 2016 3D1A'."'".'s Admin All Rights Reserved | Design by <a href="Contact.php" target="_blank">3D1A Team</a> </strong>
	                    </div>
	                </div>       
	            </div>';
        }
	}

	if (isset($_GET['lstDel'])) {

		$arrBookID = explode(",",$_GET['lstDel']);	

		$sql = 'DELETE FROM books WHERE BOOK_ID IN ('.$_GET['lstDel'].')';
		$retval = $MySQLi_CON->query($sql);
		// $retval = mysqli_query( $dbhandle, $sql );
		if(!$retval )
		{
		  die('Could not delete data: ' . mysqli_error());
		}
		else {
			$deleteStatus = "Delete successfully!";
			for ($i=0; $i<count($arrBookID); $i++) {
				$bid = (int)$arrBookID[$i];
				$query = $MySQLi_CON->query("SELECT COMMENT_ID FROM comments WHERE BOOK_ID='$bid'");
				$count=$query->num_rows;
				if ($count != 0) {
					while ($row = $query->fetch_array()) {
						$sql = "DELETE FROM comments WHERE COMMENT_ID=".$row['COMMENT_ID'];
						$retval = $MySQLi_CON->query($sql);
					}
				}
			}
		}
		
		include('BookList.php');
	}

	if (isset($_GET['addbook'])) {
		echo '<div id = "status-bookinfo" style="width:60%;display: none; margin: 0 0 0 10%;"></div>
			<fieldset style="width:60%; margin: 0 0 0 10%;">
					<legend><strong>Book infomation</strong></legend>
					
					<div class="form-group">
						<label for="bname">
							Name
						</label>
						<input type="text" class="form-control" id="bname" />
					</div>
					<div class="form-group">
						<label for="bpublisher">
							Publisher
						</label>
						<input type="text" class="form-control" id="bpublisher" />
					</div>
					<div class="form-group">
						<label for="bdistributor">
							Distributor
						</label>
						<input type="text" class="form-control" id="bdistributor"/>
					</div>
					<div class="form-group">
						<label for="bcategory">
							Category code
						</label>
						<input type="text" class="form-control" id="bcategory" />
					</div>
					<div class="form-group">
						<label for="bsell">
							Sell at
						</label>
						<input type="text" class="form-control" id="bsell" />
					</div>
					
					<div class="form-group"> 
						<label for="bimg">
							Image
						</label>
						<input type="text" class="form-control" id="bimg" />
					</div>
					<label for="bdis">
							Discription
					</label>
					<div class="panel panel-default margin-content">
						<div class="panel-heading">
							<div class="btn-group">
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-left"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-center"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-right"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-align-justify"></em>
								</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-bold"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-italic"></em>
								</button> 
								<button class="btn btn-default" type="button">
									<em class="glyphicon glyphicon-font"></em>
								</button> 
							</div>
						</div>
						<div class="panel-body">
							<textarea class="title-content form-control" cols="81" rows="10" id="bdis"></textarea>
						</div>
					</div>			
					<button onclick="addBook();" class="btn btn-success" style="width:100px;"">
						Add
					</button>
				</fieldset>
				<div id="page-wrapper" style="margin: 20px 0 0 0;">
	                <div class="graphs" style="border-top: 1px solid #ccc;padding:20px 0px;">      
	                    <div class="copy" style="text-align: center;">
	                        <strong style="font-family: LatoFont;font-weight: bold">Copyright &copy; 2016 3D1A'."'".'s Admin All Rights Reserved | Design by <a href="Contact.php" target="_blank">3D1A Team</a> </strong>
	                    </div>
	                </div>       
	            </div>';
	}

	if (isset($_GET['keysearch'])) {
		echo '<table class="table table-striped">
		    <thead>
				<tr>
					<th>
						#
					</th>
					<th>
						Check
					</th>
					<th>
						Image
					</th>
					<th>
						Name
					</th>
					<th>
						Author
					</th>
					<th>
						Category
					</th>
					<th>
						Action
					</th>
				</tr>
			</thead>
		    <tbody>';
		//execute the SQL query and return records
		$query = $MySQLi_CON->query("SELECT BOOK_ID, BOOK_NAME, IMAGE, AUTHOR_ID, CATEGORY_CODE FROM books WHERE BOOK_NAME='".$_GET['keysearch']."'");
		$count=$query->num_rows;
		$author = 'Undetermined';
		//fetch the data from the database
		if ($count != 0) {
			$num = 0;
			while ($row = $query->fetch_array()) {
				$num++;
				$query_book = $MySQLi_CON->query("SELECT AUTHOR_NAME FROM authors WHERE AUTHOR_ID = ".$row['AUTHOR_ID']);
				$count_book=$query_book->num_rows;
				if ($count_book != 0) {
					$row_author = $query_book->fetch_array();
					$author = $row_author['AUTHOR_NAME'];
				}
				else {
					$author = 'Undetermined';
				}
				echo '<tr>
					<td style="vertical-align:middle;">' .$num.'</td>'.
					'<td style="vertical-align:middle;"><input class="bookSelect" id="isCheckBook-'.$row['BOOK_ID'].'" type="checkbox"></td>'.
					'<td style="vertical-align:middle;"><img src="'.$row['IMAGE'].'" style="width:30px; height:40px;"></td>'.
					'<td style="vertical-align:middle;">'.$row['BOOK_NAME'].'</td>'.
					'<td style="vertical-align:middle;">'.$author.'</td>'.
					'<td style="vertical-align:middle;">'.$row['CATEGORY_CODE'].'</td>'.
					'<td style="text-align:left;vertical-align:middle;">
						<a href="#" onclick="showBookInfo('.$row['BOOK_ID'].');"><img src="assets/document_edit.png"/></a>
						<a href="#" onclick="confirmDelete('.$row['BOOK_ID'].');"><img src="assets/user_delete.png"/></a>
						<!--<button class="btn btn-warning">Edit</button>-->
						<!--<button class="btn btn-danger">Delete</button>-->
					</td>'.
				'</tr>';
			}
		}

		echo		'</tbody>
			  	</table>';	

	}

	//close the connection
	$MySQLi_CON->close();

?>