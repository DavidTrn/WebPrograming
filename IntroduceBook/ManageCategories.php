<?php
	include('dbconnect.php');

	if(isset($_GET['listcategories'])) {
		include('CategoryList.php');
	}

	if (isset($_GET['show_category_id'])) {
		$sql = 'SELECT * FROM categories WHERE CATEGORY_ID='.$_GET['show_category_id'];
		$retval = $MySQLi_CON->query($sql);
		// $retval = mysqli_query( $dbhandle, $sql );
		if(!$retval )
		{
		  die('Could not get data: ' . mysqli_error());
		}
		$row = $retval->fetch_array();

		echo '<div id = "status-categoryinfo" style="width:60%;display: none; margin: 0 0 0 10%;"></div>
			<fieldset style="width:60%; margin: 0 0 0 10%;">
				<legend><strong>Category infomation</strong></legend>
				
				<div class="form-group">
					<label for="cname">
						Name
					</label>
					<input type="text" class="form-control" id="cname" value="'.$row['CATEGORY_NAME'].'"/>
				</div>
				<label for="cdis">
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
						<textarea class="title-content form-control" cols="81" rows="10" id="cdis" >'.$row['DISCRIPTION'].'</textarea>
					</div>
				</div>			
				<button onclick="updateCategory('.$_GET['show_category_id'].');" class="btn btn-success" style="width:100px;"">
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
		$sql = 'DELETE FROM categories WHERE CATEGORY_ID IN ('.$_GET['lstDel'].')';
		$retval = $MySQLi_CON->query($sql);
		// $retval = mysqli_query( $dbhandle, $sql );
		if(!$retval )
		{
		  die('Could not delete data: ' . mysqli_error());
		}
		$deleteStatus = "Delete successfully!";
		include('CategoryList.php');
	}

	if (isset($_GET['addcategories'])) {
		echo '<div id = "status-categoryinfo" style="width:60%;display: none; margin: 0 0 0 10%;"></div>
			<fieldset style="width:60%; margin: 0 0 0 10%;">
					<legend><strong>Category infomation</strong></legend>
					
					<div class="form-group">
						<label for="cname">
							Name
						</label>
						<input type="text" class="form-control" id="cname" />
					</div>
					<label for="cdis">
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
							<textarea class="title-content form-control" cols="81" rows="10" id="cdis"></textarea>
						</div>
					</div>			
					<button onclick="addCategory();" class="btn btn-success" style="width:100px;"">
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
						Discription
					</th>
					<th>
						Created at
					</th>
					<th>
						Action
					</th>
				</tr>
			</thead>
		    <tbody>';

		//execute the SQL query and return records
		$query = $MySQLi_CON->query("SELECT CATEGORY_ID, CATEGORY_NAME, DISCRIPTION, CREATED_AT FROM categories WHERE CATEGORY_NAME = '".$_GET['keysearch']."'");
		$count=$query->num_rows;
		
		//fetch the data from the database
		if ($count != 0) {
			$num = 0;
			while ($row = $query->fetch_array()) {
				$num++;
				echo '<tr>
						<td style="vertical-align:middle;">' .$num.'</td>'.
						'<td style="vertical-align:middle;"><input class="catogorySelect" id="isCheckCategory-'.$row['CATEGORY_ID'].'" type="checkbox"></td>'.
						'<td style="vertical-align:middle;">'.$row['CATEGORY_NAME'].'</td>'.
						'<td style="vertical-align:middle;">'.$row['DISCRIPTION'].'</td>'.
						'<td style="vertical-align:middle;">'.$row['CREATED_AT'].'</td>'.
						'<td style="text-align:left;vertical-align:middle;">
							<a href="#" onclick="showCategoryInfo('.$row['CATEGORY_ID'].');"><img src="assets/document_edit.png"/></a>
							<a href="#" onclick="confirmDelete('.$row['CATEGORY_ID'].');"><img src="assets/delete_icon_red.png" style="width:23px; height:23px;"/></a>
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