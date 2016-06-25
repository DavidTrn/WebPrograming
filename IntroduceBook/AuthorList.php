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
						Introduce
					</th>
					<th style="width:100px;">
						Action
					</th>
				</tr>
			</thead>
		    <tbody>';

	//execute the SQL query and return records
	$query = $MySQLi_CON->query("SELECT AUTHOR_ID, AUTHOR_NAME, INTRODUCE FROM authors");
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
					'<td style="text-align:left;vertical-align:middle; width:100px;">
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
	
?>