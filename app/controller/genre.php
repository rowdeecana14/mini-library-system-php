<?php	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
		require_once '../model/query.php';
		$genres = new Schema;

		if($_POST['action'] == 'validate') {
			$genre = $_POST['genre'];
			$sql = "SELECT * FROM tbl_genres 
			WHERE genre='$genre'";
			$data = $genres->displayRecord($sql);
			echo json_encode($data);
		}

		if($_POST['action'] == 'add') {
			$genre = $_POST['genre'];
			$genre = ucwords(strtolower($genre));
			$sql = "INSERT INTO tbl_genres
					(genre) VALUES ('$genre')";
			$data = $genres->addRecord($sql);
			echo json_encode($data);
		}
	}
	
?>