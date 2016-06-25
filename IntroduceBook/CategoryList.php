<?php
	
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
	$query = $MySQLi_CON->query("SELECT CATEGORY_ID, CATEGORY_NAME, DISCRIPTION, CREATED_AT FROM categories");
	$count=$query->num_rows;
	
	//fetch the data from the database
	if ($count != 0) {
		$num = 0;
		while ($row = $query->fetch_array()) {
			$num++;
			echo '<tr>
					<td style="vertical-align:middle;">' .$num.'</td>'.
					'<td style="vertical-align:middle;"><input class="categorySelect" id="isCheckCategory-'.$row['CATEGORY_ID'].'" type="checkbox"></td>'.
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
	
?>