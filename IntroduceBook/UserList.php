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
						Usersname
					</th>
					<th>
						Name
					</th>
					<th>
						Email
					</th>
					<th>
						Role
					</th>
					<th>
						Action
					</th>
				</tr>
			</thead>
		    <tbody>';

	//execute the SQL query and return records
	$query = $MySQLi_CON->query("SELECT USER_ID, USERNAME, FIRSTNAME, LASTNAME, EMAIL, ROLE FROM users");
	$count=$query->num_rows;
	//fetch the data from the database
	if ($count != 0) {
		$num = 0;
		while ($row = $query->fetch_array()) {
			$num++;
			echo '<tr>
					<td>' .$num.'</td>'.
					'<td><input class="userSelect" id="isCheck-'.$row['USER_ID'].'" type="checkbox"></td>'.
					'<td><a href="#">'.$row['USERNAME'].'</a></td>'.
					'<td>'.$row['LASTNAME'].' '.$row['FIRSTNAME'].'</td>'.
					'<td>'.$row['EMAIL'].'</td>'.
					'<td>'.$row['ROLE'].'</td>'.
					'<td style="text-align:left;">
						<a href="#" onclick="showUserInfo('.$row['USER_ID'].');"><img src="assets/document_edit.png"/></a>
						<a href="#" onclick="confirmDelete('.$row['USER_ID'].');"><img src="assets/user_delete.png"/></a>
						<!--<button class="btn btn-warning">Edit</button>-->
						<!--<button class="btn btn-danger">Delete</button>-->
					</td>'.
				'</tr>';
		}
	}

	echo		'</tbody>
		  	</table>';
	
?>