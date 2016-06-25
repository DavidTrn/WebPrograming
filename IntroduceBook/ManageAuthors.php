<?php
	include('dbconnect.php');

	if(isset($_GET['listauthors'])) {
		include('AuthorList.php');
	}

	if (isset($_GET['show_author_id'])) {
		$sql = 'SELECT * FROM authors WHERE AUTHOR_ID='.$_GET['show_author_id'];
		$retval = $MySQLi_CON->query($sql);
		// $retval = mysqli_query( $dbhandle, $sql );
		if(!$retval )
		{
		  die('Could not get data: ' . mysqli_error());
		}
		$row = $retval->fetch_array();

		echo '<div id = "status-authorinfo" style="width:60%;display: none; margin: 0 0 0 10%;"></div>
			<fieldset style="width:60%; margin: 0 0 0 10%;">
				<legend><strong>Author infomation</strong></legend>
				
				<div class="form-group">
					<label for="aname">
						Name
					</label>
					<input type="text" class="form-control" id="aname" value="'.$row['AUTHOR_NAME'].'"/>
				</div>
				<label for="aintro">
						Introduce
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
						<textarea class="title-content form-control" cols="81" rows="10" id="aintro" >'.$row['INTRODUCE'].'</textarea>
					</div>
				</div>			
				<button onclick="updateAuthor('.$_GET['show_author_id'].');" class="btn btn-success" style="width:100px;"">
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

	if (isset($_GET['lstDel'])) {
		$sql = 'DELETE FROM authors WHERE AUTHOR_ID IN ('.$_GET['lstDel'].')';
		$retval = $MySQLi_CON->query($sql);
		// $retval = mysqli_query( $dbhandle, $sql );
		if(!$retval )
		{
		  die('Could not delete data: ' . mysqli_error());
		}
		$deleteStatus = "Delete successfully!";
		include('AuthorList.php');
	}

	if (isset($_GET['addauthors'])) {
		echo '<div id = "status-authorinfo" style="width:60%;display: none; margin: 0 0 0 10%;"></div>
			<fieldset style="width:60%; margin: 0 0 0 10%;">
					<legend><strong>Author infomation</strong></legend>
					
					<div class="form-group">
						<label for="aname">
							Name
						</label>
						<input type="text" class="form-control" id="aname" />
					</div>
					<label for="aintro">
							Introduce
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
							<textarea class="title-content form-control" cols="81" rows="10" id="aintro"></textarea>
						</div>
					</div>			
					<button onclick="addAuthor();" class="btn btn-success" style="width:100px;"">
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
						Name
					</th>
					<th>
						Introduce
					</th>
					<th style="width:100px;">
						Action
					</th>
				</tr>
			</thead>
		    <tbody>';

		//execute the SQL query and return records
		$query = $MySQLi_CON->query("SELECT AUTHOR_ID, AUTHOR_NAME, INTRODUCE FROM authors WHERE AUTHOR_NAME = '".$_GET['keysearch']."'");
		$count=$query->num_rows;
		
		//fetch the data from the database
		if ($count != 0) {
			$num = 0;
			while ($row = $query->fetch_array()) {
				$num++;
				echo '<tr>
					<td style="vertical-align:middle;">' .$num.'</td>'.
					'<td style="vertical-align:middle;"><input class="authorSelect" id="isCheckAuthor-'.$row['AUTHOR_ID'].'" type="checkbox"></td>'.
					'<td style="vertical-align:middle;">'.$row['AUTHOR_NAME'].'</td>'.
					'<td style="vertical-align:middle;">'.$row['INTRODUCE'].'</td>'.
					'<td style="text-align:left;vertical-align:middle;">
						<a href="#" onclick="showAuthorInfo('.$row['AUTHOR_ID'].');"><img src="assets/document_edit.png"/></a>
						<a href="#" onclick="confirmDelete('.$row['AUTHOR_ID'].');"><img src="assets/delete_icon_red.png" style="width:23px; height:23px;"/></a>
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