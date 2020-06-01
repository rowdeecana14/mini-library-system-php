<?php	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
		require_once '../model/query.php';
		$authors = new Schema;

		if($_POST['action'] == 'validate') {
			$author = $_POST['author'];
			$sql = "SELECT * FROM tbl_authors 
			WHERE tbl_authors.author='$author'";
			$data = $authors->displayRecord($sql);
			echo json_encode($data);
		}

		if($_POST['action'] == 'add') {
			$author = $_POST['author'];
			$author = ucwords(strtolower($author));
			$sql = "INSERT INTO tbl_authors
					(author) VALUES ('$author')";
			$data = $authors->addRecord($sql);
			echo json_encode($data);
		}
	}
	
?>