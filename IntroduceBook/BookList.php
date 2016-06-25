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
	$query = $MySQLi_CON->query("SELECT BOOK_ID, BOOK_NAME, IMAGE, AUTHOR_ID, CATEGORY_NAME FROM books");
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
					'<td style="vertical-align:middle;">'.$row['CATEGORY_NAME'].'</td>'.
					'<td style="text-align:left;vertical-align:middle;">
						<a href="#" onclick="showBookInfo('.$row['BOOK_ID'].');"><img src="assets/document_edit.png"/></a>
						<a href="#" onclick="confirmDelete('.$row['BOOK_ID'].');"><img src="assets/delete_icon_red.png" style="width:23px; height:23px;"/></a>
						<!--<button class="btn btn-warning">Edit</button>-->
						<!--<button class="btn btn-danger">Delete</button>-->
					</td>'.
				'</tr>';
		}
	}

	echo		'</tbody>
		  	</table>';
	
?>