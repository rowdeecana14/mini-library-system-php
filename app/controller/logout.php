<?php	
	require_once "../model/query.php";
	session_start();
	date_default_timezone_set('Asia/Manila');
	$created_at =  date("Y-m-d h:i:s");
	$description = "Logout successfully.";
	$action = "Logout";
	$user_id = $_SESSION['lms_userid'];
	addUserLog($description, $action, $created_at, $user_id);

	unset($_SESSION['lms_userid']);
	unset($_SESSION['lms_role']);
	header("location: ../view/index.php");

	function addUserLog($description, $action, $created_at, $user_id) {
		$users = new Schema;
		$sql = "INSERT INTO tbl_logs (description, action, date, user_id) VALUES ('$description', '$action', '$created_at', '$user_id')";
		$users->addRecord($sql);
	}
?> 