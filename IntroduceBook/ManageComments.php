<?php
	include('dbconnect.php');

	if(isset($_GET['listcomments'])) {
		include('CommentList.php');
	}

	// if (isset($_GET['show_book_id'])) {
	// 	echo "Hello";
	// }

	if (isset($_GET['lstDel'])) {
		$sql = 'DELETE FROM comments WHERE COMMENT_ID IN ('.$_GET['lstDel'].')';
		$retval = $MySQLi_CON->query($sql);
		// $retval = mysqli_query( $dbhandle, $sql );
		if(!$retval )
		{
		  die('Could not delete data: ' . mysqli_error());
		}
		$deleteStatus = "Delete successfully!";
		include('CommentList.php');
	}

	if (isset($_GET['keysearch'])) {
		echo '<table class="table table-striped">
		    <thead>
				<tr>
					<th>
						#
					</th>
					<th style="text-align:center;"">
						Check
					</th>
					<th>
						Author
					</th>
					<th>
						Content
					</th>
					<th>
						Belong to book
					</th>
					<th>
						Create at
					</th>
					<th>
						Action
					</th>
				</tr>
			</thead>
		    <tbody>';
		//execute the SQL query and return records
	    $query_user = $MySQLi_CON->query("SELECT USER_ID FROM users WHERE USERNAME = '".$_GET['keysearch']."'");
	    if ($row_user = $query_user->fetch_array()) {
	    	$query = $MySQLi_CON->query("SELECT COMMENT_ID, USER_ID, BOOK_ID, CONTENT, CREATED_AT FROM comments WHERE USER_ID=".$row_user['USER_ID']);
			$count=$query->num_rows;
			$author="";
			$book="";
			//fetch the data from the database
			if ($count != 0) {
				$num = 0;
				while ($row = $query->fetch_array()) {
					$num++;
					$query_author = $MySQLi_CON->query("SELECT USERNAME FROM users WHERE USER_ID = ".$row['USER_ID']);
					$count_author=$query_author->num_rows;
					$query_book = $MySQLi_CON->query("SELECT BOOK_NAME FROM books WHERE BOOK_ID = ".$row['BOOK_ID']);
					$count_book=$query_book->num_rows;
					if ($count_author != 0) {
						$row_author = $query_author->fetch_array();
						$author = $row_author['USERNAME'];
					}
					else {
						$author = 'Undetermined';
					}
					if ($count_book != 0) {
						$row_book = $query_book->fetch_array();
						$book = $row_book['BOOK_NAME'];
					}
					else {
						$book = 'Undetermined';
					}
					echo '<tr>
							<td style="vertical-align:middle;">' .$num.'</td>'.
							'<td style="vertical-align:middle;text-align:center;"><input class="commentSelect" id="isCheckComment-'.$row['COMMENT_ID'].'" type="checkbox"></td>'.
							'<td style="vertical-align:middle;">'.$author.'</td>'.
							'<td style="vertical-align:middle;">'.$row['CONTENT'].'</td>'.
							'<td style="vertical-align:middle;">'.$book.'</td>'.
							'<td style="vertical-align:middle;">'.$row['CREATED_AT'].'</td>'.
							'<td style="text-align:left;vertical-align:middle;">
								<!--<a href="#" onclick="showBookInfo('.$row['COMMENT_ID'].');"><img src="assets/document_edit.png"/></a>-->
								<button class="btn btn-danger" onclick="confirmDelete('.$row['COMMENT_ID'].');">Delete</button>
								<!--<button class="btn btn-warning">Edit</button>-->
								<!--<button class="btn btn-danger">Delete</button>-->
							</td>'.
						'</tr>';
				}
			}

			echo		'</tbody>
				  	</table>';	

	    }
		
	}

	//close the connection
	$MySQLi_CON->close();

?>