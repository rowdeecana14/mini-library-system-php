<?php	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
		require_once '../model/query.php';
		$rents = new Schema;
		session_start();
		date_default_timezone_set('Asia/Manila');

		if($_POST['action'] == 'rent-book') {
			$list_id = $_POST['list_id'];
			$rent_no = $_POST['rent_no'];
			$rent_date = $_POST['date_rent'];
			$due_date = $_POST['date_returned'];
			// $rent_no = $rents->generateRentID();
			$status = 'Rented-process';
			$user_id = $_SESSION['lms_userid'];
			$data = false;
			$count_success = 0;
			$data_error = [];

			foreach ($list_id as $value) {
				$search_result = checkRentStatus($value, $rents);
				if(count($search_result) == 0) {
					$count_success++;
				}
				else {
					array_push($data_error, $search_result[0]);
				}
			}

			if($count_success == count($list_id)) {
				foreach ($list_id as $value) {
					$sql = "INSERT INTO tbl_rents
						(rent_no, rent_status, rent_date, due_date, book_id, user_id)
						VALUES 
						('$rent_no', '$status', '$rent_date', '$due_date','$value', '$user_id')";
					$data = $rents->addRecord($sql);
				}

				echo json_encode(array('success' => true, 'data_error' => []));

			}
			else {
				echo json_encode(array('success' => false, 'data_error' => $data_error));
			}

			
		}


		if($_POST['action'] == 'request-list') {

			$sql = "SELECT SUM(tbl_books.fee) as total_fee, tbl_profiles.first_name, tbl_profiles.last_name, tbl_rents.rent_no, tbl_rents.book_id FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id
                WHERE tbl_rents.rent_status='Rented-process'
				GROUP BY tbl_rents.rent_no";
        	$result = $rents->displayRecord($sql);

        	echo json_encode($result);
		}

		

		if($_POST['action'] == 'request-view') {
			$rent_no = $_POST['rent_no'];
			$sql = "SELECT * FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_no='$rent_no' AND tbl_rents.rent_status='Rented-process'";
        	$result = $rents->displayRecord($sql);
        	echo json_encode($result);
		}

 

		if($_POST['action'] == 'request-approve') {
			$rent_no = $_POST['rent_no'];
			//$book_id = $_POST['book_id'];
			$data = false;

			$sql = "SELECT * FROM tbl_rents WHERE rent_no='$rent_no'";
			$list_bookid = $rents->displayRecord($sql);

			$sql = "UPDATE tbl_rents 
					SET rent_status='Rented'
					WHERE rent_no='$rent_no'";
			$data = $rents->updateRecord($sql);

			$sql = "SELECT * FROM tbl_rents WHERE rent_no='$rent_no'";
			$bookid_list = $rents->searchRecord($sql);

			foreach ($list_bookid as $value) {
				$book_id = $value['book_id'];
				$sql = "UPDATE tbl_books 
					SET status='Rented'
						WHERE book_id='$book_id'";
				$data = $rents->updateRecord($sql);
			}
			
			echo json_encode($data);
			
		}

		if($_POST['action'] == 'rent-list') {
			$user_id = $_SESSION['lms_userid'];
			$sql = "SELECT DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, SUM(tbl_books.fee) as total_fee, tbl_rents.rent_no, tbl_rents.rent_date, tbl_rents.due_date FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id
                WHERE tbl_rents.rent_status='Rented' AND tbl_rents.user_id='$user_id'
				GROUP BY tbl_rents.rent_no";
        	$data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['due_date'] = date('M d, Y', strtotime($value['due_date']));
				$count++;
			}

        	echo json_encode($data);
		}

		if($_POST['action'] == 'rent-view') {
			$rent_no = $_POST['rent_no'];
			$user_id = $_SESSION['lms_userid'];
			$sql = "SELECT * FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_no='$rent_no' AND tbl_rents.rent_status='Rented' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_books.title ASC";
        	$result = $rents->displayRecord($sql);
        	echo json_encode($result);
		}

		if($_POST['action'] == 'return-book') {
			$bookid_list = $_POST['bookid_list'];
			$rent_no = $_POST['rent_no'];
			$return_date = date("Y-m-d");
			$data = false;

			foreach ($bookid_list as $book_id) {
				$sql = "UPDATE tbl_rents 
					SET rent_status='Returned-process', return_date='$return_date'
					WHERE rent_no='$rent_no' AND book_id='$book_id'";
				$data = $rents->updateRecord($sql);
			}

			echo json_encode($data);
		}

		if($_POST['action'] == 'return-book-all') {
			$rent_no = $_POST['rent_no'];
			$return_date = date("Y-m-d");
			$data = false;
			$sql = "UPDATE tbl_rents 
				SET rent_status='Returned-process', return_date='$return_date'
				WHERE rent_no='$rent_no'";
			$data = $rents->updateRecord($sql);

			echo json_encode($data);
		}


		if($_POST['action'] == 'rented-list') {
			$user_id = $_SESSION['lms_userid'];
			$sql = "SELECT * FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Rented'
                ORDER BY tbl_rents.rent_no ASC";
            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['due_date'] = date('M d, Y', strtotime($value['due_date']));
				$count++;
			}

        	echo json_encode($data);
		}



		if($_POST['action'] == 'returned-list') {

			$sql = "SELECT  DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_profiles.first_name, tbl_profiles.last_name, tbl_rents.rent_no, tbl_rents.book_id, tbl_rents.rent_date, tbl_rents.due_date FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id
                WHERE tbl_rents.rent_status='Returned-process'
				GROUP BY tbl_rents.rent_no";
        	$data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['due_date'] = date('M d, Y', strtotime($value['due_date']));
				$count++;
			}

        	echo json_encode($data);
		}

		if($_POST['action'] == 'lessee-returned-list') {
			$user_id = $_SESSION['lms_userid'];
			$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
                ORDER BY tbl_rents.return_date DESC";
        	$data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['return_date'] = date('M d, Y', strtotime($value['return_date']));
				$count++;
			}

        	echo json_encode($data);
		}

		if($_POST['action'] == 'returned-view') {
			$rent_no = $_POST['rent_no'];
			$sql = "SELECT * FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_no='$rent_no' AND (tbl_rents.rent_status='Returned-process' OR tbl_rents.rent_status='Rented')";
        	$result = $rents->displayRecord($sql);
        	echo json_encode($result);
		}

		if($_POST['action'] == 'returned-approve') {
			$rent_no = $_POST['rent_no'];
			$data = false;
			$sql = "UPDATE tbl_rents 
					SET rent_status='Returned'
					WHERE rent_no='$rent_no'";
			$data = $rents->updateRecord($sql);

			$sql = "SELECT * FROM tbl_rents WHERE rent_no='$rent_no'";
			$bookid_list = $rents->searchRecord($sql);

			foreach ($bookid_list as $value) {
				$book_id = $value['book_id'];
				$sql = "UPDATE tbl_books 
						SET status='Available'
						WHERE book_id='$book_id'";
				$data = $rents->updateRecord($sql);
			}
			
			echo json_encode($data);
		}

		if($_POST['action'] == 'received-return') {
			$bookid_list = $_POST['bookid_list'];
			$rent_no = $_POST['rent_no'];
			$data = false;

			foreach ($bookid_list as $book_id) {
				$sql = "UPDATE tbl_rents 
					SET rent_status='Returned'
					WHERE rent_no='$rent_no' AND book_id='$book_id'";
				$data = $rents->updateRecord($sql);
				$sql = "UPDATE tbl_books 
						SET status='Available'
						WHERE book_id='$book_id'";
				$data = $rents->updateRecord($sql);
			}

			echo json_encode($data);
		}


		if($_POST['action'] == 'filter-lessee-return') {
			$user_id = $_SESSION['lms_userid'];
			$date = $_POST['date'];
			$genre = $_POST['genre'];
			$status = $_POST['status'];
			$sql = "";

			if($date != '' && $genre == '' && $status == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
                AND tbl_rents.return_date='$date'
                ORDER BY tbl_rents.return_date DESC";
			}
				
			if($date == '' && $genre != '' && $status == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
                AND tbl_books.genre_id='$genre'
                ORDER BY tbl_rents.return_date DESC";
			}

			if($date == '' && $genre == '' && $status != '') {

                if($status == 'Ondate') {
                	$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND DATEDIFF(CURDATE(), tbl_rents.due_date)  < 1
	                ORDER BY tbl_rents.return_date DESC";
                }
                else {
                	$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0 
	                ORDER BY tbl_rents.return_date DESC";
                }
			}

			if($date != '' && $genre != '' && $status != '') {

				
				if($status == 'Ondate') {
                	$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND tbl_rents.return_date='$date' AND tbl_books.genre_id='$genre' AND DATEDIFF(CURDATE(), tbl_rents.due_date)  < 1
	                ORDER BY tbl_rents.return_date DESC";
                }
                else {
                	$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND tbl_rents.return_date='$date' AND tbl_books.genre_id='$genre' AND  DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
	                ORDER BY tbl_rents.return_date DESC";
                }
			}

			if($date != '' && $genre != '' && $status == '') {
				echo $genre;
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND tbl_rents.return_date='$date' AND tbl_books.genre_id='$genre'
	                ORDER BY tbl_rents.return_date DESC";
			}

			if($date != '' && $genre == '' && $status != '') {
				if($status == 'Ondate') {
                	$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND tbl_rents.return_date='$date' AND DATEDIFF(CURDATE(), tbl_rents.due_date)  < 1
	                ORDER BY tbl_rents.return_date DESC";
                }
                else {
                	$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND tbl_rents.return_date='$date'AND  DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
	                ORDER BY tbl_rents.return_date DESC";
                }

			}

			if($date == '' && $genre != '' && $status != '') {
				if($status == 'Ondate') {
					$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND tbl_books.genre_id='$genre' AND DATEDIFF(CURDATE(), tbl_rents.due_date)  < 1
	                ORDER BY tbl_rents.return_date DESC";
				}
				else {
					$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date
					FROM tbl_rents
					INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
	                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
	                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
	                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
	                WHERE tbl_rents.user_id='$user_id' AND tbl_rents.rent_status='Returned'
	          		AND tbl_books.genre_id='$genre' AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
	                ORDER BY tbl_rents.return_date DESC";
				}
				
			
			}
			$data = $rents->displayRecord($sql);
			$count = 0;

			foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['return_date'] = date('M d, Y', strtotime($value['return_date']));
				$count++;
			}
			echo json_encode($data);
		}


		/* ADMIN RECORDS */
		// RENT LIST
		if($_POST['action'] == 'admin-rented-list') {
			$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented'
                ORDER BY tbl_rents.rent_no ASC";
            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['due_date'] = date('M d, Y', strtotime($value['due_date']));
				$count++;
			}

        	echo json_encode($data);
		}

		if($_POST['action'] == 'filter-admin-rented') {
			$rent_date = $_POST['rent_date'];
			$due_date = $_POST['due_date'];
			$user_id = $_POST['user_id'];
			$sql = "";

			if($rent_date != '' && $due_date == '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' AND tbl_rents.rent_date='$rent_date'
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date == '' && $due_date != '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' AND tbl_rents.due_date='$due_date'
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date == '' && $due_date == '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date != '' && $due_date != '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.due_date='$due_date' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date != '' && $due_date != '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.due_date='$due_date'
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date != '' && $due_date == '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date == '' && $due_date != '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.due_date='$due_date' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rent_no ASC";
			}

            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['due_date'] = date('M d, Y', strtotime($value['due_date']));
				$count++;
			}

        	echo json_encode($data);
		}


		if($_POST['action'] == 'load-user') {
			$sql = "SELECT * FROM tbl_profiles ORDER BY tbl_profiles.last_name ASC";
			$data = $rents->displayRecord($sql);
			echo json_encode($data);
		}


		// RETURNED LIST
		if($_POST['action'] == 'admin-returned-list') {
			$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned'
                ORDER BY tbl_rents.rented_id DESC";
            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['return_date'] = date('M d, Y', strtotime($value['return_date']));
				$count++;
			}

        	echo json_encode($data);
		}

		if($_POST['action'] == 'filter-admin-returned') {
			$rent_date = $_POST['rent_date'];
			$return_date = $_POST['return_date'];
			$user_id = $_POST['user_id'];
			$sql = "";

			if($rent_date != '' && $return_date == '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' AND tbl_rents.rent_date='$rent_date'
                ORDER BY tbl_rents.rented_id DESC";
			}

			if($rent_date == '' && $return_date != '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' AND tbl_rents.return_date='$return_date'
                ORDER BY tbl_rents.rented_id DESC";
			}

			if($rent_date == '' && $return_date == '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rented_id DESC";
			}

			if($rent_date != '' && $return_date != '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.return_date='$return_date' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rented_id DESC";
			}

			if($rent_date != '' && $return_date != '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.return_date='$return_date'
                ORDER BY tbl_rents.rented_id DESC";
			}

			if($rent_date != '' && $return_date == '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rented_id DESC";
			}

			if($rent_date == '' && $return_date != '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' 
                AND tbl_rents.return_date='$return_date' AND tbl_rents.user_id='$user_id'
                ORDER BY tbl_rents.rented_id DESC";
			}

            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['return_date'] = date('M d, Y', strtotime($value['return_date']));
				$count++;
			}

        	echo json_encode($data);
		}


		//OVERDUE BOOKS
		if($_POST['action'] == 'admin-overdue-list') {
			$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['due_date'] = date('M d, Y', strtotime($value['due_date']));
				$count++;
			}

        	echo json_encode($data);
		}


		if($_POST['action'] == 'filter-admin-overdue') {
			$rent_date = $_POST['rent_date'];
			$due_date = $_POST['due_date'];
			$user_id = $_POST['user_id'];
			$sql = "";

			if($rent_date != '' && $due_date == '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' AND tbl_rents.rent_date='$rent_date'
                AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date == '' && $due_date != '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' AND tbl_rents.due_date='$due_date'
                AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date == '' && $due_date == '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' AND tbl_rents.user_id='$user_id'
                AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date != '' && $due_date != '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.due_date='$due_date' AND tbl_rents.user_id='$user_id'
                AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date != '' && $due_date != '' && $user_id == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.due_date='$due_date'
                AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date != '' && $due_date == '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.rent_date='$rent_date' AND tbl_rents.user_id='$user_id'
                AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
			}

			if($rent_date == '' && $due_date != '' && $user_id != '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(CURDATE(), tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Rented' 
                AND tbl_rents.due_date='$due_date' AND tbl_rents.user_id='$user_id'
                AND DATEDIFF(CURDATE(), tbl_rents.due_date)  > 0
                ORDER BY tbl_rents.rent_no ASC";
			}

            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['due_date'] = date('M d, Y', strtotime($value['due_date']));
				$count++;
			}

        	echo json_encode($data);
		}

		/* RENTED AND RETURNED REPORT */

		if($_POST['action'] == 'load-year') {
			$sql = "SELECT EXTRACT(YEAR from tbl_rents.rent_date) as year FROM tbl_rents GROUP BY EXTRACT(YEAR from tbl_rents.rent_date)";
			$data = $rents->displayRecord($sql);

			echo json_encode($data);
		}


		if($_POST['action'] == 'filter-report') {
			$date = $_POST['date'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			$sql = "";

			if($date != '' && $month == '' && $year == '') {
				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned'
                AND tbl_rents.rent_date='$date'
                ORDER BY tbl_rents.rented_id DESC";

                $data = $rents->displayRecord($sql);
	        	$count = 0;

	        	foreach ($data as $value) {
					$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
					$data[$count]['return_date'] = date('M d, Y', strtotime($value['return_date']));
					$count++;
				}

	        	echo json_encode($data);
			}

			else if($month != '' && $year != '') {

				$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned'
                AND EXTRACT(MONTH FROM tbl_rents.rent_date)='$month' AND EXTRACT(YEAR FROM tbl_rents.rent_date)='$year'
                ORDER BY tbl_rents.rented_id DESC";

                $data = $rents->displayRecord($sql);
	        	$count = 0;

	        	foreach ($data as $value) {
					$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
					$data[$count]['return_date'] = date('M d, Y', strtotime($value['return_date']));
					$count++;
				}

	        	echo json_encode($data);
			}
			else {
				echo json_encode([]);
			}
            
		}


		if($_POST['action'] == 'admin-view-book') {
			$book_id = $_POST['book_id'];
			$sql = "SELECT tbl_books.title, tbl_books.pages, tbl_books.fee, tbl_genres.genre, tbl_authors.author, tbl_rents.rent_date, tbl_rents.return_date, DATEDIFF(tbl_rents.return_date, tbl_rents.due_date) AS diff_date, tbl_rents.due_date, tbl_profiles.first_name, tbl_profiles.last_name
				FROM tbl_rents
				INNER JOIN tbl_users ON tbl_rents.user_id=tbl_users.user_id
                INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                INNER JOIN tbl_books ON tbl_books.book_id=tbl_rents.book_id 
                INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
				INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                WHERE tbl_rents.rent_status='Returned' AND tbl_books.book_id='$book_id'
                ORDER BY tbl_rents.rented_id DESC";
            $data = $rents->displayRecord($sql);
        	$count = 0;

        	foreach ($data as $value) {
				$data[$count]['rent_date'] = date('M d, Y', strtotime($value['rent_date']));
				$data[$count]['return_date'] = date('M d, Y', strtotime($value['return_date']));
				$count++;
			}

        	echo json_encode($data);
		}


	}


	function checkRentStatus($book_id, $rents) {
		$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                    LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id
                    WHERE tbl_books.status='Available' AND tbl_rents.rent_status='Rented-process' AND tbl_books.book_id='$book_id'";
        $result = $rents->searchRecord($sql);
        return $result;
	}

?>