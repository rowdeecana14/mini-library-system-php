<?php	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
		require_once '../model/query.php';
		$books = new Schema;
		date_default_timezone_set('Asia/Manila');

		if($_POST['action'] == 'load') {
			$sql = "SELECT * FROM tbl_authors ORDER BY author ASC";
			$data_author = $books->displayRecord($sql);

			$sql = "SELECT * FROM tbl_genres ORDER BY genre ASC";
			$data_genre = $books->displayRecord($sql);

			echo json_encode(array('genre' => $data_genre, 'author' => $data_author));
		}

		if($_POST['action'] == 'add') {
			$image = '';
			$isbn = $_POST['isbn'];
			$title = $books->capitalizeData($_POST['title']);
			$summary = $books->capitalizeData($_POST['summary']);
			$pages = $_POST['pages'];
			$fee = $_POST['fee'];
			$status = 'Available';
			$created_at = date("Y-m-d h:i:s");
			$author_id = $_POST['author'];
			$genre_id = $_POST['genre'];


			if(!empty($_FILES['image']['name'])) {

				$image = $_FILES['image']['name'];
				$tmp_name = $_FILES['image']['tmp_name'];
				$data = $books->uploadImage($image, $tmp_name);
			}
			else {
				$image = "no-image.jpg";
			}

			$sql = "INSERT INTO tbl_books
					(image, isbn, title, summary, pages, fee, status, created_at, author_id, genre_id) 
					VALUES 
					('$image', '$isbn', '$title', '$summary','$pages', '$fee', '$status', '$created_at', '$author_id', '$genre_id')";
			$data = $books->addRecord($sql);
			echo json_encode($data);

		}


		if($_POST['action'] == 'list') {
			$sql = 'SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					ORDER BY tbl_authors.author ASC';
			$data = $books->displayRecord($sql);
			$count = 0;
			$rent_no = $books->generateRentID();

			foreach ($data as $value) {
				$data[$count]['created_at'] = date('Y-m', strtotime($value['created_at']));
				$count++;
			}

			echo json_encode(array('my_data' => $data, 'current_date' => date("Y-m"), 'rent_no' => $rent_no));
		}


		if($_POST['action'] == 'list-book-rent') {
			$sql = 'SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
                    LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id
                    GROUP BY tbl_books.book_id
					ORDER BY tbl_authors.author ASC';
			$data = $books->displayRecord($sql);
			$count = 0;
			$rent_no = $books->generateRentID();

			foreach ($data as $value) {
				$status_data = checkRentStatus($books, $data[$count]['book_id']);
				$data[$count]['rent_status'] = $status_data;
				$data[$count]['created_at'] = date('Y-m', strtotime($value['created_at']));
				$count++;
			}

			echo json_encode(array('my_data' => $data, 'current_date' => date("Y-m"), 'rent_no' => $rent_no));
		}


		if($_POST['action'] == 'activate_deactivate') {
			$book_id = $_POST['id'];
			$category = $books->capitalizeData($_POST['category']);

			if($category == 'Activate') {
				$category = 'Available';
			}

			$sql = "UPDATE tbl_books 
					SET status='$category'
					WHERE book_id='$book_id'";
			$data = $books->updateRecord($sql);
			echo json_encode($data);
		}



		if($_POST['action'] == 'load_book') {
			$book_id = $_POST['book_id'];
			$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE book_id='$book_id'";
			$data = $books->displayRecord($sql);
			echo json_encode($data);
		}

		if($_POST['action'] == 'get_date') {
			$book_id = $_POST['book_id'];
			$sql = "SELECT due_date FROM tbl_rents
					WHERE book_id='$book_id' AND (rent_status='Rented' OR rent_status='Returned process')";
			$data = $books->displayRecord($sql);
			$due_date = date('M d, Y', strtotime($data[0]['due_date']));
			echo json_encode($due_date);
		}

		if($_POST['action'] == 'update') {
			$book_id = $_POST['id'];
			$isbn = $_POST['isbn'];
			$title = $books->capitalizeData($_POST['title']);
			$summary = $books->capitalizeData($_POST['summary']);
			$pages = $_POST['pages'];
			$fee = $_POST['fee'];
			$updated_at = date("Y-m-d h:i:s");
			$author_id = $_POST['author'];
			$genre_id = $_POST['genre'];

			$sql = "UPDATE tbl_books SET
					isbn='$isbn', title='$title', summary='$summary', pages='$pages', fee='$fee', updated_at='$updated_at', author_id='$author_id', genre_id='$genre_id'
					WHERE book_id='$book_id'";
			$data = $books->updateRecord($sql);
			echo json_encode($data);
		}



		if($_POST['action'] == 'update-image') {
			$book_id = $_POST['id'];
			$image = '';
			
			if(!empty($_FILES['image-source']['name'])) {

				$image = $_FILES['image-source']['name'];
				$tmp_name = $_FILES['image-source']['tmp_name'];
				$data = $books->uploadImage($image, $tmp_name);
			}

			$sql = "UPDATE tbl_books SET
					image='$image'
					WHERE book_id='$book_id'";
			$data = $books->updateRecord($sql);
			echo json_encode($data);
		}


		if($_POST['action'] == 'filter') {
			$genre = $_POST['genre'];
			$author = $_POST['author'];
			$status = $_POST['status'];
			$sql = "";

			if($genre != '' && $author == '' && $status == '') {
				$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.genre_id='$genre'";
			}

			if($genre == '' && $author != '' && $status == '') {
				$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.author_id='$author'";
			}

			if($genre == '' && $author == '' && $status != '') {
				$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.status='$status'";
			}

			if($genre != '' && $author != '' && $status != '') {
				$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.genre_id='$genre' and tbl_books.author_id='$author' and tbl_books.status='$status'";
			}

			if($genre != '' && $author != '' && $status == '') {
				$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.genre_id='$genre' and tbl_books.author_id='$author'";
			}

			if($genre != '' && $author == '' && $status != '') {
				$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.genre_id='$genre' and tbl_books.status='$status'";
			}

			if($genre == '' && $author != '' && $status != '') {
				$sql = "SELECT * FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.author_id='$author' and tbl_books.status='$status'";
			}
			$data = $books->displayRecord($sql);
			echo json_encode($data);
		}


		if($_POST['action'] == 'filter-catalog') {
			$genre = $_POST['genre'];
			$author = $_POST['author'];
			$category = $_POST['category'];

			
			$sql = "";

			if($genre != '' && $author == '' && $category == '') {
				$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE tbl_books.genre_id='$genre'
					GROUP BY tbl_books.book_id";
			}

			if($genre == '' && $author != '' && $category == '') {
				$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE tbl_books.author_id='$author'
					GROUP BY tbl_books.book_id";
			}

			if($genre == '' && $author == '' && $category != '') {

				$year = date("Y");
				$month = date('m');

				if($category == 'New') {

					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE 
					(EXTRACT(YEAR FROM tbl_books.created_at)='$year' and EXTRACT(MONTH FROM tbl_books.created_at)='$month')
					GROUP BY tbl_books.book_id";
				}
				else {
					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE
					(EXTRACT(YEAR FROM tbl_books.created_at) != '$year' and EXTRACT(MONTH FROM tbl_books.created_at) != '$month')
					GROUP BY tbl_books.book_id";
				}
			}

			if($genre != '' && $author != '' && $category != '') {

				$year = date("Y");
				$month = date('m');

				if($category == 'New') {

					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE 
					(tbl_books.genre_id='$genre' and tbl_books.author_id='$author' and (EXTRACT(YEAR FROM tbl_books.created_at)='$year' and EXTRACT(MONTH FROM tbl_books.created_at)='$month'))
					GROUP BY tbl_books.book_id";
				}
				else {
					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE 
					(tbl_books.genre_id='$genre' and tbl_books.author_id='$author' and (EXTRACT(YEAR FROM tbl_books.created_at) != '$year' and EXTRACT(MONTH FROM tbl_books.created_at) != '$month'))
					GROUP BY tbl_books.book_id";
				}

			}

			if($genre != '' && $author != '' && $category == '') {
				$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE 
					(tbl_books.genre_id='$genre' and tbl_books.author_id='$author')
					GROUP BY tbl_books.book_id";
			}

			if($genre != '' && $author == '' && $category != '') {
				$year = date("Y");
				$month = date('m');

				if($category == 'New') {

					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE
					(tbl_books.genre_id='$genre'and (EXTRACT(YEAR FROM tbl_books.created_at)='$year' and EXTRACT(MONTH FROM tbl_books.created_at)='$month'))
					GROUP BY tbl_books.book_id";
				}
				else {
					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE 
					(tbl_books.genre_id='$genre' and (EXTRACT(YEAR FROM tbl_books.created_at) != '$year' and EXTRACT(MONTH FROM tbl_books.created_at) != '$month'))
					GROUP BY tbl_books.book_id";
				}

			}

			if($genre == '' && $author != '' && $category != '') {

				$year = date("Y");
				$month = date('m');

				if($category == 'New') {

					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					WHERE tbl_books.author_id='$author' and (EXTRACT(YEAR FROM tbl_books.created_at)='$year' and EXTRACT(MONTH FROM tbl_books.created_at)='$month')
					GROUP BY tbl_books.book_id";
				}
				else {
					$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE
					(tbl_books.author_id='$author' and (EXTRACT(YEAR FROM tbl_books.created_at) != '$year' and EXTRACT(MONTH FROM tbl_books.created_at) != '$month'))
					GROUP BY tbl_books.book_id";
				}

			}
			$data = $books->displayRecord($sql);
			$count = 0;

			foreach ($data as $value) {
				$status_data = checkRentStatus($books, $data[$count]['book_id']);
				$data[$count]['rent_status'] = $status_data;
				$data[$count]['created_at'] = date('Y-m', strtotime($value['created_at']));
				$count++;
			}
			$rent_no = $books->generateRentID();
			echo json_encode(array('my_data' => $data, 'current_date' => date("Y-m"), 'rent_no' => $rent_no));
		}

		if($_POST['action'] == 'input-search') {
			$search = $_POST['search'];
			$search = "%{$search}%";
			$sql = "SELECT tbl_books.book_id, tbl_books.image, tbl_books.isbn, tbl_books.title, tbl_books.summary, tbl_books.pages, tbl_books.fee, tbl_books.status, tbl_authors.author, tbl_genres.genre, tbl_books.created_at, tbl_books.updated_at, tbl_rents.rent_status
					FROM tbl_books
					INNER JOIN tbl_authors ON tbl_books.author_id=tbl_authors.author_id 
					INNER JOIN tbl_genres ON tbl_books.genre_id=tbl_genres.genre_id
					LEFT JOIN tbl_rents ON tbl_books.book_id=tbl_rents.book_id 
					WHERE 
					(tbl_books.isbn LIKE '$search' OR tbl_books.title LIKE '$search' OR tbl_books.summary LIKE '$search'
					OR tbl_books.pages LIKE '$search' OR tbl_books.fee LIKE '$search' OR tbl_authors.author LIKE '$search' 
					OR tbl_genres.genre LIKE '$search') 
					GROUP BY tbl_books.book_id LIMIT 60";
			$data = $books->displayRecord($sql);
			$count = 0;

			foreach ($data as $value) {
				$status_data = checkRentStatus($books, $data[$count]['book_id']);
				$data[$count]['rent_status'] = $status_data;
				$data[$count]['created_at'] = date('Y-m', strtotime($value['created_at']));
				$count++;
			}

			$rent_no = $books->generateRentID();
			echo json_encode(array('my_data' => $data, 'current_date' => date("Y-m"), 'rent_no' => $rent_no));
			
		}
	}



	function checkRentStatus($rent, $book_id) {
		$sql = "SELECT * FROM tbl_rents WHERE book_id='$book_id' AND rent_status !='Returned'";
		$data = $rent->displayRecord($sql);

		if(count($data) == 0) {
			return 'Returned';
		}
		else {
			return $data[0]['rent_status'];
		}
	}

	
?>